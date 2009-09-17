#!/usr/bin/env ruby
require 'rubygems'
require 'Sprockets'
require 'Jsmin'

class SprocketPackage
  
  DEFAULT_OPTIONS = {
    :asset_root           => '.',
    :load_path            => ['.'],
    :concat_file_suffix   => '.concat.js',
    :min_file_suffix      => '.build.js',
    :strip_comments       => true
  }

  def initialize(source, options = {})
    @source = source
    if @source.empty?
      puts 'please enter a source file to be sprocketized'
    else
      setup(options)
      @sourcefile = source.to_s + '.js'
      @concatfile = source.to_s + @options[:concat_file_suffix]
      @minfile = source.to_s + @options[:min_file_suffix]
    end
  end
  
  def setup(options = @options)
    @options = DEFAULT_OPTIONS.merge(options)
  end
  
  def sprocketize
    if !@source.empty?
      puts 'beginning sprocketization of ' + @source
      secretary = Sprockets::Secretary.new(
        :asset_root => @options[:asset_root],
        :load_path => @options[:load_path],
        :source_files => [@sourcefile],
        :strip_comments => @options[:strip_comments]
      )
      concatenation = secretary.concatenation
      gluedFiles = concatenation.to_s
      concatenation.save_to(@concatfile)
      # File.open(@minfile, 'w') { |file| file.write(JSMin.minify(gluedFiles)) }
      puts 'beginning compression of ' + @concatfile
      system("java -jar build/yuicompressor.jar " + @concatfile + " > " + @minfile) 
    end
  end
  
end

cpb = SprocketPackage.new('webroot/js/cpb', { :load_path => ['webroot/js/.', 'webroot/js/plugins', 'webroot/js/cpb', 'webroot/js/cpb/modules']})
cpb.sprocketize

puts 'beginning concatenation of site css'
css = ["webroot/css/basic.css", "webroot/css/layout.css"]

puts 'beginning compression of site css'
File.open("webroot/css/cpb.concat.css","w"){|f|
f.puts css.sort.map{|s| IO.read(s)} }

system("java -jar build/yuicompressor.jar webroot/css/cpb.concat.css > webroot/css/cpb.build.css")
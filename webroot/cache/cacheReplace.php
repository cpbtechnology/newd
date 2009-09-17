#!/usr/bin/php -q
<?php

// cacheReplace.php
//
// Removes cache files created by views/helpers/html_cache.php
//
// Runs as a daemon for use with webservers which don't have apache 2.2 mod_cache
//
// Usage: php cacheReplace.php >> /dev/null 2>&1 &

$localhost = '[CACHE URL including http://]';	// Set to an accessible webroot from the server on which you're caching pages
$clearMode = true;				// Clear old cache files on startup
$cacheRefreshInSeconds = 15;
$staleCacheInSeconds = 130;

if (strpos($_SERVER['SCRIPT_NAME'], '/') !== FALSE) {
	chdir(preg_replace('/[^\/]+$/', '', $_SERVER['SCRIPT_NAME']));
}
$today = date("Y-m-d");

// Force refresh of landing and mobile pages
cacheReplace($localhost, getcwd() . '/index.html', false);
if (!file_exists(getcwd() . '/mobile'))  { mkdir(getcwd() . '/mobile'); }
cacheReplace($localhost . 'mobile/', getcwd() . '/mobile/index.html', false);

while (true) {
	$lines = array();
	exec("find " . getcwd() . "/ -name '*html'", $lines);

	if ($today != date("Y-m-d")) {
		$clearMode = true;
		$today = date("Y-m-d");
	}

	foreach ($lines as $line) {
		$cacheArgs = explode('webroot/cache', trim($line));
		$cacheArgs = explode('/', $cacheArgs[1]);
		if ($cacheArgs[0] == "") {
			unset($cacheArgs[0]);
		}
		$subFile = implode('/', $cacheArgs);
		$url = $localhost . $subFile;
		$url = str_replace('/index.html', '', $url);
		$atime = fileatime($line);
		$diff = time() - $atime;

		if ($diff > $staleCacheInSeconds || $clearMode) {	// Clear unaccessed content
			$sys = "rm " . escapeshellarg($line);
			echo $sys . "\n";
			system($sys);
		} else {
			if ($subFile == 'index.html') {		// No ajax headers on the index page
				system("rm " . escapeshellarg($line));
			} else if (preg_match('/json/', $subFile)) {
				cacheReplace($url, $line, true);
			} else {
				cacheReplace($url, $line, false);
			}

		}
	}
	sleep($cacheRefreshInSeconds);
	$clearMode = false;
}

function cacheReplace($targetURL, $targetFile, $ajaxCall = false) {
	system("rm cacheReplace.tmp >> /dev/null 2>&1");

	if ($ajaxCall) {
		$sys = "wget -O cacheReplace.tmp -o cacheReplace.log --http-user=cpbreview --http-password=cpb4all --header=\"X-Requested-With: XMLHttpRequest\" '".$targetURL."'";
	} else {
		$sys = "wget -O cacheReplace.tmp -o cacheReplace.log --http-user=cpbreview --http-password=cpb4all '".$targetURL."'";
	}
	echo $sys . "\n";
	system($sys);

	// Check that we actually got the file

	$wgetLog = file_get_contents("cacheReplace.log");

	if (preg_match('/cacheReplace.tmp\' saved/', $wgetLog)) {
		$sys = "mv cacheReplace.tmp " . escapeshellarg($targetFile);
		echo $sys . "\n";
		system($sys);
	} else {
		echo "Save failure [".$targetURL."] [".$targetFile."].\n";
	}
}

?>

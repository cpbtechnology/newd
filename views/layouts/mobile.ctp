<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
<title>Newd</title>
<style type="text/css">

body{margin:0; padding:0; color:black; font: medium Arial; background-color:#363636;color:#666666;}

.header {background-color: #000000; color:white; padding-top:4px;padding-bottom:4px;}
td {padding-bottom:4px;width:50%;}
table {padding:0;margin:0;}
tr {padding:0;margin:0;}
td {padding-top:4px;padding-bottom:4px;padding-top:4px;padding-bottom:4px;}
.grad {background-image:url('/img/grad.gif'); height: 8px;}

.top {background-color: #000000;  }
a {color:#666666;}
.title {color:#999999;}

hr {color: #666666;background-color: #666666;height: 1px;border:0px;padding:0px;margin:0;margin-top:5px;}
hr.verbose {color: #333333;background-color: #434343;height: 1px;border:0px;padding:0px;margin:0px;margin-top:5px;}
/*hr.nav {color: #666666;background-color: #666666;height: 1px;border:0px;padding:0px;margin:0px;margin-top:5px;}*/
table.nav {border-top:1px solid #666666;border-bottom:1px solid #666666;}
td.nav_on a {color:#ffbd4b;font-family:"Arial";font-size:17px;font-weight:bold;}
td.nav_off a {color:white;font-family:"Arial";font-size:17px;font-weight:bold;text-decoration:none;}
td.nav_on img {margin-left:5px;}
td.nav_off img {margin-left:7px;position:relative;top:1px;border:0px;}
td.nav_on {background-color:#1b1b1b;}
td.nav_off {background-color:#363636;}
td.border {border-right:1px solid #666666;}

/* global */
#bubble_module h2,
#twitter_module h2,
#news_module h2,
#youtube_module h2 {display:none;}

/* bubble styling */
#bubble_module .MediaContainer li {list-style:none;margin-left:0px;margin-bottom:8px;}
#bubble_module .MediaContainer ul {overflow:hidden;padding-left:0px;margin-bottom:-8px;margin-top:0px;}
#bubble_module .Pagination {display:none;}
#bubble_module span.bubble_title {color:#999999;font-family:Arial;font-weight:bold;display:block;}

/* twitter styling */
#twitter_module span.twi_icon_overlay,
#twitter_module img {display:none;}
#twitter_module a.twi_username {color:#999999;font-family:Arial;text-decoration:none;font-weight:bold;}
#twitter_module li {list-style:none;/*text-indent:10px;*/border-bottom:1px solid #434343;}
#twitter_module ul {padding-left:0px;margin-bottom:-8px;margin-top:0px;}
#twitter_module abbr {font-style:italic;}
#twitter_module a.twi_username {/*width:100px;*/}
#twitter_module p.Pagination {display:none;}
#twitter_module span.twi_message {display:block;border-bottom:1px solid #333333;padding-bottom:10px;}
#twitter_module p {margin:8px 0 8px 0;}

/* news styling */

#news_module li {list-style:none;/*text-indent:10px;*/border-bottom:1px solid #434343;}
#news_module ul {padding-left:0px;margin-bottom:-8px;margin-top:0px;}
#news_module a {color:#999999;font-family:Arial;text-decoration:none;font-weight:bold;}
#news_module p {border-bottom:1px solid #333333;padding:5px 0 5px 0;margin:0;}
#news_module li.date {display:none;}
#news_module p.Pagination {display:none;}

/* youtube styling */

#youtube_module li {list-style:none;/*text-indent:10px;*/border-bottom:1px solid #434343;padding:5px 0 5px 0;}
#youtube_module ul {padding-left:0px;margin-bottom:-8px;margin-top:0px;}
#youtube_module a {color:#999999;font-family:Arial;text-decoration:none;font-weight:bold;}
#youtube_module ul.Pagination {display:none;}
#youtube_module li abbr {display:block;}

</style>
</head>
<body>
	<img src="/img/logo.gif" width="127" height="50" alt="Logo">
	<?php echo $content_for_layout; ?>
</body>
</html>
<?php
/*
	We dynamically detect our currrent directory and use it for
	all of our include paths since they must be absolute
*/
$mydir = preg_replace("/\/index.php/","",$_SERVER['SCRIPT_FILENAME']);
$prefs_file = $mydir . "/prefs/" . preg_replace("/^(.*?)\.(.*)$/","$1",$_SERVER['HTTP_HOST']) . ".prefs.php";
$html_dir = $mydir . "/html_slides";


/*
	Default or customized titles for the first slide.
	The default.prefs.php file here is a template and
	is built dynamically via the Ansible playbook.
*/
if (! file_exists($prefs_file)) $prefs_file = "prefs/default.prefs.php";
require_once("$prefs_file");


/*	We include the head html with the splash slide			*/
require_once($mydir . "/head.html");


/*	We build an array and include each HTML slides from the diretory*/
$html_files = explode("\n",shell_exec("find $html_dir -maxdepth 3 -type f -iname \"*html\" | sort"));
foreach( $html_files as $key => $htmlinc){
	include($htmlinc);
}


/*	We include the head html with the splash slide			*/
require_once($mydir . "/tail.html");


?>

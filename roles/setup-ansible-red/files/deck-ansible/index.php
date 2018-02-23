<?php
$mydir = preg_replace("/\/index.php/","",$_SERVER['SCRIPT_FILENAME']);
$prefs_file = $mydir . "/prefs/" . preg_replace("/^(.*?)\.(.*)$/","$1",$_SERVER['HTTP_HOST']) . ".prefs.php";
if (! file_exists($prefs_file)) $prefs_file = "prefs/default.prefs.php";
$html_dir = $mydir . "/html_slides";

$html_files = explode("\n",shell_exec("find $html_dir -maxdepth 3 -type f -iname \"*html\" | sort"));

print "<pre>MYDIR $mydir\nPREFS $prefs_file\nHTML $html_dir</pre>\n";

require_once("$prefs_file");


require_once($mydir . "/head.html");
require_once("$prefs_file");


$workshop_image = 'images/ansible-logo.png';
$workshop_name = 'Ansible Essentials Workshop';
$workshop_presenter = '';
$workshop_title = '';
$workshop_message = 'ansible@redhat.com';

foreach( $html_files as $key => $htmlinc){
	include($htmlinc);
}

require_once($mydir . "/tail.html");

?>

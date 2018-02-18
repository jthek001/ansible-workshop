#!/usr/bin/perl

$pagepath = "/var/www/html/decks/ansible_essentials";

@pages = split(/\<section\>/,`cat ansible-essentials.html`);

foreach $page(@pages){
	$count++;
	$count = "0" . $count if(length($count) == 2);
	$count = "00" . $count if(length($count) == 1);

	($pageflat = $page) =~ s/\s+/ /g;
	($pagename = $pageflat) =~ s/^.*\<h[12]\>(.*)\<\/h[12]\>.*$/$1/g;
	($prettyname = $pagename) =~ s/[^a-zA-Z0-9-_]+/_/g;
	$prettyname =~ s/^_|_$//g;

	$filename = $pagepath . "/" . $count . "__" . $prettyname . ".html";
	open(my $fh, '>', $filename) or die "Could not open file '$filename' $!";
	print $fh "$phpheader<section>\n$page\n$phpfooter\n";
	close $fh;

	print<<ALLDONE;
COUNT:	$count
PAGE:	$pagename
PRETTY:	$prettyname
FILE:	$filename
-----------------------------
ALLDONE
#	sleep(5);

}


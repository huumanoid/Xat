<?php

/*  
  This script has been created to download smilies of your choice.
  Author: SlOom;
*/

function dirornot() { // check if the 'sm2' folder is created.
	if (!is_dir("sm2")) {
		return mkdir("sm2");
	}
}

function downloadSm($sm) { // download all smilies
	
	dirornot();
	
	$smiley = $sm;
	
	$smiley	= explode(",", $smiley);
	
	if (sizeof($smiley) == 0) {
		print 'Nothing to download.';
	} else {

		for ($i = 0; $i < sizeof($smiley); $i++) {
			
			$url = @file_get_contents("http://xat.com/images/sm2/{$smiley[$i]}.swf");
			
			if ($url) {
				if (!file_exists("sm2/".$smiley[$i].".swf")) {
					file_put_contents("sm2/".$smiley[$i].".swf", $url);
					print 'Downloading ('.$smiley[$i].')'.PHP_EOL;
				} else {
					print $smiley[$i].' is already downloaded.'.PHP_EOL;
				}
			} else {
				print 'Failed to download '.$smiley[$i].PHP_EOL;
			}
			
		}
	}
	
}

// feel free to change the smilies list, and make sure to separate them with a ",".
echo downloadSm("applause,donttalk,joyful,smug,victory,blowkiss,dull,medmask,sob,wacky,confounded,ecstatic,ok,sweat,wailing,content,farewell,pensive,tearhair,weary,daydream,flustered,point,tmi,whatever,furious,sarcastic,toj,whistling,depressed,here,screaming,ttm,zany,desire,hih,sidetear,unamused,dollar,idc,slap,unreal,deal");

<?php

	/*
		Download all gifts from gift2.php
		Author : Sloom
		Date : 2/26/2016
		
		If you want more scripts about xat, you can mail me on the site, or just ask me on Xat. :)
		
	*/
	
	$json = json_decode(file_get_contents('http://xat.com/web_gear/chat/gift2.php?Sloom='.time()));
	for($i= 0; $i < sizeof($json); $i++) {
	  if($i == 3) continue; // why do we need to save category name xD ?
	  $explode = explode(',', $json[$i][1]); // first part of the json
	  $explodes = explode(',', $json[$i][2]); // second part of the second
		
		if (in_array($explode[0], array("card", "gift")) || in_array($explodes[0], array("card", "gift")) || is_numeric($explode[1]) || is_numeric($explodes[1])) {
			unset($explode[0]); // removed from array so we can prevent against saving "gift/card" and "50/100".
			unset($explode[1]); // removed from array
		}
		
		// There are 2 parts for each json, so 2 x for(); 
		for ($y = 2; $y <= sizeof($explode); $y++) {
		  $gifts = strtolower($explode[$y]);
			$gift = @file_get_contents("http://www.xatech.com/images/gift/{$gifts}.swf");
			if ($gift) {
			  print 'Downloading gift name : '.$explode[$y].PHP_EOL;
				if (!file_exists("gift/{$gifts}.swf")) {
					file_put_contents("gift/{$gifts}.swf", $gift);
					print 'Success downloading : '.$explode[$y].PHP_EOL;
				} else {
					print 'File is already downloaded.'.PHP_EOL;
				}
			}
		}
		
		for ($x = 2; $x <= sizeof($explodes)+1; $x++) {
			$giftt = strtolower($explodes[$x]);
			$giftss = @file_get_contents("http://www.xatech.com/images/gift/{$giftt}.swf");
			if ($giftt) {
				print 'Downloading gift name : '.$explodes[$x].PHP_EOL;
				if (!file_exists("gift/{$giftt}.swf")) {
					file_put_contents("gift/{$giftt}.swf", $giftss);
					print 'Success downloading : '.$explodes[$x].PHP_EOL;
				} else {
					print 'File is already downloaded.'.PHP_EOL;
				}
			}
		}
	}
	
	print 'Finished downloading all gifts from gift2.php';
	
?>

<?php
/*    
    Swf download - download all powers swf
    Author : xSlOom
    Date : 2/28/2016    
*/

echo "###############################################################################\n";
echo "###############################################################################\n";
echo "######################## SWF DOWNLOAD - Made by SlOom #########################\n";
echo "###############################################################################\n";
echo "###############################################################################\n";

$json = json_decode(file_get_contents('http://xat.com/json/powers.php?s='.time()));

foreach($json as $i => $u) {
    $illuxat = json_decode(file_get_contents('http://api.illuxat.com/powerApi.php?power='.$u->s));
    if(isset($illuxat->error)) continue;
    $sm = explode(',', $illuxat->Smileys);

    for($i= 0; $i < sizeof($sm); $i++)  {
        $urls = @file_get_contents('http://xat.com/images/sm2/'.$sm[$i].'.swf');
        if ($urls) {
            if(!file_exists("sm2/".$sm[$i].".swf")) {
                file_put_contents("sm2/".$sm[$i].".swf", $urls);
                print 'Downloading '.($sm[$i]).PHP_EOL;
            } else {
                print $sm[$i].' is already downloaded.'.PHP_EOL;
            }
        }
    }
    $url = @file_get_contents('http://xat.com/images/sm2/'.$u->s.'.swf'); // power part ONLY without smilies
    if ($url) {
        if (!file_exists("sm2/".$u->s.".swf")) {
            file_put_contents("sm2/".$u->s.".swf", $url);
            print 'Downloading '.($u->s).PHP_EOL;
        } else {
            print $u->s.' is already downloaded.'.PHP_EOL;
        }
    }
}
?>

<?php

/*
	Author 	: SlOom
	Date	: 09/08/2016 (mm/dd/yyyy)
	Preview	: http://i.imgur.com/1v7mwG7.png
	How to  : Open the script on your browser (Ex: localhost/script.php) and here we go. :)
	Note	: This script is used to update your database with all smilies and infos of the power you choosen, so of-course, you need a database! :)
	Note2	: This script uses my API to get all infos about the power, so please don't spam it.
*/

/*
	Here is the database connection!!
*/

$host	= 'localhost'; // or 127.0.0.1
$user	= 'root';
$pass	= '';
$dbname = ''; // where your powers table is ;')

$dbh = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);

/*
	We are done with database connection.
	Oh damn, a post request ....
*/

if (isset($_POST["submit3"])) {
	
	$message	= null;
	$power		= htmlentities($_POST["power"]);
	$json		= json_decode(file_get_contents("http://api.illuxat.com/powerApi.php?power={$power}"));
	
	if (isset($json->error)) {
		
		/*
			If the power does not exist, don't let it go !!
		*/
		
		$message = "The power ''{$power}'' does not exist.";
		
	} else {
		
		/*
			We will create a folder by default!
		*/
		
		if (!is_dir("sm2")) {
			mkdir("sm2");
		}
		
		$smiley = explode(",", $json->Smileys);
		
		for ($i = 0; $i < sizeof($smiley); $i++) {
			
			$urls = @file_get_contents('http://xat.com/images/sm2/'.$smiley[$i].'.swf');
			
			/*
				Save all smilies in the sm2 folder.
			*/
			 
			if(!file_exists("sm2/".$smiley[$i].".swf")) {
				 
				file_put_contents("sm2/".$smiley[$i].".swf", $urls);
				  
			}
			 
		}
		
		$message = sizeof($smiley)." smiley" .(sizeof($smiley) > 1 ? "s have" : " has")." been downloaded.";
	}
}

if (isset($_POST["submit2"])) {
	
	/*
		We are going to add/update like 394 powers....
	*/
	
	$message	= null;
	$add		= 0;
	$upd		= 0;
	$json		= json_decode(file_get_contents("http://dev.illuxat.com/updatedatabase/json.php"));
	
	foreach ($json as $key) {
		$aoru = $dbh->query("SELECT * FROM test2 WHERE id = '{$key->id}'");
		$aor  = $aoru->fetch(PDO::FETCH_ASSOC);
		
		/*
			Let's add/update it.
		*/
		
		if(sizeof($aor) > 1 ) {
			$dbh->query("UPDATE test2 SET name = '{$key->name}', section = '{$key->section}', subid = '{$key->subid}', cost = '{$key->cost}, description = '{$key->description}', topsh = '{$key->topsh}', d1 = '{$key->d1}' WHERE id = '{$key->id}'");
			$upd++;
		} else {
			$qr = $dbh->prepare("INSERT into test2 (id, name, section, subid, cost, description, topsh, d1) VALUES(:id, :name, :section, :subid, :cost, :description, :topsh, :d1)");
			$qr->execute(array("id" => $key->id, "name" => $key->name, "section" => "{$key->section}", "subid" => $key->subid, "cost" => $key->cost, "description" => $key->description, "topsh" => $key->topsh, "d1" => $key->d1));
			$add++;
		}
	}
	
	$message = '<strong>' .$add. '</strong> powers have been added and <strong>'.$upd.'</strong> powers have been updated.';
}
	
if (isset($_POST["submit"])) {
	
	$message	= null;
	$power		= htmlentities($_POST["power"]);
	$json		= json_decode(file_get_contents("http://api.illuxat.com/powerApi.php?power={$power}"));
	
	if (isset($json->error)) {
		
		/*
			If the power does not exist, don't let it go !!
		*/
		
		$message = "The power ''{$power}'' does not exist.";
		
	} else {
		
		/*
			With Xat json, we'll get only both descriptions of the power since everything is on the api already. :)
		*/
		
		$id		= $json->ID;
		$xat 	= json_decode(file_get_contents("http://xat.com/json/powers.php"), true);
		$d1		= isset($xat[$id]["d1"]) ? $xat[$id]["d1"] : false;
		$d2		= isset($xat[$id]["d2"]) ? $xat[$id]["d2"] : false;
		
		/*
			Let's fetch other infos now!!
		*/
		
		$nm		= $json->Power;
		$sm		= str_replace(",", ",", $json->Smileys);
		$st		= str_replace(array(",", " xats", " days"), array("", "", ""), $json->XatStore);
		$sub 	= pow(2, ($id % 32));
		$sec	= $id >> 5;
		
		/*
			Let's debug everything, check and save in database.
			$dbh is the value you choosen on your database connection part. ↑
			The query depends of your database. You can change it.
		*/
				
		$check	= $dbh->query("SELECT * FROM test2 WHERE id = '{$id}'");
		$fetch	= $check->fetch(PDO::FETCH_ASSOC);
		
		
		if (count($fetch) > 1) {
			
			$query		= $dbh->query("UPDATE test2 SET name = '{$nm}', section = 'p{$sec}', subid = '{$sub}', cost = '{$st}', description = '{$d2}', topsh = '{$sm}', d1 = '{$d1}' WHERE id = '{$id}'") or print_r($dbh->errorInfo());
			$message 	= "Updated";
			
		} else {
			
			$qr = $dbh->prepare("INSERT into test2 (id, name, section, subid, cost, description, topsh, d1) VALUES(:id, :name, :section, :subid, :cost, :description, :topsh, :d1)");
			$qr->execute(array("id" => $id, "name" => $nm, "section" => "p".$sec, "subid" => $sub, "cost" => $st, "description" => $d2, "topsh" => $sm, "d1" => $d1));
			
			$message	= "Added";
		}
	}
}

?>
<html>
	<head>
		<title>Xat Database Update</title>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	</head>
	
	<body>
		<div class="container">
			<div align="center">
				<h1>Update a power/database</h1>
				<small>Note: If you are going to update your database FULLY (from the "Update power" button), it will take a minute (depending of your connection/Api) to update every powers. <br /><br /></small>
				<?php if (isset($message) && $message != null) { echo ' --> '.$message .' <--<br /><br />'; } ?>
				<form method="POST">
					<span> Power name : </span>
					<input type="text" id="power" name="power" value="<?php echo (isset($_POST["power"])) ? htmlentities($_POST["power"]) : ""; ?>"> <br /> <br />
					<input type="submit" id="submit" name="submit" class="btn btn-warning btn-flat" value="Update the power"> <input type="submit" id="submit2" name="submit2" class="btn btn-warning btn-flat" value="Update all powers"> <input type="submit" id="submit3" name="submit3" class="btn btn-warning btn-flat" value="Download smilies of the power">
				</form>
			</div>
		</div>
	</body>
</html>

<head>
	<title>Install of RuneTopList Voting Script V2</title>
	<style>
		body {
			text-align: center;
			margin: auto;
		}
	</style>
</head>
<body>
	<h1>Install of RuneTopList Voting Script V2</h1>

<?php
	if(!isset($_POST['step']))
		exit;
	echo '<h2>Step '.$_POST['step'].'</h2>';
	$successful = false;
	
	switch($_POST['step']){ 
		case 1: 
			if (!mysql_connect($_POST['dbaddress'], $_POST['dbusername'], $_POST['dbpassword'])){
				echo("Could not connect to the mysql database: " . mysql_error());
				break;
			}
			if (!mysql_select_db($_POST['dbname'])){
				echo("Database not found: " . mysql_error() . "<br/>");
				echo("Creating Database...");
				mysql_query("CREATE DATABASE ".$_POST['dbname']."") or die(mysql_error());
				if (!mysql_select_db($_POST['dbname'])){
					echo("Could not connect to the mysql database: " . mysql_error());
					break;
				}
			}
			/*if(mysql_num_rows( mysql_query("SHOW TABLES LIKE 'voting_verification'")) == 0) {
				mysql_query("");
			}
			if(mysql_num_rows( mysql_query("SHOW TABLES LIKE 'sites'")) == 0) {
				mysql_query("");
			}
			if(mysql_num_rows( mysql_query("SHOW TABLES LIKE 'settings'")) == 0) {
				mysql_query("");
			}
			if(mysql_num_rows( mysql_query("SHOW TABLES LIKE 'has_voted'")) == 0) {
				mysql_query("");
			}
			if(mysql_num_rows( mysql_query("SHOW TABLES LIKE 'rewards'")) == 0) {
				mysql_query("");
			}*/
			echo("Creating tables...");
			
			mysql_query("CREATE TABLE IF NOT EXISTS `failed_votes` (
			  `ip` varchar(40) NOT NULL,
			  `type` int(11) NOT NULL,
			  PRIMARY KEY (`ip`),
			  KEY `type` (`type`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;
			");
			mysql_query("TRUNCATE TABLE `failed_votes`");
			
			mysql_query("CREATE TABLE IF NOT EXISTS `has_voted` (
			  `ip` varchar(200) NOT NULL,
			  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `rewardid` int(11) NOT NULL DEFAULT '0',
			  `username` varchar(12) NOT NULL,
			  `given` tinyint(1) NOT NULL DEFAULT '0',
			  KEY `ip` (`ip`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			mysql_query("TRUNCATE TABLE `has_voted`");
			
			mysql_query("CREATE TABLE IF NOT EXISTS `rewards` (
			  `id` int(11) NOT NULL,
			  `name` varchar(50) NOT NULL,
			  `amount` int(11) NOT NULL,
			  `url_to_image` varchar(300) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			mysql_query("TRUNCATE TABLE `rewards`");
 
			mysql_query("CREATE TABLE IF NOT EXISTS `settings` (
			  `setting` varchar(200) NOT NULL,
			  `value` varchar(300) NOT NULL,
			  `comment` text NOT NULL,
			  PRIMARY KEY (`setting`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			mysql_query("TRUNCATE TABLE `settings`");

			mysql_query("CREATE TABLE IF NOT EXISTS `sites` (
			  `id` int(11) NOT NULL,
			  `name` varchar(100) NOT NULL,
			  `url` varchar(300) NOT NULL,
			  UNIQUE KEY `id` (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			mysql_query("TRUNCATE TABLE `sites`");

			mysql_query("CREATE TABLE IF NOT EXISTS `voting_verification` (
			  `ip` varchar(15) NOT NULL,
			  `type` int(3) NOT NULL,
			  KEY `ip` (`ip`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
			mysql_query("TRUNCATE TABLE `voting_verification`");
			
			echo("Successfully created the database+tables...");
					
					
			mysql_query("INSERT INTO `settings` (`setting`, `value`, `comment`) VALUES 
			('theme','default','themes: default, greenfox, redfox, bluefox, brightbluefox, orangefox, goldfox, basic'), 
			('server_name','YOUR SERVER NAME', 'Your server name'), 
			('admin_password','CHANGE THIS', 'Password to access the admin control panel')") or die(mysql_error());
			
$string = "<?php
	define('DATABASE_ADDRESS',	'".$_POST['dbaddress']."');
	define('DATABASE_USERNAME',	'".$_POST['dbusername']."');
	define('DATABASE_PASSWORD',	'".$_POST['dbpassword']."');
	define('DATABASE_NAME',		'".$_POST['dbname']."');
?>";

			$fp = fopen('../classes/db-details.php', 'w');
			fwrite($fp, $string);
			fclose($fp);
			$successful = true;
			break;
		case 2:
			include("../classes/db-details.php");
			$connection = mysql_connect(DATABASE_ADDRESS, DATABASE_USERNAME, DATABASE_PASSWORD) or die(mysql_connect_error());
			mysql_select_db(DATABASE_NAME, $connection);
			mysql_query("TRUNCATE TABLE `settings`") or die(mysql_error());
			$name = $_POST['name'];
			$value = $_POST['value'];
			$comment = $_POST['comment'];
			for($i = 0; $i < count($name); $i++) {
				if( isset($name[$i]) && isset($value[$i]) && isset($comment[$i]) && $name[$i]<>'' && $value[$i]<>'' && $comment[$i]<>'') {
					mysql_query("INSERT INTO `settings` (`setting`, `value`,`comment`) VALUES ('".$name[$i]."','".$value[$i]."', '".$comment[$i]."')") or die(mysql_error());
				}
			}
			echo 'Successfully saved the settings...';
			$successful = true;
			break;
		case 3:
			include("../classes/db-details.php");
			$connection = mysql_connect(DATABASE_ADDRESS, DATABASE_USERNAME, DATABASE_PASSWORD) or die(mysql_connect_error());
			mysql_select_db(DATABASE_NAME, $connection);
			mysql_query("TRUNCATE TABLE `sites`") or die(mysql_error());
			$name = $_POST['name'];
			$url = $_POST['url'];
			for($i = 0; $i < count($name); $i++) {
				if( isset($name[$i]) && isset($url[$i]) && $name[$i]<>'' && $url[$i]<>'') {
					mysql_query("INSERT INTO `sites` (`id`, `name`, `url`) VALUES ('".$i."', '".$name[$i]."','".$url[$i]."')") or die(mysql_error());
				}
			}
			echo 'Successfully saved the voting websites...';
			$successful = true;
			break;
		case 4:
			include("../classes/db-details.php");
			$connection = mysql_connect(DATABASE_ADDRESS, DATABASE_USERNAME, DATABASE_PASSWORD) or die(mysql_connect_error());
			mysql_select_db(DATABASE_NAME, $connection);
			mysql_query("TRUNCATE TABLE `rewards`") or die(mysql_error());
			$name = $_POST['name'];
			$amount = $_POST['amount'];
			$url = $_POST['url'];
			for($i = 0; $i < count($name); $i++) {
				if( isset($name[$i]) && isset($url[$i]) && $name[$i]<>'' && $url[$i]<>'') {
					mysql_query("INSERT INTO `rewards` (`id`, `name`, `amount`, `url_to_image`) VALUES ('".$i."', '".$name[$i]."', '".$amount[$i]."', '".$url[$i]."')") or die(mysql_error());
				}
			}
			echo 'Successfully saved the rewards...<br><br><br>';
			echo 'You Successfully configured the voting script...Click <a href="../">here</a> to be taking to the voting script. ';
			$successful = true;
			die;
			break;
	}
	
	echo '<br/><form method="POST" action="index.php"><input type="hidden" name="step" value="'.($successful ? ($_POST['step']+1) : $_POST['step']).'" /><input type="submit" value="Continue"></form>';
?>
</body>
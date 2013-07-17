<?php
	 include("db.class.php");
	
	 class VoteClass extends Database {
	 	
		function __construct() {
			parent::__construct();
	    }
        
        public function hasVotedInLast24() {
            $ip = gethostbyname($_SERVER['REMOTE_ADDR']);
			$query = "SELECT UNIX_TIMESTAMP(time) as time FROM `votes` WHERE  UNIX_TIMESTAMP(NOW()) < UNIX_TIMESTAMP(time)+86000 AND `ip` LIKE '$ip'";
            $result = mysql_query($query);
            if (mysql_num_rows($result) > 0) {
                $result = mysql_fetch_assoc($result);                    
                return $result["time"];
            } else {
                return -1;
            }
        }
        
        public function hasVoted() {
            $ip = gethostbyname($_SERVER['REMOTE_ADDR']);
			$query = "SELECT UNIX_TIMESTAMP(time) as time FROM `votes` WHERE  UNIX_TIMESTAMP(NOW()) < UNIX_TIMESTAMP(time)+86000 AND `ip` LIKE '$ip'";
            $result = mysql_query($query);
            if (mysql_num_rows($result) > 0) {
                $result = mysql_fetch_assoc($result);                    
                return $result["time"];
            } else {
                return -1;
            }
        }
		
        public function setVote($uid, $site) {
		
        }
        
        function createCId($length) {
            $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
            srand((double)microtime()*1000000); 
            $i = 0; 
            $pass = '' ;
            while ($i < $length) { 
                $num = rand() % 33; 
                $tmp = substr($chars, $num, 1); 
                $pass = $pass . $tmp; 
                $i++; 
            }
            return $pass;
        }
        
        function getHeader($sn){
        	echo '<!DOCTYPE html>
			<html>

			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				
				<title>'. $sn .' - Voting</title>
				
				<link rel="stylesheet" type="text/css" href="css/themes/'.$this->getSetting('theme').'.css" />
				
				<!--[if IE]>
				  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
				<![endif]-->
				
				<link rel="stylesheet" type="text/css" href="css/jquery.noty.css"/>
				<link rel="stylesheet" type="text/css" href="css/noty_theme_default.css"/>
			</head>
			<body>
			<div id="page-wrap">
			<header>
			  <h1>'.$sn.' Voting</h1>
			</header>';
        }
        
        function getFooter(){
        	echo "<footer>Created by RuneTopList for Server Name</footer>";
        }
		
        function getUserDetails(){
			$arr = array('timeLastVoted' => 0, 'hasVotedOnAllLinks' => 0);
			$query = "SELECT `time` FROM `has_voted` WHERE `ip` LIKE '" . $_SERVER['REMOTE_ADDR'] . "' ORDER BY time ASC LIMIT 1";
            $result = mysql_query($query);
			if ($row = mysql_fetch_assoc($result)) {
				$arr["timeLastVoted"] = $row['time'];
			}
			$arr["hasVotedOnAllLinks"] = $this->hasVotedAllLinks() ? 1 : 0;
			echo json_encode($arr);	
        }
		
		function getVoteTime(){
			$ip = $_SERVER['REMOTE_ADDR'];
            $result = mysql_query("SELECT UNIX_TIMESTAMP(time) as time FROM `has_voted` WHERE  UNIX_TIMESTAMP(NOW()) < UNIX_TIMESTAMP(time)+86000 AND `ip` LIKE '$ip'");
            if ($row = mysql_fetch_assoc($result)) {
				return $row['time'];
			}
			return -1;
		}
		
		function setAsVoted($reward,$username){
			$ip = $_SERVER['REMOTE_ADDR'];
			$reward = mysql_real_escape_string($reward);
			$username = mysql_real_escape_string($username);
			mysql_query("INSERT INTO `has_voted` (`ip`, `rewardid`, `username`) VALUES ('$ip', '$reward', '$username')");
			mysql_query("DELETE FROM `voting_verification` WHERE `ip`='$ip'");
		}
		
		function hasVotedAllLinks(){
			$totalsites = 0; $totalvotes = 0;
            $result = mysql_query("SELECT COUNT(*) FROM `sites`");
			if ($row = mysql_fetch_assoc($result)){
				$totalsites = $row['COUNT(*)'];
			}
            $result = mysql_query("SELECT COUNT(*) FROM `voting_verification` WHERE `ip` LIKE '" . $_SERVER['REMOTE_ADDR'] . "'");
            if ($row = mysql_fetch_assoc($result)) {
				$totalvotes = $row['COUNT(*)'];
			}
			
			$result = mysql_query("SELECT null FROM `voting_verification` WHERE `ip` LIKE '" . $_SERVER['REMOTE_ADDR'] . "' AND `type`='101'");
			if (mysql_num_rows($result) == 0) {
				mysql_query("REPLACE INTO `failed_votes` (`ip`, `type`) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','1')");
				$result = mysql_query("SELECT COUNT(*) FROM `failed_votes` WHERE `type`='1'");
				if ($row = mysql_fetch_assoc($result)) {
					if($row['COUNT(*)'] > 20){
						$totalvotes++;
						$this->setVotingVisted(101);
					}
				}
			}
			$result = mysql_query("SELECT null FROM `voting_verification` WHERE `ip` LIKE '" . $_SERVER['REMOTE_ADDR'] . "' AND `type`='100'");
			if (mysql_num_rows($result) == 0) {
				mysql_query("REPLACE INTO `failed_votes` (`ip`, `type`) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "','0')");
				$result = mysql_query("SELECT COUNT(*) FROM `failed_votes` WHERE `type`='0'");
				if ($row = mysql_fetch_assoc($result)) {
					if($row['COUNT(*)'] > 20){
						$totalvotes++;
						$this->setVotingVisted(100);
					}
				}
			}
			
			return ($totalsites + 2) <= $totalvotes ? true : false;
		}
		
		function showTimeLeft($time){
			$seconds = $time+86400 - time();
			$hours = floor($seconds / 3600);
			$mins = floor(($seconds - ($hours*3600)) / 60);
			echo '<p>You have already voted today, you will be able to vote in <b>'. $hours .'</b> hours and <b>'. $mins .'</b> minutes.</p>
			<div id="cntdwn" style="text-align:center;"><input type="button" class="button" id="countdown" value="Show Count Down" OnClick="startCountDown('.$seconds.');" ></div>';
		}
		
		function setVotingVisted($type){
			$type = mysql_real_escape_string($type);
			$ip = $_SERVER['REMOTE_ADDR'];
			$query = "SELECT null FROM `voting_verification` WHERE `ip` LIKE '$ip' AND `type`='$type'";
            $result = mysql_query($query);
			if (mysql_num_rows($result) == 0) {
				mysql_query("INSERT INTO `voting_verification` (`ip`, `type`) VALUES ('$ip', '$type')");
			}
		}
		
		function setSiteVoted($stringip, $type){
			$type = mysql_real_escape_string($type);
			$ip = urldecode(base64_decode($stringip));
			$query = "SELECT null FROM `voting_verification` WHERE `ip` LIKE '$ip' AND `type`='$type'";
            $result = mysql_query($query);
			if (mysql_num_rows($result) == 0) {
				mysql_query("INSERT INTO `voting_verification` (`ip`, `type`) VALUES ('$ip', '$type')");
			}
		}
		
		function getVotingLink($type){
			$type = mysql_real_escape_string($type);
            $result = mysql_query("SELECT `url` FROM `sites` WHERE `id`='$type'");
			if ($row = mysql_fetch_assoc($result)) {
				return $row['url'] .  ((strpos($row['url'], "runetoplist") !== false || strpos($row['url'], "runelocus") !== false) ? urlencode(base64_encode($_SERVER['REMOTE_ADDR'])) : '');
			}
			return null;
		}
		
		function echoVotingButtons(){
            $result = mysql_query("SELECT * FROM `sites` ORDER BY `id` ASC");//"<?php echo urlencode(base64_encode($_SERVER['REMOTE_ADDR'])); ?"
			while ($row = mysql_fetch_assoc($result)) {
				echo '<li><a target="_blank" href="json/set.php?site='.$row["id"].'">'.$row["name"].'</a></li>';
			}
		}
		
		function echoRewards(){
            $result = mysql_query("SELECT * FROM `rewards` ORDER BY `id` ASC");
			while ($row = mysql_fetch_assoc($result)) {
				echo '<tr current="'.$row['id'].'">
						<td><input type="radio" name="rewards" value="'.$row['id'].'"></td>
						<td><img src="'.$row['url_to_image'].'"></td>
						<td>'.$row['name'].'</td>
						<td>X '.$this->formatAmount($row['amount']).'</td>
					</tr>';
			}
		}
		
		function getSetting($setting){
            $setting = mysql_real_escape_string($setting);
			$result = mysql_query("SELECT `value` FROM `settings` WHERE `setting`='$setting'") or die(mysql_error());
			if($row = mysql_fetch_assoc($result)){
				if(is_numeric($row['value']))
					return (int)$row['value'];
				else if($row['value'] == 'true')
					return true;
				else if($row['value'] == 'false')
					return false;
				else
					return $row['value'];
			}
			return null;
		}
		
		function formatAmount($n){
			if($n < 100000){
				return '<span title="'.number_format($n).'">'. $n  . '</span>';
			} else if($n < 1000000) {
				return '<span title="'.number_format($n).'">'. floor($n / 1000) . 'K</span>';
			} else if($n < 1000000000) {
				return '<span title="'.number_format($n).'">'. floor($n / 1000000) . 'M</span>';
			} else if($n < 1000000000000) {
				return '<span title="'.number_format($n).'">'. floor($n / 1000000000) . 'B</span>';
			}
		}
		
		/*function RunCheck(){
			//if ($this->getSetting('last_check') + 1800 < time()){
				if ($this->_is_curl_installed()) {
					mysql_query("UPDATE `settings` SET `value`='".time()."' WHERE `setting`='last_check'") or die(mysql_error());
					
					ini_set("default_socket_timeout","05");
					set_time_limit(5);
					$f=fopen("http://www.runetoplist.com","r");
					$r=fread($f,1000);
					fclose($f);
					if(strlen($r)>1) {
						mysql_query("UPDATE `settings` SET `value`='true' WHERE `setting`='is_rtl_up'") or die(mysql_error());
					} else {
						mysql_query("UPDATE `settings` SET `value`='false' WHERE `setting`='is_rtl_up'") or die(mysql_error());
					}
					

					ini_set("default_socket_timeout","05");
					set_time_limit(5);
					$t=fopen("http://www.runefh5h5locus.com","r");
					$e=fread($t,1000);
					fclose($t);
					if(strlen($e)>1) {
						mysql_query("UPDATE `settings` SET `value`='true' WHERE `setting`='is_rl_up'") or die(mysql_error());
					} else {
						mysql_query("UPDATE `settings` SET `value`='false' WHERE `setting`='is_rl_up'") or die(mysql_error());
					}
					
					if($this->isDomainAvailible("http://www.runeto6664plist.com")){
						mysql_query("UPDATE `settings` SET `value`='true' WHERE `setting`='is_rl_up'") or die(mysql_error());
					} else {
						mysql_query("UPDATE `settings` SET `value`='false' WHERE `setting`='is_rl_up'") or die(mysql_error());
					}
					echo 'curl enabled.';
				} else {
					echo 'curl not enabled.';
				}
			//}
		}
		
		function _is_curl_installed() {
			if  (in_array  ('curl', get_loaded_extensions())) {
				return true;
			} else {
				return false;
			}
		}
		
		function isDomainAvailible($url) {
               $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
       curl_setopt ($ch, CURLOPT_URL,$url );
       curl_setopt($ch, CURLOPT_USERAGENT, $agent);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt ($ch,CURLOPT_VERBOSE,false);
       curl_setopt($ch, CURLOPT_TIMEOUT, 5);
       curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt($ch,CURLOPT_SSLVERSION,3);
       curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
       $page=curl_exec($ch);
       //echo curl_error($ch);
       $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
       curl_close($ch);
       if($httpcode>=200 && $httpcode<300) return true;
       else return false;
       }*/
	}
?>
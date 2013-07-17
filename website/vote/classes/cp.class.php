<?php
	 include("db.class.php");
	
	class ControlPanel extends Database {
		
		
		function __construct() {
	       parent::__construct();
	    }
		
		/**
         * gets the top 10 people who have voted the most
         * @returns a stack of data
         */
        
        public function getTop10Voters() {
            $query = mysql_query("SELECT  `username` , COUNT(`username`) AS times FROM  `has_voted` GROUP BY  `username` ORDER BY `times` DESC LIMIT 10");
            if (mysql_num_rows($query) > 0) {
                $stack = array();
                while ($result = mysql_fetch_assoc($query)){
                    array_push($stack, $result["username"], $result["times"]);
                }
                
                return $stack;
            } else {
                return null;
            }
        }
        
        /**
         * gets the amount of votes inbetween two time sets
         * @returns the amount of votes
         * @param1 start of the time set (unix time)
         * @param2 end of time set (unix time)
         */
        
        public function getTotalVotes($start, $end) {
            $start = mysql_real_escape_string($start);
            $end = mysql_real_escape_string($end);
            $query = mysql_query("SELECT COUNT(*) AS votes FROM `has_voted` WHERE UNIX_TIMESTAMP(time) >=$start AND UNIX_TIMESTAMP(time) < $end");
            if($result = mysql_fetch_assoc($query))  
				return $result['votes'];
			else 
				return 0;
        }
        
        /**
         * gets the most popular vote rewards
         * @returns stack of data
         */
        
        public function getPopularRewards() {
            $query = mysql_query("SELECT  `rewardid` , COUNT(  `rewardid` ) AS times FROM  `has_voted` GROUP BY  `rewardid`");
            $stack = array();
            while ($result = mysql_fetch_assoc($query)){
                array_push($stack, $result["rewardid"], $result["times"]);
            }
            
            return $stack;
        }
        
		public function getLinks(){
            $i = 0;
			$result = mysql_query("SELECT * FROM `sites` GROUP BY  `id` ASC") or die(mysql_error());
            while ($row = mysql_fetch_assoc($result)) {
				switch($i){
					case 0:
						echo '<tr>
							<td><input type="text" name="name[]" value="'.$row["name"].'" required="required"></td>
							<td><input type="text" name="url[]" placeholder="http://runetoplist.com/?v=SITE-ID-HERE&i=" required="required" value="'.$row["url"].'"></td>
							<td>RuneTopList link is required for this voting script to work<br>Example url:<br> http://runetoplist.com/?v=<b>SITE-ID-HERE</b>&i=<br> Beware it should always end with an =</td>
						</tr>';
						break;
					case 1:
						echo '<tr>
							<td><input type="text" name="name[]" value="'.$row["name"].'" required="required"></td>
							<td><input type="text" name="url[]" placeholder="http://www.runelocus.com/toplist/index.php?action=vote&id=SITE-ID-HERE&id2=" required="required" value="'.$row["url"].'"></td>
							<td>RuneLocus link is required for this voting script to work<br>Example url:<br> http://www.runelocus.com/toplist/index.php?action=vote&id=<b>SITE-ID-HERE</b>&id2=<br> Beware it should always end with an =</td>
						</tr>';
						break;
					default:
						echo '<tr>
							<td><input type="text" name="name[]" value="'.$row["name"].'" ></td>
							<td><input type="text" name="url[]" value="'.$row["url"].'"></td>
							<td>Other Voting website here. Not required.</td>
						</tr>';
						break;
				}
				$i++;
            }
			while ($i < 20){
				echo '<tr>
					<td><input type="text" name="name[]" ></td>
					<td><input type="text" name="url[]" ></td>
					<td>Other Voting website here. Not required.</td>
				</tr>';
				$i++;
			}
		}
		
        
		public function getRewards(){
            $i = 0;
			$result = mysql_query("SELECT * FROM `rewards` GROUP BY  `id` ASC") or die(mysql_error());
			for($i = 0; $i < 20; $i++){
				$row = mysql_fetch_assoc($result);
				echo '
				<tr>
					<td><input type="text" name="name[]" '. ($i == 0 ? 'required="required"' : '') .' value="'.(isset($row["name"]) ? $row["name"] : '').'"></td>
					<td><input type="text" name="amount[]" '. ($i == 0 ? 'required="required"' : '') .' value="'.(isset($row["amount"]) ? $row["amount"] : '').'"></td>
					<td><input type="text" name="url[]" '. ($i == 0 ? 'required="required"' : '') .' value="'.(isset($row["url_to_image"]) ? $row["url_to_image"] : '').'"></td>
					<td>Reward Id: '.$i.'.<br> Amount Format as integer, not as 1M etc...</td>
				</tr>';
			}
		}
		
		public function getSettings(){
            $i = 0;
			$result = mysql_query("SELECT * FROM `settings`") or die(mysql_error());
			for($i = 0; $i < 20; $i++){
				$row = mysql_fetch_assoc($result);
				echo '
				<tr>					
					<td><input type="text" name="name[]" value="'.(isset($row["setting"]) ? $row["setting"] : '').'"></td>
					<td><input type="text" name="value[]" value="'.(isset($row["value"]) ? $row["value"] : '').'"></td>
					<td><textarea style="height:75px; width:100%;" name="comment[]" >'.(isset($row["comment"]) ? $row["comment"] : '').'</textarea></td>
				</tr>';
			}
		}
		
		public function getSetting($setting){
            $setting = mysql_real_escape_string($setting);
			$result = mysql_query("SELECT `value` FROM `settings` WHERE `setting`='$setting'") or die(mysql_error());
			if($row = mysql_fetch_assoc($result)){
				return is_numeric($row['value']) ? (int)$row['value'] : $row['value'];
			}
			return null;
		}
		
		
		public function setSettings($name, $value, $comment){
			mysql_query("TRUNCATE TABLE `settings`") or die(mysql_error());
			for($i = 0; $i < count($name); $i++) {
				if( isset($name[$i]) && isset($value[$i]) && $name[$i]<>'' && $value[$i]<>'') {
					mysql_query("INSERT INTO `settings` (`setting`, `value`, `comment`) VALUES ('".$name[$i]."','".$value[$i]."','".$comment[$i]."')") or die(mysql_error());
				}
			}
		}
		
		public function setSites($name, $url){
			mysql_query("TRUNCATE TABLE `sites`") or die(mysql_error());
			for($i = 0; $i < count($name); $i++) {
				if( isset($name[$i]) && isset($url[$i]) && $name[$i]<>'' && $url[$i]<>'') {
					mysql_query("INSERT INTO `sites` (`id`, `name`, `url`) VALUES ('".$i."', '".$name[$i]."','".$url[$i]."')") or die(mysql_error());
				}
			}
		}
		
		public function setRewards($name, $amount, $url){
			mysql_query("TRUNCATE TABLE `rewards`") or die(mysql_error());
			for($i = 0; $i < count($name); $i++) {
				if( isset($name[$i]) && isset($url[$i]) && $name[$i]<>'' && $url[$i]<>'') {
					mysql_query("INSERT INTO `rewards` (`id`, `name`, `amount`, `url_to_image`) VALUES ('".$i."', '".$name[$i]."', '".$amount[$i]."', '".$url[$i]."')") or die(mysql_error());
				}
			}
		}
		
		/* 
		 * seeAlso: 
		 *    http://en.wikipedia.org/wiki/Names_of_numbers_in_English#Ordinal_numbers 
		 * 
		 * 0, 1st, 2nd, 3rd, 4th, ... 
		 * 10th, 11th, 12th, 23th, ... 
		 * 20th, 21st, 22nd, 33rd, 34th 
		 */ 
		function ordinalize( $number )
		{
			if ( is_numeric( $number ) && 0 <> $number )
			{
				if ( in_array( $number % 100, range( 11, 13 ) ) )
				{
					return $number . 'th';
				}
				switch ( $number % 10 )
				{
					case 1:  return $number . 'st';
					case 2:  return $number . 'nd';
					case 3:  return $number . 'rd';
					default: return $number . 'th';
				}
			}
			return $number;
		}
		

		function get_percentage($total, $number) {
		  if ( $total > 0 && $number > 0) {
			return round((($total - $number)/$number) * 100,2).'%';
		  } else {
			return 'Insufficient Data';
		  }
		}
	}
?>
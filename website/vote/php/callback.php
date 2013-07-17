<?php 
	include("../classes/vote.class.php");
	$v = new VoteClass();
	if (isset($_GET['callback'])) {
			$v->setSiteVoted($_GET['callback'], 100);
			mysql_query("DELETE FROM `failed_votes` WHERE `type`='0'");
        } else if (isset($_GET['usr'])) {
			$v->setSiteVoted($_GET['usr'], 101);
			mysql_query("DELETE FROM `failed_votes` WHERE `type`='1'");
        }
?>
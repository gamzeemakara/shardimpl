<?php
	include("../classes/vote.class.php");
	$v = new VoteClass();

	switch($_GET['info']){
		case "me":
			$v->getUserDetails();
			break;
		
		default:
			echo 'An error occured please contact a system admin.';
			break;
	}
?>
<?php
	include("../classes/vote.class.php");
	$v = new VoteClass();

	if(isset($_GET['site'])){
		$v->setVotingVisted($_GET['site']);
		$link = $v->getVotingLink($_GET['site']);
		if($link != null)
			header("Location: " . $link);
		else 
			echo 'An error occured please contact a system admin.';
	}
?>
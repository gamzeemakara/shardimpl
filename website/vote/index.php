<?php
	include("classes/vote.class.php");
	$v = new VoteClass();

	$server_name = $v->getSetting('server_name');

	if(!isset($_GET['step']) || $_GET['step'] == 1){
		$v->getHeader($server_name);
?>
		
			<section id="main-content">
				<div id="guts">		
					<?php 
					$time = $v->getVoteTime();
					echo '<h2>Step 1</h2>';
					if($time == -1){ ?>
							<p>Why should you vote for us? If you enjoy the server, and want the server to continue running with a good amount of activity, you should vote daily so we get higher up the RuneScape private server lists. By getting higher up these lists, people are more likely to join, thus making our server more and more popular!</p> 
							<div class="votelinks" >
								<ul>
									<?php $v->echoVotingButtons(); ?>
								</ul>
							</div>

							<form style="text-align: center; " target="" method="GET">
								<input type="hidden" name="step" value="2" />
								<input class="button" type="submit" value="Continue" id="stepbutton" />
							</form>
					<?php
						} else {
							$v->showTimeLeft($time);
						}
					?>
				</div>
			</section>
			
		<?php } else if ($_GET['step'] == 2){ 
			$v->getHeader($server_name);
?>
			<section id="main-content">
				<div id="guts">		
					<?php 
						if($v->hasVotedAllLinks()){ 
							$time = $v->getVoteTime();
							echo '<h2>Step 2</h2>';
							if($time == -1){ ?>
								<p>Please Choose a reward and enter your in game name below.</p> 
								<form style="text-align: center;" target="" method="GET">
									<table id="rewards" cellspacing="0">
										<thead>
											<tr>
												<th></th>
												<th>Image</th>
												<th>Name</th>
												<th>Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php $v->echoRewards(); ?>
										</tbody>
									</table>
									<input type="hidden" name="step" value="3" /><br/>
									<p><label for="username">Please input your username below:</label></p> 
									<input type="text" value="" name="username" class="textField" required="required" maxlength="12" placeholder="Username"/><br/>
									<input class="button" type="submit" value="Continue" id="stepbutton" />
								</form>
							<?php	
							} else {
								$v->showTimeLeft($time);
							}
						} else {
							echo '<h2>Step 2</h2>';
							echo 'You havent voted on all the links. Please click <a href="http://'.$_SERVER["SERVER_NAME"].'/vote/">here</a> to go back.';						
						} ?>
				</div>
			</section>
		
		<?php } else if ($_GET['step'] == 3){
		
			$v->getHeader($server_name);
			echo '<section id="main-content"><div id="guts">';
			echo '<h2>Step 3</h2>';
			if($v->hasVotedAllLinks()){ 
				$time = $v->getVoteTime();
				if($time == -1){
					$v->setAsVoted($_GET['rewards'], $_GET['username']);
					echo '<p>Do ::check in game to recieve your reward.</p>';
				} else {
					$v->showTimeLeft($time);
				}
			} else {
				echo 'You havent voted on all the links. Please click <a href="http://'.$_SERVER["SERVER_NAME"].'/vote/">here</a> to go back.';
			}
			echo '</div></section>';

		} ?>
	</div>
	
	
	<!-- Please do not remove this, thank you. -->
	<footer>
		Created By <a href="http://www.runetoplist.com" >RuneTopList</a> for <a href="/"><?php echo $server_name; ?></a>
	</footer>

	
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery.ba-hashchange.min.js'></script>
	<script type="text/javascript" src="js/jquery.noty.js"></script>
    <script type='text/javascript' src='js/script.js'></script>

</body>

</html>
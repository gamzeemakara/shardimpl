<?php
	include("../classes/cp.class.php");
	$cp = new ControlPanel();

		if(!isset($_COOKIE["pwd"])){
			if(isset($_POST['password'])){
				if($_POST['password'] == $cp->getSetting("admin_password")){
					setcookie("pwd", md5($_POST['password']), time()+60*60*24*30);
				} else {
					die('Incorrect password, please go back and try again.');
				}
			} else {
				echo '<div style="text-align: center;"><form method="POST"><br><br><label for="password">Admin CP Password:</label><br>';
				echo '<input type="password" placeholder="password" name="password" id="password"><br>';
				echo '<input type="submit" value="Login" ></form></div>';
				die;
			}
		} else if ($_COOKIE["pwd"] != md5($cp->getSetting("admin_password"))){
			setcookie("pwd", '', 1);
			die( 'An error occured please login and try again.');
		}
	?>
<html>
<head>
	<title>Admin CP - RuneTopList V2</title>
	<style>
		body {
			width: 100%;
			margin: 0;
			padding: 0;
			text-align: center;
		}
		#sidebar {
			width: 220px;
			float: left;
			background: grey;
			border-right: black 2px solid;
			font-weight: bold;
			border-bottom: black 2px solid;
		}
		#sidebar ul {
			list-style: none;
			padding: 0;
			margin: 0;
		} 
		#sidebar li {
			width: 100%;
			height: 50px;
			line-height: 50px;
		}
		#sidebar li:hover {
			background: white;
			color: black;
		}  
		#sidebar li a {
			color: white;
			display: block;
			text-decoration:none;
		}
		#sidebar li a:hover {
			color: grey;
			display: block;
		}
		.center { 
			text-align: center;
		}
		.center table { 
			margin-left: auto;
			margin-right: auto;
			text-align: left;
		}
		.center table td { 
			min-width: 200px;
		}
		.center table td input[type="text"] { 
			min-width: 190px;
		}
	</style>

</head>
<body>
	<div id="sidebar">
		<ul>
			<li><a href="?">Home</a></li>
			<li><a href="?page=changerewards">Change Rewards</a></li>
			<li><a href="?page=changelinks">Change Voting Links</a></li>
			<li><a href="?page=changesettings">Change General Settings</a></li>
			<li><a href="?page=votingstats">Voting Statistics</a></li>
			<li><a href="?page=poprewards">Most Popular Rewards</a></li>
			<li><a href="?page=topvoters">Top Voters</a></li>
		</ul>
	</div>
	<h1>RuneTopList V2 Admin CP</h1>
	<div class="content">
	<?php
		if(!isset($_GET['page']))
			$_GET['page'] = '';
		switch($_GET['page']){
			case 'changerewards':
				if(isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['url'])){
					$cp->setRewards($_POST['name'], $_POST['amount'], $_POST['url']);
				}
				echo '<h2>Change Rewards</h2>';
				echo '<p>Rewards  (Min 1)</p>
				<form method="POST" action="">
				<div class="center">
					<table width="200" cellpadding="2" cellspacing="2" border="2">
						<tr>
							<td>Reward Name</td>
							<td>Reward Amount</td>
							<td>Image URL</td>
							<td>Comment</td>
						</tr>';
						$cp->getRewards();
					echo '</table>
				</div><br/>
				<input type="submit" value="Submit"></form>';	
				break;
			case 'changelinks':
				if(isset($_POST['name']) && isset($_POST['url'])){
					$cp->setSites($_POST['name'], $_POST['url']);
				}
				echo '<h2>Change Links</h2>';
				echo '<p>Links (Max 20, Min 2 [Must have 1 <b>RUNELOCUS</b> and 1 <b>RUNETOPLIST</b>]):</p>
				<form method="POST"  action="">
				<div class="center">
					<table width="200" cellpadding="2" cellspacing="2" border="2">
						<tr>
							<td>Name</td>
							<td>URL</td>
							<td>Comment</td>
						</tr>';
						$cp->getLinks();
					echo '</table>
				</div><br/>
				<input type="submit" value="Submit"></form>';					
				break;
			case 'changesettings':
				if(isset($_POST['name']) && isset($_POST['value']) && isset($_POST['comment'])){
					$cp->setSettings($_POST['name'], $_POST['value'], $_POST['comment']);
				}
				echo '<h2>Change Settings</h2>';
				echo '<p>These are general settings, make sure you read the comment before changing it.</p>
				<form method="POST" action="" >
				<div class="center">
					<table width="200" cellpadding="2" cellspacing="2" border="2">
						<tr>
							<td>Name</td>
							<td>Value</td>
							<td>Comment</td>
						</tr>';
						$cp->getSettings();
					echo '</table>
				</div><br/>
				<input type="submit" value="Submit"></form>';					
				break;
			case 'votingstats':
				echo '<h2>Voting Statistics</h2>';
					/**
					 * initializing varibles
					 */
					
					$today = date('d');
					$lastmonth = date('m') == 1 ? 12 : date('m')-1;
					$lastmonthsyear = $lastmonth == 12 ? date('Y')-1 : date('Y');
					$thism = array(0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
					$lastm = array(0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
					$totalthismonthtilltoday = null;
					$totallastmonthtilltoday = null;
					
					/**
					 * Adds total amount of votes in each day into an array ready to be used
					 */
					
					for ($m = 0; $m < cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); $m++) {
						$start = mktime(0,0,0,date('m'),$m+1,date('Y'));
						$thism[$m] = $cp->getTotalVotes($start, $start+86000);
					}
					for ($m = 0; $m < cal_days_in_month(CAL_GREGORIAN, $lastmonth, $lastmonthsyear); $m++) {
						$start = mktime(0,0,0,$lastmonth,$m+1,$lastmonthsyear);
						$lastm[$m] = $cp->getTotalVotes($start, $start+86000);
					}
				?>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">
					  google.load("visualization", "1", {packages:["corechart"]});
					  google.setOnLoadCallback(drawChart);
					  function drawChart() {
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Data');
						data.addColumn('number', 'This Month');
						data.addColumn('number', 'Last Month');
						data.addRows(31);
						<? 
							for($i = 0; $i < 31; $i++){
								if ($i < $today) {
									$totalthismonthtilltoday = $totalthismonthtilltoday + $thism[$i];
									$totallastmonthtilltoday = $totallastmonthtilltoday + $lastm[$i];
								}
								echo 'data.setValue('.$i.', 0, \''.$cp->ordinalize($i+1).'\');';
									if ($i <= $today-1) {
										echo 'data.setValue('.$i.', 1, '.$thism[$i].');';
									}
									echo 'data.setValue('.$i.', 2, '.$lastm[$i].');';
							}
						?>
						var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
						chart.draw(data, {width: 800, height: 500, title: '<? echo $cp->getSetting("server_name"); ?> Statistics - Votes over time', 
							backgroundColor: '#282828', titleTextStyle: {color: 'white'},
							hAxis: {title: 'Date',textStyle: {color: 'white'},titleTextStyle: {color: 'white'}},
							vAxis: {title: 'Votes', baselineColor:'white',textStyle: {color: 'white'}, titleTextStyle: {color: 'white'}},
							legendTextStyle: {color: 'white'}
						});
					  }
					</script>
					<div class="center">
						<table width="800" cellpadding="2" cellspacing="2" border="2">
							<tr>
								<td>Total votes in the current month</td>
								<td><?php echo array_sum($thism); ?></td>
							</tr>
							<tr>
								<td>This Month Vs Last month in % ((ThisMonthTillToday - LastMonthTill<? echo $cp->ordinalize($today) ?>)/ LastMonthTill<? echo $cp->ordinalize($today) ?>)*100</td>
								<td><?php echo $cp->get_percentage($totalthismonthtilltoday,$totallastmonthtilltoday); ?></td>
							</tr>
							<tr>
								<td>Today Vs Yesterday (TotalVotesToday - TotalVotesYesterday)</td>
								<td><?php echo $thism[($today-1)]-$thism[($today-2)]; ?></td>
							</tr>
							<tr>
								<td>Today Vs Last Months <? echo $cp->ordinalize($today) ?> (TotalVotesToday - TotalVotesLastMonthOnSameDay)</td>
								<td><? echo $thism[$today-1]-$lastm[($today-1)]; ?></td>
							</tr>
						</table>
					</div><br>
					<div id="chart_div" style="position: initial !important;"></div>
					
			<?	break;
			case 'poprewards':
				echo '<h2>Popular Rewards</h2>';
			   $stack = $cp->getPopularRewards();
			   $amount = count($stack)/2 < 10 ? count($stack)/2 : 10;
			   ?>
					<script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">
					  google.load("visualization", "1", {packages:["corechart"]});
					  google.setOnLoadCallback(drawChart);
					  function drawChart() {
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Reward');
						data.addColumn('number', 'Times');
						<? 
						echo 'data.addRows('.$amount.');';
						for($a = 0; $a < $amount; $a++) {
							echo 'data.setValue('.$a.', 0, "' . array_shift($stack) . '");
								  data.setValue('.$a.', 1, '.array_shift($stack).');'; 
						} ?>

						var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
								chart.draw(data, {width: 800, height: 500, title: '<? echo $cp->getSetting("server_name"); ?> Statistics - Most Popular Rewards', 
								backgroundColor: '#282828', titleTextStyle: {color: 'white'},
								hAxis: {title: 'Users', textStyle: {color: 'white'},titleTextStyle: {color: 'white'}},
								vAxis: {title: 'Votes', baselineColor:'white', textStyle: {color: 'white'}, titleTextStyle: {color: 'white'}},
								legendTextStyle: {color: 'white'}
							});
					  }
					</script>
					<div id="chart_div" style="position: initial !important;"></div>
					
		<?php		break;
			case 'topvoters':
				echo '<h2>Top Voters</h2>';
					$stack = $cp->getTop10Voters();
					$amount = count($stack)/2 < 10 ? count($stack)/2 : 10; ?>
					<script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">
						google.load("visualization", "1", {packages:["corechart"]});
						google.setOnLoadCallback(drawChart);
						function drawChart() {
							var data = new google.visualization.DataTable();
							data.addColumn('string', 'Users');
							data.addColumn('number', 'Votes');
							<? 
							echo 'data.addRows('.$amount.');';
							for($a = 0; $a < $amount; $a++) {
								echo 'data.setValue('.$a.', 0, "'.array_shift($stack).'");
									  data.setValue('.$a.', 1, '.array_shift($stack).');';
							} ?>
							var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
							chart.draw(data, {width: 800, height: 500, title: '<? echo $cp->getSetting("server_name"); ?> Statistics - Top 10 Voters', 
							backgroundColor: '#282828', titleTextStyle: {color: 'white'},
							hAxis: {title: 'Users', textStyle: {color: 'white'},titleTextStyle: {color: 'white'}},
							vAxis: {title: 'Votes', baselineColor:'white', textStyle: {color: 'white'}, titleTextStyle: {color: 'white'}},
							legendTextStyle: {color: 'white'}
						});
					  }
					</script>
					<div id="chart_div" style="position: initial !important;"></div>
		<?php	break;
			default:
				echo '<h2>Home</h2>';
				$v1 = (json_decode(file_get_contents("http://runetoplist.com/api/newsfeed.php")));
				//for($i = 0; $i < count($v1->news); $i++)
				//	echo $v1->news->content;
				echo '<div class="center"><table width="800" cellpadding="2" style="text-align:center;" cellspacing="2" border="2">';
				echo '<thead><tr><td><b>RuneTopList News Feed - Will include latest updates, bug fixes and improvements.</b></td></tr></thead>';
				foreach ($v1 as $row) {
					echo '<tr><td>' . $row . '</td></tr>';
				}
				echo '</table></div>';
				break;
		}
		
	?>
	<div>
</body>
</html>
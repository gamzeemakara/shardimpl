<head>
	<title>Install of RuneTopList Voting Script V2</title>
	<style>
		body {
			text-align: center;
			margin: auto;
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
	<h1>Install of RuneTopList Voting Script V2</h1>
	<form method="POST" action="process.php">
		<?php 
		if(!isset($_POST['step']))
			$_POST['step'] = 1;
		echo '<h2>Step '.$_POST['step'].'</h2>';
		switch($_POST['step']){ 
			case 1: 
				echo '<label for="dbaddress">Database Address</label><br/>
				<input type="text" name="dbaddress" id="dbaddress" placeholder="e.g. localhost" required="required"/><br/>
				<label for="dbusername">Database Username</label><br/>
				<input type="text" name="dbusername" id="dbusername" placeholder="e.g. root" required="required"/><br/>
				<label for="dbpassword">Database Password</label><br/>
				<input type="text" name="dbpassword" id="dbpassword" placeholder="password" required="required"/><br/>
				<label for="dbname">Database Name</label><br/>
				<input type="text" name="dbname" id="dbname" placeholder="default: runetoplistv2" value="runetoplistv2" required="required"/><br/>
				<input type="hidden" name="step" value="1">
				<input type="submit" value="Submit">';
				break;
			case 2:
				echo '
				<p>General Settings:</p>
				<div class="center">
					<table width="200" cellpadding="2" cellspacing="2" border="2">
						<tr>
							<td>Name</td>
							<td>Value</td>
							<td>Comment</td>
						</tr>';
						include('../classes/cp.class.php');
						$cp = new ControlPanel();
						$cp->getSettings();
					echo '</table>
				</div>
				<input type="hidden" name="step" value="2"><br/>
				<input type="submit" value="Submit">';
				break;
			case 3:
				echo '
				<p>Links (Max 20, Min 2 [Must have 1 <b>RUNELOCUS</b> and 1 <b>RUNETOPLIST</b>]):</p>
				<div class="center">
					<table width="200" cellpadding="2" cellspacing="2" border="2">
						<tr>
							<td>Name</td>
							<td>URL</td>
							<td>Comment</td>
						</tr>
						<tr>
							<td><input type="text" name="name[]" value="RuneTopList" required="required"></td>
							<td><input type="text" name="url[]" placeholder="http://runetoplist.com/?v=SITE-ID-HERE&i=" required="required"></td>
							<td>RuneTopList link is required for this voting script to work<br>Example url:<br> http://runetoplist.com/?v=<b>SITE-ID-HERE</b>&i=<br> Beware it should always end with an =</td>
						</tr>
						<tr>
							<td><input type="text" name="name[]" value="RuneLocus" required="required"></td>
							<td><input type="text" name="url[]" placeholder="http://www.runelocus.com/toplist/index.php?action=vote&id=SITE-ID-HERE&id2=" required="required"></td>
							<td>RuneLocus link is required for this voting script to work<br>Example url:<br> http://www.runelocus.com/toplist/index.php?action=vote&id=<b>SITE-ID-HERE</b>&id2=<br> Beware it should always end with an =</td>
						</tr>';
						for($i = 0; $i < 18; $i++){
							echo '
							<tr>
								<td><input type="text" name="name[]" ></td>
								<td><input type="text" name="url[]"></td>
								<td>Other Voting website here. Not required.</td>
							</tr>';
						}
					echo '</table>
				</div>
				<input type="hidden" name="step" value="3"><br/>
				<input type="submit" value="Submit">';
				break;
			case 4:
				echo '<p>Rewards (Max 20, Min 1):</p>
					<div class="center">
						<table width="200" cellpadding="2" cellspacing="2" border="2">
							<tr>
								<td>Reward Name</td>
								<td>Reward Amount</td>
								<td>Image URL</td>
								<td>Comment</td>
							</tr>';
							for($i = 0; $i < 20; $i++){
								echo '
								<tr>
									<td><input type="text" name="name[]" '. ($i == 0 ? 'required="required"' : '') .'></td>
									<td><input type="text" name="amount[]" '. ($i == 0 ? 'required="required"' : '') .'></td>
									<td><input type="text" name="url[]" '. ($i == 0 ? 'required="required"' : '') .'></td>
									<td>Reward Id: '.$i.'.<br> Amount Format as integer, not as 1M etc...</td>
								</tr>';
							}
						echo '</table>
					</div>
					<input type="hidden" name="step" value="4"><br/>
					<input type="submit" value="Submit">';
				break;
		}
		?>
	</form>
</body>
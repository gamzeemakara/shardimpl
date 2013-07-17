<?php

	if(isset($_POST['submit1'])) {
		$errors = array();
		
		$username = trim($_POST['username']);
		$prod = trim($_POST['prod']);
		header("Location: paypal.php?username=". $username ."&prod=". $prod);
		exit;
	}
		
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="generator" content="vBulletin 3.8.7">
<link rel="stylesheet" type="text/css" href="http://vanquishrsps.com/play/vanquish.css"/>
<meta name="keywords" content="vbulletin,vBulletin Solutions,forum,bbs,discussion,bulletin board, near-reality, rsps, private server, remake, oldschool">
<meta name="description" content="Runescape Private Server">	

<head>

<title>Vanquish - Donate</title>
</head>
<body>

<meta http-equiv="Page-Exit" content="BlendTrans(Duration=0)">
<meta http-equiv="Page-Enter" content="BlendTrans(Duration=0)">
<!-- logo -->
<a name="top"></a>
<table border="0" width="960" cellpadding="0" cellspacing="0" align="center" class="tborder">
<tbody><tr>
	<td align="center" valign="top">

<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
<tbody><tr class="header_bg">
	<td align="left" valign="middle"><a href="http://www.vanquishrsps.com/forums/index.php"><img src="http://oi39.tinypic.com/vy6yvn.jpg" border="0" alt="Vanquish" title="Vanquish"></a></td>

	
		<td align="right" id="header_right_cell">
        &nbsp;
    </td>
		
	
</tr>
<tr>
<td height="34" colspan="2" class="vb_navigation">

<!-- nav buttons bar -->

<table cellpadding="0" cellspacing="0" border="0" align="left" class="vb_navigation">
	
	<tbody><tr align="center">
<td width="85" height="34" class="css_nav"><a href="http://www.vanquishrsps.com">Home</a></td>
		
		
			<td width="85" height="34" class="css_nav"><a href="register.php" rel="nofollow">Register</a></td>
		
		


		<td width="85" height="34" class="css_nav"><a href="http://www.vanquishrsps.com/forums/"><b><font color="red">Play</font></b></a></td>
<td width="85" height="34" class="css_nav"><a href="http://www.vanquishrsps.com/forums/">Wiki</a></td>
<td width="85" height="34" class="css_nav"><a href="http://www.vanquishrsps.com/forums/">IG Services</a></td>
			
		
		
		
			
				
				<td width="85" height="34" class="css_nav"><a id="navbar_search" href="search.php" accesskey="4" rel="nofollow">Search</a> </td>
			
			
		
<td width="85" height="34" class="css_nav"><a href="http://www.vanquishrsps.com/forums/showgroups.php?">Staff list</a></td>
		

				
                
		
<td width="85" height="34" class="css_nav"><a href="http://www.vanquishrsps.com/forums/forumdisplay.php?f=13">Help</a>
			
</td><td width="8" height="34" align="left"><img src="http://www.vanquishrsps.com/forums/images/bluefox/misc/nav_final.gif" width="8" height="34" alt="" border="0"></td>
		
		</tr>
	</tbody></table>

<!-- / nav buttons bar -->
</td></tr>
</tbody></table>
<!-- /logo -->
<br>
<font size="155" color="white"></font>
<!-- content table -->
<!-- open content container -->

<div align="center">
	<div class="page" style="width:960px; text-align:left">
		<div class="spacer"></div>


<!-- breadcrumb, login, pm info -->
<table class="vb_navbar" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
<tbody><tr>
	<td class="alt1" width="100%">
		
			<table cellpadding="0" cellspacing="0" border="0">
			<tbody><tr valign="bottom">
				<td><a href="#"><img src="http://www.vanquishrsps.com/forums/images/bluefox/misc/navbits_start.gif" alt="Go Back" border="0" title="Go Back"></a></td>
				<td>&nbsp;</td>
				<td width="100%"><span class="smallfont"><a href="index.php" accesskey="1">Vanquish</a></span> </td>
			</tr>
			<tr>
				<td class="smallfont" style="font-size:10pt; padding-top:1px" colspan="3"><img class="inlineimg" src="http://www.vanquishrsps.com/forums/images/bluefox/misc/navbits_finallink_ltr.gif" alt="Reload this Page" border="0" title="Donate"> <strong>
	Donate

</strong></td>
			</tr>
			</tbody></table>
		
	</td>

	

</tr>
</tbody></table>
<!-- / breadcrumb, login, pm info -->







<br>


	
	
	
	

	
<!-- / NAVBAR POPUP MENUS -->

<!-- PAGENAV POPUP -->
	<div class="vbmenu_popup" id="pagenav_menu" style="display:none">
		<table cellpadding="4" cellspacing="1" border="0">
		<tbody><tr>
			<td class="thead" nowrap="nowrap">Go to Page...</td>
		</tr>
		<tr>
			<td class="vbmenu_option" title="nohilite">
			
			</td>
		</tr>
		</tbody></table>
	</div>
<!-- / PAGENAV POPUP -->









<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
<thead>
	<tr>
		<td class="tcat">
			<a style="float:right" href="#top" onclick="return toggle_collapse('tos')"></a>
			<center>Donate</center>
		</td>
	</tr>
</thead>
<tbody id="collapseobj_searchfaq" style="">
	<tr>
		<td class="panelsurround" align="none">
		<div style="margin-bottom:6px" align="center">

<a href="http://www.vanquishrsps.com/index.php">
			<input type="submit" input value="Donation Support" class="button">
</a>
<a href="http://www.vanquishrsps.com/index.php">
			<input type="submit" input value="Donation TOS" class="button">
</a>
<div class="panel">
                        <p><em><li>THIS SYSTEM IS UNDER DEVELOPMENT DO NOT DONATE YET</em></p><br/>
	<p><em>Note: You must read the terms and conditions for donating</em></p><br/>
	<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
			         
				Username:
				<input type="text" name="username" value="" class="bginput"/>
			        <input type="submit" id ="submit" name="submit1" value="Checkout" class="button">

<br> 
                                <br/>
		</div>

        
	
<br>
<center>
<table class="tborder" table border="1" width="25%" height="100%" align="left">



<tbody><tr><td><img src="http://i.imgur.com/p1oCUt4.png"></td>
<td><input type="radio" name="product" value="1">Donator Pin</td>
<td>$25</td>
</tr><tr>

<tbody><tr><td><img src="http://i.imgur.com/p1oCUt4.png"></td>
<td><input type="radio" name="prod" value="2">Donator Pin (Extended)</td>
<td>$35</td>
</tr><tr>

<tbody><tr><td><img src="http://i.imgur.com/p1oCUt4.png"></td>
<td><input type="radio" name="prod" value="54">5x Donator Pin</td>
<td>$100</td>
</tr><tr>

<td><img src="http://i.imgur.com/my85skf.png"></td>
<td><input type="radio" name="prod" value="3">Barrows Gloves</td>
<td>$2</td>
</tr><tr>


<td><img src="http://i.imgur.com/uTWwPE9.png"></td>
<td><input type="radio" name="prod" value="4">Fire cape</td>
<td>$5</td>
</tr><tr>


<td><img src="http://i.imgur.com/JBTNpCv.png"></td>
<td><input type="radio" name="prod" value="5">Slayer Helmet</td>
<td>$30</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Void_zpse9af43e6.gif"></td>
<td><input type="radio" name="prod" value="6">Full Void Set</td>
<td>$10</td>
</tr><tr>

<td><img src="http://i.imgur.com/2fzROFh.png"></td>
<td><input type="radio" name="prod" value="7">Fighter Torso</td>
<td>$10</td>
</tr><tr>

<td><img src="http://i.imgur.com/6n4TDXE.png"></td>
<td><input type="radio" name="prod" value="8">Rune Defender</td>
<td>$5</td>
</tr><tr>

<td><img src="http://i.imgur.com/QYh553p.png"></td>
<td><input type="radio" name="prod" value="9">Vesta's Longsword</td>
<td>$25</td>
</tr><tr>

<td><img src="http://i.imgur.com/QYh553p.png"></td>
<td><input type="radio" name="prod" value="10">Vesta's Longsword (Degraded)</td>
<td>$35</td>
</tr><tr>

</tr></tbody></table>

<table class="tborder" table border="1" width="25%" height="70%" align="left">

<td><img src="http://i.imgur.com/kGtpY22.png"></td>
<td><input type="radio" name="prod" value="11">Bunny Ears (Limited)</td>
<td>$40</td>

<tbody><tr><td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Bandos_zps093d6a10.gif"></td>
<td><input type="radio" name="prod" value="12">Bandos Set</td>
<td>$20</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Arma_zpsfac107ef.gif"></td>
<td><input type="radio" name="prod" value="13">Armadyl Set</td>
<td>$20</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Item%20Renders/Hween_zpsaa0b798d.gif"></td>
<td>
<input type="radio" name="prod">
<select name="masks">
				<option value="14">Green H'ween</option>
				<option value ="15">Red H'ween</option>
				<option value ="16">Blue H'ween</option>
			</select>
			
<td>$25</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Divine_spirit_shield_zpsd9861489.png"></td>
<td><input type="radio" name="prod"><select name="spirit">
				<option value="23">Divine Spirit Shield</option>
				<option value ="24">Arcane Spirit Shield</option>
				<option value ="25">Elysian Spirit Shield</option>
				<option value ="26">Spectral Spirit Shield</option>
			</select></td>
<td>$20</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/DH_zpsf883c90b.gif"></td>
<td><input type="radio" name="prod"><select name="barrows">
				<option value="27">10 Dharok Sets</option>
				<option value ="28">10 Karil Sets</option>
				<option value ="29">10 Ahrim Sets</option>
				<option value ="30">10 Guthan Sets</option>
				<option value ="31">10 Verac Sets</option>
			</select></td>
<td>$5</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Item%20Renders/dkite-icon.png"></td>
<td><input type="radio" name="prod" value="32">Dragon Kiteshield</td>
<td>$15</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Item%20Renders/death_zps7762277f.png"></td>
<td><input type="radio" name="prod" value="33">Death Cape</td>
<td>$15</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Item%20Renders/Grain-Icon.png"></td>
<td><input type="radio" name="prod" value="34">Grain (Limited)</td>
<td>$50</td>

</tr></tbody></table>

<table class="tborder" table border="1" width="25%" height="80%" align="left">

<tbody><tr><td><img src="http://i.imgur.com/WT4CYWu.png"></td>
<td><input type="radio" name="prod" value="35">Vesta's spear</td>
<td>$20</td>
</tr><tr>

<td><img src="http://i.imgur.com/N3r4YS5.png"></td>
<td><input type="radio" name="prod" value="36">Statius' Warhammer</td>
<td>$20</td>
</tr><tr>


<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Vestas_chainbody_zps8dc7cbca.gif"></td>
<td><input type="radio" name="prod" value="37">Vesta's Set (deg)</td>
<td>$60</td>
</tr><tr>


<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Zuriel_zpsd7b05779.gif"></td>
<td><input type="radio" name="prod" value="38">Zuriel's Set</td>
<td>$30</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Stat_zps9998a5c2.gif"></td>
<td><input type="radio" name="prod" value="39">Statius' Set</td>
<td>$30</td>
</tr><tr>

<td><img src="http://i.imgur.com/dTpUr1P.png"></td>
<td><input type="radio" name="prod" value="40">50 Morrigan's Axe
</td><td>$5</td>
</tr><tr>

<td><img src="http://images2.wikia.nocookie.net/__cb20130207064428/runescape/images/3/3b/Morrigan%27s_javelin.png"></td>
<td><input type="radio" name="prod" value="41">50 Morrigan's Javelin
</td><td>$5</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Morrigans_zps16006c6e.gif"></td>
<td><input type="radio" name="prod" value="42">Morrigan's Set</td>
<td>$30</td>
</tr><tr>

<td><img src="http://i.imgur.com/zaJldJN.png"></td>
<td><input type="radio" name="prod" value="44">Chicken
</td><td>$60</td>

</tr></tbody></table>

<table class="tborder" table border="1" width="25%" height="70%" align="left">


<tbody><tr><td><img src="http://i.imgur.com/l9hmNiL.png"></td>
<td><input type="radio" name="prod" value="45">Santa Hat (Limited)</td>
<td>$50</td>
</tr><tr>

<td><img src="http://i.imgur.com/9UXaoQL.png"></td>
<td><input type="radio" name="prod" value="46">Scythe</td>
<td>$40</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Lime_zps0030bb9a.png"></td>
<td><input type="radio" name="prod" value="47">Lime Whip</td>
<td>$55</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Sky_zpsa4e1ab7f.png"></td>
<td><input type="radio" name="prod" value="48">Skyblue Partyhat</td>
<td>$20</td>
</tr><tr>

<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/Lava-1_zpsdd04a874.png"></td>
<td><input type="radio" name="prod" value="49">Lava Partyhat</td>
<td>$20</td>
</tr><tr>

<td><img src="http://i.imgur.com/wFoAGsb.png"></td>
<td><input type="radio" name="prod" value="50">Armadyl Godsword
</td><td>$20</td>
</tr><tr>

<td><img src="http://i.imgur.com/qOrelZW.png"></td>
<td><input type="radio" name="prod" value="51">Dragon Claws</td>
<td>$30</td>
</tr><tr>

<td><img src="http://i.imgur.com/CfzyEtO.png"></td>
<td><input type="radio" name="prod" value="52">Sled</td>
<td>$60</td>
</tr><tr>


<td><img src="http://i1060.photobucket.com/albums/t457/mtqwerty/holidayguidepartyhats_zpsadc017e8.gif"></td>
<td><input type="radio" name="prod">
<select name="phats">
				<option value="17">Red Partyhat</option>
				<option value ="18">Yellow Partyhat</option>
				<option value ="19">Blue Partyhat</option>
				<option value ="20">Green Partyhat</option>
				<option value ="21">Purple Partyhat</option>
				<option value ="22">White Partyhat</option>
			</select>
<td>$30</td>
</tr><tr>
</tr></tbody></table>



<p>
</center>



 </p>
</form>

			<div style="width:640px">
</div>
				

		

		
		</td>
	</tr>
</tbody>
</table>

</form>
<br>

<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
<thead>
	<tr>
		

<br>

<a name="faq_vb3_board_faq"></a>



</div>




				
<br><br>
<div align="center">
    <div class="smallfont" align="center">
    <!-- Do not remove this copyright notice -->
    Powered by vBulletinÃ‚Â® Version 3.8.7<br>Copyright Ã‚Â©2000 - 2013, vBulletin Solutions, Inc.<br>
    vBulletin Skin developed by: <a href="http://www.vbstyles.com">vBStyles.com</a><br>
<div class="spacer"></div>

    <!-- Do not remove this copyright notice -->
    </div>
    
    <div class="smallfont" align="center">
    
    Copyright Â© 2013 Vanquish Graphics. All Rights Reserved.
    
    </div>
</div>
<br>


		
	</div>
</div>



<form action="index.php" method="get" style="clear:left">
	
<table cellpadding="6" cellspacing="0" border="0" width="960" class="cat_bottom" align="center">
<tbody><tr>
	
	
	<td align="right" width="100%">
		<div class="smallfont">
			<strong>
				<a href="sendmessage.php" rel="nofollow" accesskey="9">Contact Us</a> -
				<a href="http://www.vanquishrsps.com">Vanquish</a> -
				
				
				<a href="archive/index.php">Archive</a> -
  
				
 
				<a href="#top" onclick="self.scrollTo(0, 0); return false;">Top</a>
			</strong>
		</div>
	</td>
</tr>
</tbody></table></form>
</td></tr></tbody></table>




</body>

</html>
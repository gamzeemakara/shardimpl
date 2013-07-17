<?php
 
/*  PHP Paypal IPN Integration Class Demonstration File
 *  4.16.2005 - Micah Carrick, email@micahcarrick.com
 *
 *  This file demonstrates the usage of paypal.class.php, a class designed  
 *  to aid in the interfacing between your website, paypal, and the instant
 *  payment notification (IPN) interface.  This single file serves as 4
 *  virtual pages depending on the "action" varialble passed in the URL. It's
 *  the processing page which processes form data being submitted to paypal, it
 *  is the page paypal returns a user to upon success, it's the page paypal
 *  returns a user to upon canceling an order, and finally, it's the page that
 *  handles the IPN request from Paypal.
 *
 *  I tried to comment this file, aswell as the acutall class file, as well as
 *  I possibly could.  Please email me with questions, comments, and suggestions.
 *  See the header of paypal.class.php for additional resources and information.
*/
session_start();
$base = "/var/www/html/";
include("db.php");
require_once('paypal.class.php');  // include the class file
$p = new paypal_class;             // initiate an instance of the class
//$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
           
// setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
 
// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

if (empty($_GET['amm'])) $_GET['amm'] = '1';

$EMAIL = 'trilla789@gmail.com'; 
 
 
switch ($_GET['action']) {
   
   case 'process':      // Process and order...
 
if (empty($_GET['prod'])){
header("Location: donate.php");
 exit;
}

if (empty($_GET['username'])){
if($_GET['action'] = 'process'){
header("Location: donate.php");
 exit;
}
} 
      //if(!isset($_SESSION["username"])) {
      //    header("Location: login.php");
      //    exit;
      //}
 
      //include("include.php");
//die("donation is temporarily disabled!");
 
      // There should be no output at this point.  To process the POST data,
      // the submit_paypal_post() function will output all the HTML tags which
      // contains a FORM which is submited instantaneously using the BODY onload
      // attribute.  In other words, don't echo or printf anything when you're
      // going to be calling the submit_paypal_post() function.
 
      // This is where you would have your form validation  and all that jazz.
      // You would take your POST vars and load them into the class like below,
      // only using the POST values instead of constant string expressions.
 
      // For example, after ensureing all the POST variables from your custom
      // order form are valid, you might have:
      //
      // $p->add_field('first_name', $_POST['first_name']);
      // $p->add_field('last_name', $_POST['last_name']);
	
	$price = '1.00';
	
		switch($_GET['prod']) {
			case 1:
				$price = '25.00';
				break;
			case 2:
				$price = '35.00';
				break;
			case 3:
				$price = '2.00';
				break;
			case 4:
				$price = '5.00';
				break;
			case 5:
				$price = '30.00';
				break;
			case 6:
				$price = '10.00';
				break;
			case 7:
				$price = '10.00';
				break;
			case 8:
				$price = '5.00';
				break;
			case 9:
				$price = '25.00';
				break;
			case 10:
				$price = '35.00';
				break;
			case 11:
				$price = '40.00';
				break;
			case 12:
				$price = '20.00';
				break;
			case 13:
				$price = '20.00';
				break;
			case 14:
				$price = '25.00';
				break;
			case 15:
				$price = '25.00';
				break;
			case 16:
				$price = '25.00';
				break;
			case 17:
				$price = '30.00';
				break;
			case 18:
				$price = '30.00';
				break;
			case 19:
				$price = '30.00';
				break;
			case 20:
				$price = '30.00';
				break;
			case 21:
				$price = '30.00';
				break;
			case 22:
				$price = '30.00';
				break;
			case 23:
				$price = '20.00';
				break;
			case 24:
				$price = '20.00';
				break;
			case 25:
				$price = '20.00';
				break;
			case 26:
				$price = '20.00';
				break;
			case 27:
				$price = '5.00';
				break;
			case 28:
				$price = '5.00';
				break;
			case 29:
				$price = '5.00';
				break;
			case 30:
				$price = '5.00';
				break;
			case 31:
				$price = '5.00';
				break;
			case 32:
				$price = '15.00';
				break;
			case 33:
				$price = '15.00';
				break;
			case 34:
				$price = '50.00';
				break;
			case 35:
				$price = '20.00';
				break;
			case 36:
				$price = '20.00';
				break;
			case 37:
				$price = '60.00';
				break;
			case 38:
				$price = '30.00';
				break;
			case 39:
				$price = '30.00';
				break;
			case 40:
				$price = '5.00';
				break;
			case 41:
				$price = '5.00';
				break;
			case 42:
				$price = '30.00';
				break;
			case 44:
				$price = '60.00';
			break;
			case 45:
				$price = '50.00';
			case 46:
				$price = '40.00';
			break;
			case 47:
				$price = '55.00';
			case 48:
				$price = '20.00';
			case 49:
				$price = '20.00';
			case 50:
				$price = '20.00';
			break;
			case 51:
				$price = '30.00';
			break;
			case 52:
				$price = '60.00';
				break;
			case 54:
				$price = '100.00';
				break;
		}
		
      $p->add_field('custom', $_GET['username']);
      $p->add_field('business', $EMAIL);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
	  $p->add_field('item_number', $_GET['prod']);
      $p->add_field('currency_code', 'USD');
      $p->add_field('amount', $price);
      //$p->add_field('quantity', $_GET['amm']);
      $p->add_field('lc', 'GB');
      $p->submit_paypal_post(); // submit the fields to paypal
      //$p->dump_fields();      // for debugging, output a table of all the fields
      break;
     
   case 'success':      // Order was successful...
   
      // This is where you would probably want to thank the user for their order
      // or what have you.  The order information at this point is in POST
      // variables.  However, you don't want to "process" the order until you
      // get validation from the IPN.  That's where you would have the code to
      // email an admin, update the database with payment status, activate a
      // membership, etc.  
 
      //include("include.php");
      echo "<h2>Donation Successful</h2><p>Your donation has been completed. To receive your items, log in to the server. If you are already logged in, your must logout and then log back in. If you do not receive your donator items, please contact an administrator.</p>";
      // You could also simply re-direct them to another page, or your own
      // order status page which presents the user with the status of their
      // order based on a database (which can be modified with the IPN code
      // below).
     
      break;
     
   case 'cancel':       // Order was canceled...
 
      // The order was canceled before being completed.
      //include("include.php");
      echo "<h2>Donation Cancelled</h2><p>Your donation was cancelled.</p>";
     
      break;
     
   case 'ipn':          // Paypal is calling page for IPN validation...
   
      // It's important to remember that paypal calling this script.  There
      // is no output here.  This is where you validate the IPN data and if it's
      // valid, update your database to signify that the user has payed.  If
      // you try and use an echo or printf function here it's not going to do you
      // a bit of good.  This is on the "backend".  That is why, by default, the
      // class logs all IPN data to a text file.
      if ($p->validate_ipn()) {
         
         // Payment has been recieved and IPN is verified.  This is where you
         // update your database to activate or process the order, or setup
         // the database with the user's order details, email an administrator,
         // etc.  You can access a slew of information via the ipn_data() array.
 
         // Check the paypal documentation for specifics on what information
         // is available in the IPN POST variables.  Basically, all the POST vars
         // which paypal sends, which we send back for validation, are now stored
         // in the ipn_data() array.
         $fh = fopen(".ipn", "a");
         fwrite($fh, print_r($p->ipn_data, true));
         fclose($fh);
 
         // For this example, we'll just email ourselves ALL the data.
         if($p->ipn_data["payment_status"] != "Completed") die();
 
         if($p->ipn_data["mc_gross"] > 0 && strcmp ($p->ipn_data["business"],$EMAIL) == 0) {
             $user = $p->ipn_data["custom"];
             $date = $p->ipn_data["payment_date"];
             $prodid = $p->ipn_data["item_number"];
             $amount = $p->ipn_data["mc_gross"];
             $amountTickets = 1;
   
             $user = str_replace("-", "_", $user);
             $user = str_replace(" ", "_", $user);
             $user = mysql_real_escape_string($user);
             mysql_query("INSERT INTO donation (username, time, productid, price, tickets) VALUES ('" . $user . "', '" . $date . "', '" . $prodid . "', " . $amount . ", " . $amountTickets . ");");
             $fh = fopen(".ipnerr", "a");
             fwrite($fh, mysql_error());
             fclose($fh);
         }
      }
      break;
 }    
 
?>
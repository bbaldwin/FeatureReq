<!--
@Author: Billy R Baldwin <bbaldwin>
@Date:   03-31-2016
@Email:  billyraybaldwin@gmail.com
@Project: FeatureREQ
@Last modified by:   bbaldwin
@Last modified time: 04-03-2016
-->
<?php
if(isset($_GET['ticket']) && isset($_GET['client'])){
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include('app/db.Class.php');
  $r          = new DB();
  $server     = $server = getenv('HTTP_HOST');
  $client     = $_GET['client'];
  $title      = $r->getClientReq($client)['title'];
  $targetDate = $r->getClientReq($client)['targetdate'];
  $ticket     = $r->getClientReq($client)['ticket_number'];
  $assigned   = $r->getClientReq($client)['assigned'];
  $developer  = $r->getClientReq($client)['developer'];
  $converted  = $r->convertClient($client);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>IWS Feature Request</title>
<link rel="stylesheet" type="text/css" href="style/view.css" media="all">
 </head>
<body id="main_body" >

 <img id="top" src="images/top.png" alt="">
 <div id="form_container">
   <h1><a>IWS Feature Request</a></h1>
   <form class="request"  method="post" action="">
     <div class="form_description">
        <h2>IWS Feature Request</h2>
           <p>Your ticket number <?php echo $ticket; ?>, is currently <?php if($assigned == 0){?> not assigned.<?php }else{ ?> assigned to <?php echo $developer; }?></p>
     </div>
      <table style="width:100%">
        <tr>
          <td><a href="<?php echo "http://$server/index.php?ticket=$ticket";?>"><?php echo $title;?></a></td>
          <td><?php echo $ticket;?></td>
          <td><?php echo $assigned;?></td>
        </tr>
      </table>
   </div>
 </form>
 <img id="bottom" src="images/bottom.png" alt="">
</body>
</html>

<?php }elseif(isset($_GET['client']) && !isset($_GET['req'])) {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  include('app/db.Class.php');
  $r          = new DB();
  $server     = $server = getenv('HTTP_HOST');
  $client     = $_GET['client'];
  $title      = $r->getClientReq($client)['title'];
  $targetDate = $r->getClientReq($client)['targetdate'];
  $ticket     = $r->getClientReq($client)['ticket_number'];
  $assigned   = $r->getClientReq($client)['assigned'];
  $converted  = $r->convertClient($client);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>IWS Feature Request</title>
<link rel="stylesheet" type="text/css" href="style/view.css" media="all">
 </head>
<body id="main_body" >

 <img id="top" src="images/top.png" alt="">
 <div id="form_container">
   <h1><a>IWS Feature Request</a></h1>
   <form class="request"  method="post" action="">
     <div class="form_description">
        <h2>IWS Feature Request</h2>
           <p>Below you will find an overview for all open requests for <?php echo $converted; ?>. Click the link to follow for a specific ticket.</p>
     </div>
      <table style="width:100%">
        <tr>
          <td><a href="<?php echo "http://$server/index.php?client=$client&ticket=$ticket";?>"><?php echo $title;?></a></td>
          <td><?php echo $ticket;?></td>
          <td><?php echo $assigned;?></td>
        </tr>
      </table>

  <!-- <label class="description" for="client">Request Title</label>
   <p><?php echo $r->getClientReq($client)['title'];?></p>
   <label class="description" for="client">Request Date</label>
   <p><?php echo $r->getClientReq($client)['targetdate'];?></p>
 -->
   </div>
 </form>
 <img id="bottom" src="images/bottom.png" alt="">
</body>
</html>

<?php }elseif(isset($_GET['req'])){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('app/db.Class.php');
$r = new DB();
$server   = getenv('HTTP_HOST');
$req      = $_GET["req"];
$priority = $_GET["priority"];
$client   = $_GET["client"];
$url      = "http://$server/index.php?client=$client";
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>IWS Feature Request</title>
 <link rel="stylesheet" type="text/css" href="style/view.css" media="all">
  </head>
 <body id="main_body" >

 	<img id="top" src="images/top.png" alt="">
 	<div id="form_container">
 		<h1><a>IWS Feature Request</a></h1>
    <form class="request"  method="post" action="">
      <div class="form_description">
         <h2>IWS Feature Request</h2>
            <p>Below you will find the details of your feature request.</p>
      </div>
    <label class="description" for="client">Customer</label>
    <p><?php echo $r->convertClient($client); ?></p>
    <label class="description" for="">Title</label>
    <p><?php echo $r->processReq($req)['title']; ?></p>
    <label class="description" for="">Priority</label>
    <p><?php echo $r->processReq($req)['priority']; ?></p>
    <label class="description" for="">Ticket Tracking URL</label>
    <p><a href="<?php echo $url; ?>">Ticket Link</a></p>
    </div>
  </form>
 	<img id="bottom" src="images/bottom.png" alt="">
 </body>
</html>

<?php }else{
  include('app/db.Class.php');
  $r = new DB();
  $dev = rand(1, 4);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>IWS Feature Request</title>
<link rel="stylesheet" type="text/css" href="style/view.css" media="all">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="js/view.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#targetdate" ).datepicker({dateFormat : 'yy-mm-dd'});
  });
</script>
</head>
<body id="main_body" >

<img id="top" src="images/top.png" alt="">
	<div id="form_container">
		<h1><a>IWS Feature Request</a></h1>
		<form class="request"  method="post" action="app/req.Process.php">
					<div class="form_description">
			         <h2>IWS Feature Request</h2>
			            <p>Welcome to the IWS Feature Request Form.</p>
		      </div>
		<ul >
      <li id="li_4" >
		    <label class="description" for="client">Select Your Customer Name </label>
		      <div>
		          <select class="element select medium" id="client" name="client">
			            <option value="" selected="selected"></option>
			            <option value="0" >Client A</option>
			            <option value="1" >Client B</option>
			            <option value="2" >Client C</option>

		          </select>
	        </div>
	<p class="guidelines" id="title"><small>Please select the name that corresponds to your business name</small></p>
		</li>
    <li id="li_1" >
		<label class="description" for="title">Feature Title </label>
		<div>
			<input id="title" name="title" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		<p class="guidelines" id="guide_1"><small>Please enter a general title for your feature request.</small></p>
		</li>
    <li id="li_2" >
		<label class="description" for="description">Feature Description</label>
		<div>
			<textarea id="description" name="description" class="element textarea medium"></textarea>
		</div>
    <p class="guidelines" id="guide_2"><small>Please enter a detailed description for your feature request.</small></p>
		</li>
    <li id="li_6" >
      		  <label class="description" for="priority">Select Your Priority</label>
            <div>
              <select class="element select medium" is="priority" name="priority">
                <option value="" selected="selected"></option>
                <option value="1">Priority High</option>
                <option value="2">Priority Medium</option>
                <option value="3">Priority Low</option>
                <option value="4">Priority Long Term</option>
              </select>
            </div>
          <p class="guidelines" id="guide_6"><small>Select your priority for the request.</small></p>
    <li id="li_3" >
    <label class="description" for="date">Expected Date</label>
		<span>
		<input id="targetdate" name="targetdate" class="element text" maxlength="2" value="" type="text">
		</span>
		<p class="guidelines" id="guide_3"><small>Please enter a reasonable date you hope to have this feature implemented.</small></p>
		</li>
    <li id="li_5" >
		<label class="description" for="product">Product Selection </label>
		<div>
		<select class="element select medium" id="product" name="product">
			<option value="" selected="selected"></option>
			<option value="Policies" >Policies</option>
			<option value="Billing" >Billing</option>
			<option value="Claims" >Claims</option>
			<option value="Reports" >Reports</option>

		</select>
		</div><p class="guidelines" id="guide_5"><small>Please indicate what product this feature is intended for. </small></p>
		</li>

					<li class="buttons">
          <input id="assigned" type="hidden" name="assigned" value="1" />
          <input id="developer" type="hidden" name="developer" value="<?php echo $dev;?>" />

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>

		</form>
	</div>
	<img id="bottom" src="images/bottom.png" alt="">
	</body>
</html>
<?php } ?>

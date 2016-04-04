<!--
@Author: Billy R Baldwin <bbaldwin>
@Date:   04-04-2016
@Email:  billyraybaldwin@gmail.com
@Project: FeatureREQ
@Last modified by:   bbaldwin
@Last modified time: 04-04-2016
-->
<?php
if(isset($_GET['req'])){
include('../app/db.Class.php');

$r = new DB();
$r->getErrors();
$server   = $r->server();
$req      = $_GET["req"];
$priority = $_GET["priority"];
$client   = $_GET["client"];
$url      = "http://$server/views/req.tickets.php?client=$client";
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>IWS Feature Request</title>
 <link rel="stylesheet" type="text/css" href="../style/view.css" media="all">
  </head>
 <body id="main_body" >

 	<img id="top" src="../images/top.png" alt="">
 	<div id="form_container">
    <h1><a href="<?php echo $server; ?>">IWS Feature Request</a></h1>
		<form class="request"  method="post" action="">
					<div class="form_description">
			         <h2>Thank you, your request has been processed. Please see the details below.</h2>
			          <p>Click on the link below to track all open tickets for <?php echo $client;?>.</p>
		</div>
    <table style="width:100%">
      <tr>
        <th>Customer Name</th>
        <th>Request Title</th>
        <th>Priority</th>
        <th>Ticket Tracking URL</th>
      </tr>

     <tr>
        <td><?php echo $r->convertClient($client);?></a></td>
        <td><?php echo $r->processReq($req)['title']; ?></td>
        <td><?php echo $r->processReq($req)['priority']; ?></td>
        <td><a href="<?php echo $url; ?>">Ticket Link</a></td>
      </tr>


    </table>
  </div>
  </form>
 	<img id="bottom" src="../images/bottom.png" alt="">
 </body>
</html>
<?php } ?>

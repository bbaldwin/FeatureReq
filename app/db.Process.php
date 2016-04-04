<!--
@Author: Billy R Baldwin <bbaldwin>
@Date:   04-01-2016
@Email:  billyraybaldwin@gmail.com
@Project: FeatureREQ
@Last modified by:   bbaldwin
@Last modified time: 04-04-2016
-->
<?php
//print_r($_POST);
require("db.Class.php");
$server = getenv('HTTP_HOST');
$ticketNum = rand(1000,13000);
// Instantiate DB class, and insert data from form.
if(isset($_POST["submit"])){
  $db = new DB();
    $db->query("INSERT INTO request (title, description, client, priority, targetdate, product, ticket_number, created_date)
    VALUES (:title, :description, :client, :priority, :targetdate, :product, :ticket, :created_date)");
      $db->bind(':title',       $_POST["title"]);
      $db->bind(':description', $_POST["description"]);
      $db->bind(':client',      $_POST["client"]);
      $db->bind(':priority',    $_POST["priority"]);
      $db->bind(':targetdate',  $_POST["targetdate"]);
      $db->bind(':product',     $_POST["product"]);
      $db->bind(':ticket',      $ticketNum);
      $db->bind('created_date', $_POST['createdDate']);
      $db->execute();
      $last = $db->lastInsertID();
      $priority = $_POST["priority"];
      $client = $_POST["client"];
      header("Location: http://$server/views/req.ticket.php?req=$last&priority=$priority&client=$client");
      }else{
        echo "Something went wrong!";
}
?>
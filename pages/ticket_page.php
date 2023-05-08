<?php
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../database/user.php');
  require_once(__DIR__ . '/../database/ticket.php');
  require_once(__DIR__ . '/../database/message.php');
  require_once(__DIR__ . '/../database/tag.php');
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/commonAdmin.php');
  require_once(__DIR__ . '/../templates/ticket_templates.php');
  $db = getDatabaseConnection();
  //$departments = getAllDepartments($db);
?>
    <!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Admin</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style_user.css" rel="stylesheet">
    <link href="../css/style_profile.css" rel="stylesheet">
    <link href="../css/ticketPage.css" rel="stylesheet">
    <link href="../css/ticket_chat.css" rel="stylesheet">
  </head>
<?php



  drawHeader($session,"ticket");
  drawSidebarADMIN($session);
  $ticket = Ticket::getTicketById($db, $_GET['TicketId']);
  if($ticket->agent->id != Session::getId() && $ticket->client->id != Session::getId() &&  "ADMIN"!= Session::getType()){
    header("Location: /../index.php");
  }
  $messages = Message::GetMessagesFromTicketId($db, $_GET['TicketId'],0,10);
  $tags = Tag::getTagsForTicket($db, $_GET['TicketId']);
  if(!$ticket){
    header("Location: /../index.php");
  }
    //$departments = Department::getAllDepartmentsFromUserId($db,(int) $_GET['userid']); load logs
?>
<div class = "Ticket">  
  <div class = "TicketSummary">
    <?php drawTicketInfo($ticket) ?>
    <?php 
    if($ticket->agent->id == Session::getId() || "ADMIN"== Session::getType()){
      drawTicketTagsAdminAgent($tags,$session , $ticket);
    }else{
    drawTicketTagsClient($tags ) ;}?>
  </div>
  <?php drawTicketMessages($messages,$ticket)?>
  
<?php
  drawFooter($session);
  ?>
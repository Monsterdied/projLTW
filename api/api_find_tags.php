<?php


  //require_once(__DIR__ . '/../utils/session.php');
  //$session = new Session();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/ticket.php');
  require_once(__DIR__ . '/../database/tag.php');
    $db = getDatabaseConnection();
    $ticket = Ticket::getTicketById($db, $_GET['ticketId']);
    if($ticket->agent->id != Session::getId() &&  "ADMIN"!= Session::getType()){
        die(header('Location: /') ); }
    $tags = Tag::searchTagsByName($db, (string)$_GET['search'] , $_GET['ticketId']);

  echo json_encode($tags);
?>
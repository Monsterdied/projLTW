<?php


  //require_once(__DIR__ . '/../utils/session.php');
  //$session = new Session();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/message.php');
  require_once(__DIR__ . '/../util/session.php');
  require_once(__DIR__ . '/../database/ticket.php');

  $db = getDatabaseConnection();
  $ticket = Ticket::getTicketById($db, $_GET['ticketId']);
  if($ticket->agent->id != Session::getId() && $ticket->client->id != Session::getId() &&  "ADMIN"!= Session::getType()){
      die(header('Location: /') ); }
  
  $messages = Message::GetMessagesFromTicketId($db, (int)$_GET['ticketId'],(int) $_GET['start'], (int)$_GET['limit']);

  echo json_encode($messages);
?>
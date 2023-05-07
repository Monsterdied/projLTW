<?php    
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/ticket.php');
    require_once(__DIR__ . '/../database/tag.php');
    $db = getDatabaseConnection();
    $ticket = Ticket::getTicketById($db, $_GET['ticketId']);
    $session = new Session();
    if( ! $session->isLoggedIn()){  die(header('Location: /') ); }
    if($ticket->agent->id !=  $session->getId() &&  "ADMIN"!= $session->getType()){
        die(header('Location: /') ); }

    Tag::removeTagToTicket($db, $_GET['ticketId'], $_GET['tagId']);
    header("Location: /../pages/ticket_page.php?TicketId=" .  $ticket->id )
       ?>    
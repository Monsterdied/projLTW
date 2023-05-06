<?php
    require_once (__DIR__ . "/../util/session.php");
    $session = new Session();
        $message = filter_var($_POST["messageBox"], FILTER_SANITIZE_STRING);
        $ticketId = filter_var($_POST["ticketId"], FILTER_SANITIZE_STRING);
        $user_id = filter_var($_POST["userId"], FILTER_SANITIZE_STRING);
        require_once (__DIR__ . "/../database/connection.php");
        require_once (__DIR__ . "/../database/message.php");
        $db = getDatabaseConnection();
        if( ! $session->isLoggedIn()){  die(header('Location: /') ); }
        $ticket = Ticket::getTicketById($db, $_GET['ticketId']);
        if($ticket->agent->id != Session::getId() && $ticket->client->id != $session->getId() &&  "ADMIN"!= $session->getType()){
            die(header('Location: /') ); }
        Message::addMessageToDatabase($db,$message,$user_id, $ticketId);
        header("Location: /../pages/ticket_page.php?TicketId=$ticketId");
        exit();

?>
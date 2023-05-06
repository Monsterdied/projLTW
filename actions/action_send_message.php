<?php
    require_once (__DIR__ . "/../util/session.php");
    $session = new Session();
        $message = filter_var($_POST["messageBox"], FILTER_SANITIZE_STRING);
        $ticketId = filter_var($_POST["ticketId"], FILTER_SANITIZE_STRING);
        $user_id = filter_var($_POST["userId"], FILTER_SANITIZE_STRING);
        require_once (__DIR__ . "/../database/connection.php");
        require_once (__DIR__ . "/../database/message.php");
        $db = getDatabaseConnection();
        Message::addMessageToDatabase($db,$message,$user_id, $ticketId);
        header("Location: /../pages/ticket_page.php?TicketId=$ticketId");
        exit();

?>
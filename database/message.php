<?php

declare(strict_types = 1);

class Message {
    public string $id;
    public int $published_time;
    public string $content;
    public string $userid;
    public string $ticketId;
    public function __construct(string $id, int $published_time , string $content , string $userid,string $ticketId) {
        $this->id = $id;
        $this->$published_time = $published_time;
        $this->content = $content;
        $this->userid = $userid;
        $this->ticketId = $ticketId;
    }

    // ...

    function getAllStatus(PDO $db) : array {
    $stmt = $db->prepare('SELECT * FROM statuses');
    $stmt->execute();
    $Statuses = $stmt->fetchAll();
    $result = array();
    foreach($Statuses as $Status){
        $result[] = new STATUS(
            $Status['IDSTATUS'],
            $Status['STATUS']
        );
    }
    return $result;
    }

    
    function GetMessagesFromTicketId( PDO $db ,int $TicketId) : array {
        $stmt = $db->prepare('SELECT * FROM MESSAGES WHERE IDTICKET = ?');
        $stmt->execute(array($TicketId));
        $Messages = $stmt->fetchAll();
        $result = array();
        foreach($Messages as $Message){
            if($Message['IDUSER'] != null)
            $result = new Message(
                $Message['IDUSER'],
                $Message['PUBLISHED_TIME'],
                $Message['CONTENT'],
                $Message['IDUSER'],
                $Message['IDTICKET']
            );
        }

        return $result;
        }
    }
?>
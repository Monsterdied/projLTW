<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.php');
require_once(__DIR__ . '/../database/ticket.php');
class Message {
    public string $id;
    public string $published_time;
    public string $content;
    public User $user;
    public string $ticketId;
    public function __construct(string $id, string $published_time , string $content , User $user,string $ticketId) {
        $this->id = $id;
        $this->published_time = $published_time;
        $this->content = $content;
        $this->user = $user;
        $this->ticketId = $ticketId;
    }


    
    function GetMessagesFromTicketId(PDO $db, int $TicketId, int $start, int $limit): array {
        $stmt = $db->prepare('SELECT M.*, U.* FROM MESSAGES M 
                              LEFT JOIN USERS U ON M.IDUSER = U.IDUSER
                              WHERE M.IDTICKET = ? ORDER BY M.PUBLISHED_TIME DESC LIMIT ?, ?');
        $stmt->execute(array($TicketId, $start, $limit));
        $Messages = $stmt->fetchAll();
        $result = array();
        foreach ($Messages as $Message) {
            if ($Message['IDUSER'] != null) {
                $user = new User(
                    $Message['IDUSER'],
                    $Message['NAME'],
                    $Message['USERNAME'],
                    $Message['EMAIL'],
                    $Message['BIO'],
                    $Message['TYPE'],
                    $Message['PROFILE_PICK']
                );
                $result[] = new Message(
                    $Message['IDMESSAGE'],
                    Ticket::getTimeDifference($Message['PUBLISHED_TIME']),
                    $Message['CONTENT'],
                    $user,
                    $Message['IDTICKET']
                );
            }
        }
        return $result;
    }
        function addMessageToDatabase(PDO $db, string $content, string $userId, string $ticketId) : bool {
            $published_time = time();
            $stmt = $db->prepare('INSERT INTO messages (PUBLISHED_TIME, CONTENT, IDUSER, IDTICKET) VALUES (?, ?, ?, ?)');
            $result = $stmt->execute(array($published_time, $content, $userId, $ticketId));
            return $result;
        }
    }
?>
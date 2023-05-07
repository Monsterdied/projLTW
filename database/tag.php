<?php

declare(strict_types = 1);

class Tag {
    public string $id;
    public string $name;

    public function __construct(string $id, ?string $name) {
        $this->id = $id;
        $this->name = $name ?? '';
    }

    // ...

    function getAllTags(PDO $db) : array {
    $stmt = $db->prepare('SELECT * FROM TAGS');
    $stmt->execute();
    $Statuses = $stmt->fetchAll();
    $result = array();
    foreach($Statuses as $Status){
        $result[] = new STATUS(
            $Status['IDTAG'],
            $Status['HASTAG_NAME']
        );
    }
    return $result;
    }


    function getTagFromId(PDO $db,int $id) {
        $stmt = $db->prepare('SELECT * FROM STATUS WHERE IDTAG = ?');
        $stmt->execute(array($id));
        $Status = $stmt->fetch();
        if($Status != null)
        return new STATUS(
            $Status['IDTAG'],
            $Status['HASTAG_NAME']
        );
        return null;
        }

        function getTagsForTicket(PDO $db, int $ticketId): array {
            $stmt = $db->prepare('SELECT t.IDTAG, t.HASTAG_NAME FROM TAGS t
                                  INNER JOIN TAG_TICKET tt ON t.IDTAG = tt.IDTAG
                                  WHERE tt.IDTICKET = ?');
            $stmt->execute(array($ticketId));
            $tags = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tags[] = new Tag($row['IDTAG'], $row['HASTAG_NAME']);
            }
            return $tags;
        }
        function searchTagsByName(PDO $db, string $name, string $ticketId) : array {
            $stmt = $db->prepare('SELECT DISTINCT t.* FROM TAGS t 
                                  LEFT JOIN TAG_TICKET tt ON t.IDTAG = tt.IDTAG AND tt.IDTICKET = ?
                                  WHERE t.HASTAG_NAME LIKE ? AND tt.IDTICKET IS NULL');
            $stmt->execute(array($ticketId, $name.'%'));
            $result = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = new Tag($row['IDTAG'], $row['HASTAG_NAME']);
            }
            return $result;
        }
        function addTagToTicket(PDO $db, int $ticketId, int $tagId) {
            $stmt = $db->prepare('INSERT INTO TAG_TICKET (IDTAG, IDTICKET) VALUES (?, ?)');
            $stmt->execute(array($tagId, $ticketId));
        }
        function removeTagToTicket(PDO $db, int $ticketId, int $tagId){
            $stmt = $db->prepare('DELETE FROM TAG_TICKET WHERE IDTICKET = ? AND IDTAG = ?');
            $stmt->execute(array($ticketId, $tagId));
        }

    }

?>
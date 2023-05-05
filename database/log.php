<?php

declare(strict_types = 1);

class Logs {
    public string $id;
    public string $action;

    public function __construct(string $id, ?string $name) {
        $this->id = $id;
        $this->action = $action ?? '';
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

    
    function getStatusFromId(PDO $db,int $id) {
        $stmt = $db->prepare('SELECT * FROM STATUS WHERE IDSTATUS = ?');
        $stmt->execute(array($id));
        $Status = $stmt->fetch();
        if($Status != null)
        return new STATUS(
            $Status['IDSTATUS'],
            $Status['STATUS']
        );
        return null;
        }
    }
?>
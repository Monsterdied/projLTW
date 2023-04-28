<?php

declare(strict_types = 1);

class Status {
    public string $id;
    public string $name;

    public function __construct(string $id, ?string $name) {
        $this->id = $id;
        $this->name = $name ?? '';
    }

    // ...

    function getAllStatus(PDO $db) : array {
    $stmt = $db->prepare('SELECT * FROM statuses');
    $Statuses=$stmt->execute();
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
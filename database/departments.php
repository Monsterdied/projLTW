<?php

declare(strict_types = 1);

class Department {
  public string $id;
  public string $name;
  public string $sinopse;
  public function __construct(string $id, string $name,string $sinopse)
  { 
  $this->id = $id;
  $this->name = $name;
  $this->sinopse = $sinopse;

  }

}
    function getAllDepartments(PDO $db) : array {
    $stmt = $db->prepare('SELECT * FROM DEPARTEMENTS');
    $departments=$stmt->execute();
    $result = array();
    foreach($departments as $department){
        $result[] = new Department(
            $department['IDDEPARTEMENT'],
            $department['DEPARTEMENTS'],
            $department['SINOPSE']
        );
    }
    return $result;
    }

    
    function getAllDepartmentsFromUserId(PDO $db,int $id) : array{
        $stmt = $db->prepare('SELECT * FROM DEPARTMENT_AGENT WHERE IDAGENT = ?');
        $stmt->execute(array($id));
        $ids_of_departments = $stmt->fetchAll();
        $result = array();
        foreach($ids_of_departments as $id_of_department){
            $stmt = $db->prepare('SELECT * FROM DEPARTEMENTS WHERE IDDEPARTEMENT = ?');
            $stmt->execute(array($id_of_department['IDDEPARTEMENT']));
            $department = $stmt->fetch();
            $result[] = new Department(
                $department['IDDEPARTEMENT'],
                $department['DEPARTEMENTS'],
                $department['SINOPSE']
            );
        }
        return $result;
        }
?>
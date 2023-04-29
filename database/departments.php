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

  function getAllDepartments(PDO $db) : array {
    $stmt = $db->prepare('SELECT * FROM DEPARTMENTS');
    $stmt->execute();
    $departments = $stmt->fetchAll();
    $result = array();
    foreach($departments as $department){
        $result[] = new Department(
            $department['IDDEPARTMENT'],
            $department['DEPARTMENT_NAME'],
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
            $stmt = $db->prepare('SELECT * FROM DEPARTMENTS WHERE IDDEPARTMENT = ?');
            $stmt->execute(array($id_of_department['IDDEPARTMENT']));
            $department = $stmt->fetch();
            $result[] = new Department(
                $department['IDDEPARTMENT'],
                $department['DEPARTMENT_NAME'],
                $department['SINOPSE']
            );
        }
        return $result;
        }

    function deleteAllUserDepartments(PDO $db,int $id) {
        $stmt = $db->prepare('DELETE FROM DEPARTMENT_AGENT WHERE IDAGENT = ?');
        $stmt->execute(array($id));
    }
    function addUserDepartment(PDO $db,int $User_id,int $Department_id) {
        $stmt = $db->prepare("INSERT INTO DEPARTMENT_AGENT (IDDEPARTMENT, IDAGENT) VALUES (?, ?)");
        $stmt->execute([$Department_id, $User_id]);
    }
}
?>
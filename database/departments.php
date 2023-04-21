<?php

    function getAllDepartments($db) {
    $stmt = $db->prepare('SELECT * FROM DEPARTEMENTS');
    $stmt->execute();
    return $stmt->fetchAll();
    }

?>
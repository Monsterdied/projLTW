<?php

    function getAllUsers($db) {
    $stmt = $db->prepare('SELECT * FROM USERS');
    $stmt->execute();
    return $stmt->fetchAll();
    }

?>
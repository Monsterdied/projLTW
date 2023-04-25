<?php
  declare(strict_types = 1);

  class User {
    public string $id;
    public string $name;
    public string $username;
    public string $email;
    public string $password;
    public string $type;
    public string $bio;
    public string $profilepick;
    public function __construct(string $id, string $name,string $username,string $email,string $password,string $bio,string $type ,string $profilepick)
    { 
    $this->id = $id;
    $this->name = $name;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->bio = $bio;
    $this->type = $type;
    $this->profilepick = $profilepick;
    }

    function getAllUsersWithLimit(PDO $db, int $count) : array {
        $stmt = $db->prepare('SELECT * FROM USERS LIMIT ?');
        $stmt->execute(array($count));
        $users = array();
        while ($user = $stmt->fetch()) {
          $users[] = new User(
            $user['IDUSER'],
            $user['NAME'],
            $user['USERNAME'],
            $user['EMAIL'],
            $user['PASSWORD'],
            $user['BIO'] == NULL ? $user['BIO'] :"",
            $user['TYPE'],
            $user['PROFILE_PICK'] == NULL? $user['PROFILE_PICK'] :""
          );
        }
        return $users;
    }

    static function searchUsersByUserName(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT * FROM USERS WHERE NAME LIKE ? LIMIT ?');
      $stmt->execute(array($search . '%', $count));
  
      $users = array();
      while ($user = $stmt->fetch()) {
        $users[] = new User(
          $user['IDUSER'],
          $user['NAME'],
          $user['USERNAME'],
          $user['EMAIL'],
          $user['PASSWORD'],
          $user['BIO'] == NULL ? $user['BIO'] :"",
          $user['TYPE'],
          $user['PROFILE_PICK'] == NULL? $user['PROFILE_PICK'] :""
        );
      }
      return $users;
    }

    static function searchUsersByUser_username(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT * FROM USERS WHERE USERNAME LIKE ? LIMIT ?');
      $stmt->execute(array($search . '%', $count));
  
      $users = array();
      while ($user = $stmt->fetch()) {
        $users[] = new User(
          $user['IDUSER'],
          $user['NAME'],
          $user['USERNAME'],
          $user['EMAIL'],
          $user['PASSWORD'],
          $user['BIO'] == NULL ? $user['BIO'] :"",
          $user['TYPE'],
          $user['PROFILE_PICK'] == NULL? $user['PROFILE_PICK'] :""
        );
      }
      return $users;
    }

    static function getUser(PDO $db, string $id) : User {
        $stmt = $db->prepare('SELECT * FROM USERS WHERE USERID = ?');
        $stmt->execute(array($id));
      
        $user = $stmt->fetch();
      
        return new User(
            $user['IDUSER'],
            $user['NAME'],
            $user['USERNAME'],
            $user['EMAIL'],
            $user['PASSWORD'],
            $user['BIO'] == NULL ? $user['BIO'] :"",
            $user['TYPE'],
            $user['PROFILEPICK'] == NULL? $user['PROFILE_PICK'] :""
        );
      }
  }



?>
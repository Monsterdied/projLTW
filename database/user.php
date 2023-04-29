<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
  class User {
    public string $id;
    public string $name;
    public string $username;
    public string $email;
    public string $type;
    public string $bio;
    public string $profilepick;
    public function __construct(string $id, string $name,string $username,string $email,string $bio,string $type ,string $profilepick)
    { 
    $this->id = $id;
    $this->name = $name;
    $this->username = $username;
    $this->email = $email;
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
            (string)  $user['BIO'] ,
            $user['TYPE'],
            (string) $user['PROFILE_PICK']
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
          (string) $user['BIO'],
          $user['TYPE'],
          (string)  $user['PROFILE_PICK']
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
          (string) $user['BIO'],
          $user['TYPE'],
          (string)  $user['PROFILE_PICK']
        );
      }
      return $users;
    }

    static function getUser(PDO $db, string $id) {
        $stmt = $db->prepare('SELECT * FROM USERS WHERE IDUSER = ?');
        $stmt->execute(array($id));
      
        $user = $stmt->fetch();
      if($user != null)
        return new User(
            $user['IDUSER'],
            $user['NAME'],
            $user['USERNAME'],
            $user['EMAIL'],
            (string) $user['BIO'],
            $user['TYPE'],
            (string) $user['PROFILE_PICK']
        );
        return null;
      }
      static function getUserByUsername(PDO $db, string $username) {
        $stmt = $db->prepare('SELECT * FROM USERS WHERE USERNAME = ?');
        $stmt->execute(array($username));
      
        $user = $stmt->fetch();
      if($user != null)
        return new User(
            $user['IDUSER'],
            $user['NAME'],
            $user['USERNAME'],
            $user['EMAIL'],
            (string) $user['BIO'] ,
            $user['TYPE'],
            (string) $user['PROFILE_PICK']
        );
        return null;
      }

  //NAO ESTA TESTADA ESTA FUNÇÃO
  function save(PDO $db) {
    $stmt = $db->prepare('
      UPDATE Users SET NAME = ? , USERNAME = ? , EMAIL = ? ,BIO = ? , TYPE = ? , PROFILE_PICK = ? 
      WHERE IDUSER = ?
    ');
    $stmt->execute(array($this->name, $this->username,$this->email,$this->bio, $this->type,$this->profilepick,$this->id));
  }

  function change_Password(PDO $db, string $password) {
    $stmt = $db->prepare('
      UPDATE Users SET PASSWORD = ? ,
      WHERE IDUSER = ?
    ');

    $stmt->execute(array($password,$this->id));
  }
  function checkUser(PDO $db,Session $session,string $username , string $password){
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    if($user != null){
      if (password_verify($password, $user['PASSWORD'])) {
        $session->setId((int)$user['IDUSER']);
        $session->setName($user['NAME']);
        $session->setType($user['TYPE']);
      }
    }
  }
  function checkIfUserExists(PDO $db,string $username){
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    if ($user) {
      return true;
    }
    return false;
  }
  function checkIfEmailExists(PDO $db,string $email){
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute(array($email));
    $user = $stmt->fetch();
    if ($user) {
      return true;
    }
    return false;
  }
  
  function addUser( PDO $db,string $username,string $name,string $email,string $password){
    $options = ['cost' => 12];
    $stmt = $db->prepare('INSERT INTO USERS ( NAME, USERNAME, PASSWORD, TYPE, BIO, EMAIL ,PROFILE_PICK) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(
      $name,
      $username,
      password_hash($password, PASSWORD_DEFAULT, $options),
      'CLIENT','',$email,'')
    );
  }
}
?>
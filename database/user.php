<?php
  declare(strict_types = 1);

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
          $user['BIO'] == NULL ? $user['BIO'] :"",
          $user['TYPE'],
          $user['PROFILE_PICK'] == NULL? $user['PROFILE_PICK'] :""
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
            $user['BIO'] == NULL ? $user['BIO'] :"",
            $user['TYPE'],
            $user['PROFILE_PICK'] == NULL? $user['PROFILE_PICK'] :""
        );
        return null;
      }

  //NAO ESTA TESTADA ESTA FUNÇÃO
  function save(PDO $db) {
    $stmt = $db->prepare('
      UPDATE Users SET NAME = ? , SET USERNAME = ? , SET EMAIL = ? , SET BIO = ? , SET TYPE = ? , SET PROFILE_PICK = ? ,
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
  function checkUser(PDO $db,string $username , string $password){
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['username'] = $username;
  }
  }
  function addUser( PDO $db,string $username,string $email,string $password){
    $options = ['cost' => 12];
    $stmt = $db->prepare('INSERT INTO USERS VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(
      $username,
      $email,
      $username,
      password_hash($password, PASSWORD_DEFAULT, $options),'Client','','')
    );
  }
}
?>
<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../database/user.php');
  require_once(__DIR__ . '/../database/Status.php');
  class Ticket {
    public string $id;
    public string $published_Time;
    public string $content;
    public Status $status;
    public User $client;
    public User $agent;
    public Department $department;
    public function __construct(string $id, string $published_Time,string $content,Status $status,User $client,User $agent ,Department $department)
    { 
    $this->id = $id;
    $this->published_Time = $published_Time;
    $this->content = $content;
    $this->status = $status;
    $this->client = $client;
    $this->agent = $agent;
    $this->department = $department;
    }

    function getTickets( PDO $db ,int $start_number_query,int $number_of_results) {  
      $query = "SELECT t.idticket AS IdTicket, t.published_time AS Published_Time, t.content AS Content, s.IDSTATUS AS status_id, s.status AS status_name, 
                c.idUser AS client_id, c.name AS client_name, c.username AS client_username, c.email AS client_email, 
                c.bio AS client_bio, c.type AS client_type, c.profile_pick AS client_profilepick, 
                a.idUser AS agent_id, a.name AS agent_name, a.username AS agent_username, a.email AS agent_email, 
                a.bio AS agent_bio, a.type AS agent_type, a.profile_pick AS agent_profilepick, 
                d.idDepartment AS department_id, d.department_name AS department_name, d.sinopse AS department_sinopse
                FROM tickets AS t
                JOIN status AS s ON t.IdStatus = s.IdStatus
                JOIN users AS c ON t.IdClient = c.IdUser
                JOIN users AS a ON t.IdAgent = a.IdUser
                JOIN DEPARTMENTS AS d ON t.IdDepartment = d.IdDepartment
                ORDER BY t.published_time DESC
                LIMIT :offset, :limit";
  
      $stmt = $db->prepare($query);
      $stmt->bindParam(':limit', $number_of_results, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $start_number_query, PDO::PARAM_INT);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      $tickets = [];
      foreach ($rows as $row) {
        $status = new Status($row['status_id'] , $row['status_name']);
  
        $client = new User(
          $row['client_id'], 
          $row['client_name'], 
          $row['client_username'], 
          $row['client_email'], 
          $row['client_bio'], 
          $row['client_type'], 
          $row['client_profilepick']
        );
  
        $agent = new User(
          $row['agent_id'], 
          $row['agent_name'], 
          $row['agent_username'], 
          $row['agent_email'], 
          $row['agent_bio'], 
          $row['agent_type'], 
          $row['agent_profilepick']
        );
  
        $department = new Department($row['department_id'], $row['department_name'], $row['department_sinopse']);
  
        $ticket = new Ticket($row['IdTicket'], $row['Published_Time'], $row['Content'], $status, $client, $agent, $department);
        $tickets[] = $ticket;
      }
  
      return $tickets;
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
            $user['PASSWORD'],
            $user['BIO'] == NULL ? $user['BIO'] :"",
            $user['TYPE'],
            $user['PROFILE_PICK'] == NULL? $user['PROFILE_PICK'] :""
        );
        return null;
      }
  }



?>
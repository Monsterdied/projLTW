<?php
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../database/user.php');
  require_once(__DIR__ . '/../database/ticket.php');
  require_once(__DIR__ . '/../database/message.php');
  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/commonAdmin.php');

  $db = getDatabaseConnection();
  //$departments = getAllDepartments($db);
?>
    <!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Admin</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style.css" rel="stylesheet">
    <link href="../style_user.css" rel="stylesheet">
    <link href="../style_profile.css" rel="stylesheet">
    <link href="../ticketPage.css" rel="stylesheet">
  </head>
<?php



  drawHeader($session,"ticket");
  drawSidebarADMIN($session);
  $ticket = Ticket::getTicketById($db, $_GET['TicketId']);
  if($ticket->agent->id != Session::getId() && $ticket->client->id != Session::getId() &&  "ADMIN"!= Session::getType()){
    header("Location: /../index.php");
  }
  $messages = Message::GetMessagesFromTicketId($db, $_GET['TicketId'],0,10);
  if(!$ticket){
    header("Location: /../index.php");
  }
    //$departments = Department::getAllDepartmentsFromUserId($db,(int) $_GET['userid']); load logs
?>
<div class = "Ticket">  
  <div class = "TicketSummary">
    <div class = "TicketTitle">
      <h1><?=$ticket->content?></h1>
    </div>

    <div class = "TicketStatus">
      <h2><?=$ticket->status->name?></h2>

    </div>
    <div class = "ProblemPostedBy">
      <h3><?=$ticket->client->username?></h2>
    </div>
    <div class = "ProblemPostedTime">
      <h4><?=Ticket::getTimeDifference($ticket->published_Time)?></h3>
    </div>
  </div>
  <div class = "profileDepartments">
    <div class = "profileDepartmentsTitle">
  <div id="chatbox" style="height: 20em; width: 50em; border: 1px solid #ccc; font: 16px/26px Georgia, Garamond, Serif; overflow: auto; display: flex; flex-direction: column-reverse;">
      <?php foreach($messages as $message){ ?>
        <div class = "menssage">
          <div class = "PostedBy">
            <?= $message->user->username ?> 
          </div>
          <div class = "PostedTime">
            <?= $message->published_time ?>
          </div>
          <div class = "MenssageComment">
            <?=$message->content?>
          </div>
        </div>
<br>
      <?php } ?>

    </div>
    <form action="/../actions/action_send_message.php" method="POST" onSubmit="return validate();">
      <div id = "message_err"></div>
      <input type="text" name="messageBox" id = "messageBox">    
      <input type="hidden" name="ticketId" value=<?=$ticket->id?>>      
      <input type="hidden" name="userId" value=<?=Session::getId()?>>      
      <button  type = "submit" name = "send menssage">Send</button>
    </form>
    <script>
      const chatBox = document.getElementById("chatbox")

      var start = <?= count($messages) ?>;
      const limit = 10
      var loading = false

        async function loadMessages() {
        // If loading is already in progress, do nothing
        if (loading) {
          return;
        }

        loading = true;

        // Send an AJAX request to fetch the next set of messages
        const response = await fetch('../api/api_get_messages.php?start=' + start + '&limit=' + limit + '&ticketId=' + <?=$ticket->id?>);

        // Parse the response as JSON
        const menssages = await response.json()

        // If there are no more messages to fetch, hide the loader and return
        if (menssages.length == 0) {
          //document.querySelector('#loader').style.display = 'none'
          return;
        }

        // Otherwise, loop through the response and append each message to the container
        for (var i = 0; i < menssages.length; i++) {
          const message = menssages[i]
          const messageEl = document.createElement('div')
          messageEl.classList.add('message')
          messageEl.innerHTML = `
            <div class="posted-by">
              ${message.user.username}
            </div>
            <div class="posted-time">
              ${message.published_time}
            </div>
            <div class="message-comment">
              ${message.content}
            </div>
          `;
          chatBox.appendChild(messageEl);
        }

        // Increment the start index and allow loading to occur again
        start += menssages.length
        loading = false
      }
      chatBox.addEventListener("scroll", function() {
        scrollmax = chatBox.clientHeight - chatBox.scrollHeight;
        if (chatBox.scrollTop === scrollmax) {
          loadMessages()
        }
      });
     </script>
    <script>
    function validate() {
        var $valid = true;
        document.getElementById("message_err").innerHTML = "";
        var message = document.getElementById("messageBox").value;
        if(message == "") 
        {
            document.getElementById("message_err").innerHTML = "Cannot post empty message";
        	$valid = false;
        }
        return $valid;
    }
    </script>
<?php
  drawFooter($session);
  ?>
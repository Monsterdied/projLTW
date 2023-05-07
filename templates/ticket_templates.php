<?php function drawTicketTagsAdminAgent($tags,$session , $ticket){?>

        <div>
            <label for="hashtags">Hashtags:</label>
            <input type="text" id="hashtags">
            <input type="hidden" id="ticketId" value = <?= $ticket->id ?>>
            <div id="autocomplete"></div>
            <div id="tag-list">
            <?php foreach($tags as $tag){ ?>
              <div class = "Tag">
                <form action="/../actions/action_remove_tag_from_ticket.php" method="GET">
                  <input type="hidden" name="ticketId" value=<?=$ticket->id?>>
                  <input type="hidden" name="tagId" value=<?=$tag->id?>>
                  <div><button type = "submit">x</button> <?=$tag->name?></div>
                </form>
              </div>
            <?php } ?>
              
            </div>
        </div>
        <script src="../javascript/autocomple_tags.js"></script>
      <?php } ?>

<?php function drawTicketTagsClient($tags){?>
  <label for = "tags title">Tags</label>
  <div class = "Tags">
      <?php foreach($tags as $tag){ ?>
        <div class = "Tag">
          <?=$tag->name?>
        </div>
        <?php } ?>
      </div>

      <?php } ?>


<?php function drawTicketInfo($ticket){ ?>
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
    <?php } ?>

<?php function drawTicketMessages($messages,$ticket){ ?>
    <div id="chatbox" style="height: 20em; width: 50em; border: 1px solid #ccc; font: 16px/26px Georgia, Garamond, Serif; overflow: auto; display: flex; flex-direction: column-reverse;">
      <?php foreach($messages as $message){ ?>
        <?php if( $message->user->id == $ticket->client->id ){ ?>
          <div class = "menssageClient">
        <?php }else{ ?> 
          <div class = "menssageAgent_Admin">  
        <?php } ?>
          <div class = <?="PostedBy" . $message->user->type?>>
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
      <button  type = "submit" name = "send_menssage">Send</button>
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
          
        if(message.user.id == <?=$ticket->client->id?>){
          messageEl.classList.add("menssageClient")
        }else{
          messageEl.classList.add("menssageAgent_Admin")
        }

          messageEl.innerHTML = `
            <div class="PostedBy${message.user.type}">
              ${message.user.username}
            </div>
            <div class="PostedTime">
              ${message.published_time}
            </div>
            <div class="MenssageComment">
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
        //console.log(chatBox.scrollTop)
        //console.log(scrollmax + 5)
        if (chatBox.scrollTop  === scrollmax +1) {
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
    <?php }?>
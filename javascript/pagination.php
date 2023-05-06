
const chatBox = document.getElementById("chatbox")

const start = <?= count($messages) ?>
const limit = 10
const loading = false

function loadMessages() {
  // If loading is already in progress, do nothing
  if (loading) {
    return;
  }

  loading = true;

  // Send an AJAX request to fetch the next set of messages
  const response = await fetch('../api/get-messages.php?start=' + start + '&limit=' + limit + '&ticketId=' + ticketId);

    // Parse the response as JSON
    var menssages = response.json()

    // If there are no more messages to fetch, hide the loader and return
    if (menssages.length === 0) {
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
          ${message.username}
        </div>
        <div class="posted-time">
          ${message.timeDifference}
        </div>
        <div class="message-comment">
          ${message.content}
        </div>
      `;
      container.appendChild(messageEl);
    }

    // Increment the start index and allow loading to occur again
    start += response.length
    loading = false

}


chatBox.addEventListener("scroll", function() {
  scrollmax = chatBox.clientHeight - chatBox.scrollHeight;
  if (chatBox.scrollTop === scrollmax) {

    loadMessages()
    console.log("Chat-box is scrolled to the bottom.")
    console.log("Chat-box is scrolled to the top.")
  }
});


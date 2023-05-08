const hashtagInput = document.getElementById('hashtags');
const autocomplete = document.getElementById('autocomplete');
const tagList = document.getElementById('tag-list');
const ticketId = document.getElementById('ticketId');
const hashtags = [];

// Listen for hashtag input
hashtagInput.addEventListener('keyup', async (event) => {
  activateAutocomplete();
});

// Listen for click on hashtag input
hashtagInput.addEventListener('click', async (event) => {
  activateAutocomplete();
});

async function activateAutocomplete() {
  console.log('/api/api_find_tags.php?search=' + encodeURIComponent(hashtagInput.value) + '&ticketId=' + encodeURIComponent(ticketId.value));
    // Fetch list of hashtags from server
    const response = await fetch('/api/api_find_tags.php?search='+ hashtagInput.value + '&ticketId=' + encodeURIComponent(ticketId.value));
    const hashtags = await response.json();
    console.log(hashtags.length);
    // Display autocomplete suggestions
    autocomplete.innerHTML = '';
    hashtags.forEach((tag) => {
      const option = document.createElement('div');
      option.classList = 'autocomplete-option'
      option.textContent = tag.name;
      option.addEventListener('click', () => {
        //addHashtag(tag);
        autocomplete.innerHTML = '';
        hashtagInput.value = '';
        window.location = "/../actions/action_add_tag_to_ticket.php?ticketId=" + ticketId.value + "&tagId=" + tag.id;
      });
      autocomplete.appendChild(option);
    });
  
}
/*
// Add hashtag to list
function addHashtag(tag) {
  if (!hashtags.includes(tag)) {
    hashtags.push(tag);
    const tagDiv = document.createElement('div');
    tagDiv.textContent = tag.name;
    const removeButton = document.createElement('button');
    removeButton.textContent = 'x';
    removeButton.addEventListener('click', () => {
      removeHashtag(tag);
      tagDiv.remove();
    });
    tagDiv.appendChild(removeButton);
    tagList.appendChild(tagDiv);
  }
}

// Remove hashtag from list
function removeHashtag(tag) {
  const index = hashtags.indexOf(tag);
  if (index !== -1) {
    hashtags.splice(index, 1);
  }
}

// Submit form
function submitForm() {
  const formData = new FormData();
  hashtags.forEach((tag) => {
    formData.append('hashtags[]', tag);
  });
  fetch('/save_hashtags.php', {
    method: 'POST',
    body: formData
  });
}*/
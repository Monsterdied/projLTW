<?php function drawTagsChanger($tags,$ticketId) { ?>
        <div>
        <label for="hashtags">Hashtags:</label>
        <input type="text" id="hashtags">
        <input type="hidden" id="ticketId" value = <?= $ticketId ?>>
        <div id="autocomplete"></div>
        <div id="tag-list"></div>
      </div>
    <?php }?>
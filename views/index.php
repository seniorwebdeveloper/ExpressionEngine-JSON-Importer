<p><?=$choose_channel?></p>

<ul class="results">
	<?php foreach($channels->result_object as $channel) { ?>
		<li id="channel-<?=$channel->channel_id?>"><a href="<?php echo  sprintf($editLink, $channel->channel_id, $channel->field_group); ?>"><?=$channel->channel_title?></a></li>
	<?php } ?>
</ul>
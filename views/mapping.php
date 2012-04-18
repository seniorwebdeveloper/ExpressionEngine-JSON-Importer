<?=form_open($action, '', NULL)?>

<input type="hidden" id="originalImport" name="originalImport" value="<?=htmlspecialchars($originalImport)?>">

<table class="mainTable" border="0" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th>Channel Field</th>
			<th>JSON Key to map to this channel field</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div class="field_label"><strong>Title</strong> <span class="required">*</span></div>
			</td>
			<td>
				<select name="fields[title]">
					<option value="">None</option>
					<?php foreach($keys as $key) { ?>
						<option value="<?=$key?>"><?=$key?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php foreach($fields as $field) { ?>
			<tr>
				<td>
					<div class="field_label"><strong><?=$field['field_label']?></strong> <?=$field['field_required'] === 'y' ? '<span class="required">*</span>' : '' ?></div>
					<div class="field_instructions"><small><?=$field['field_instructions']?></small></div>
				</td>
				<td><select name="fields[field_id_<?=$field['field_id']?>]">
					<option value="">None</option>
					<?php foreach($keys as $key) { ?>
						<option value="<?=$key?>"><?=$key?></option>
					<?php } ?>
				</select></td>
			</tr>
		<?php } ?>
		<tr>
			<td>
				<div class="field_label"><strong>Categories</strong></div>
			</td>
			<td>
				<?php foreach($categories as $category) { ?>
					<label><input type="checkbox" name="category[]" value="<?=$category[0]?>"> <?=$category[1]?></label>
				<?php } ?>
			</td>
		</tr>
	</tbody>
</table>
<p><?=form_submit(array('name' => 'submit', 'value' => lang('submit'), 'class' => 'submit'))?></p>

<?=form_close()?>
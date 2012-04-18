<p>Please paste in the JSON you want to import</p>

<?=form_open($action, '', NULL)?>
	<div class="publish_field publish_textarea" id="import_json" style="width: 100%; ">
		<input type="hidden" name="channel_id" value="<?=$channel_id?>">
		<input type="hidden" name="field_group" value="<?=$field_group?>">
										<div class="handle"></div>

										<label class="hide_field" for="import_json">
											<span>
												<em class="required">* </em>
													JSON Input</span>
										</label>


										<div id="sub_hold_import_json">

																						<div class="instruction_text">
													<p><strong>Instructions: </strong>&nbsp;Please paste in JSON here</p>											</div>

											<fieldset class="holder">
												<textarea name="import_json" cols="90" rows="24" id="import_json" dir="ltr"></textarea>																					</fieldset>




										</div> <!-- /sub_hold_field -->

									</div>
									
		<p>
			<?=form_submit(array('name' => 'submit', 'value' => lang('submit'), 'class' => 'submit'))?>
		</p>
<?=form_close()?>
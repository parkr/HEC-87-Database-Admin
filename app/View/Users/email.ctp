<div class="users form">
	<form action="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'email')) ?>" id="UserEmailForm" method="post" accept-charset="utf-8" name="UserEmailForm">
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST">
		</div>
		<fieldset>
			<legend>Send Email to Users</legend>
			<div class="input select required">
				<?php
					$opts = array(
						'*' => array(
							'output' => "all users",
							'selected' => (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['group'] == "*")
						),
						'student' => array(
							'output' => 'students',
							'selected' => (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['group'] == "student")
						),
						'attendee' => array(
							'output' => 'attendees',
							'selected' => (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['group'] == "attemdee")
						),
						/*'individual' => array(
							'output' => 'individual',
							'selected' => (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['group'] == "individual")
						)*/
					);
				?>
				<label for="UserGroup">Send To</label><select name="data[Email][group]" id="UserType">
					<?php foreach($opts as $value => $stuff){
						echo sprintf('<option value="%s" %s>%s</option>',
							$value,
							($stuff['selected']) ? 'selected="selected"' : '',
							$stuff['output']
						);
					} ?>
				</select>
			</div>
			<div class="input text required">
				<label for="UserEmailDateCreated">Send to users created</label>
				<?php
					$opts = array(
						'<=' => array(
							'output' => 'before',
							'selected' => (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['date_created_comparator'] == "<=")
						),
						'>=' => array(
							'output' => 'after',
							'selected' => (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['date_created_comparator'] == ">=")
						),
					);
				?>
				<select name="data[Email][date_created_comparator]" id="UserEmailDateCreatedComparator">
					<?php foreach($opts as $value => $stuff){
						echo sprintf('<option value="%s" %s>%s</option>',
							$value,
							($stuff['selected']) ? 'selected="selected"' : '',
							$stuff['output']
						);
					} ?>
				</select>
				<input name="data[Email][date_created]" maxlength="255" type="text" id="UserEmailDateCreated" value="<?php echo (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['date_created']) ? $_POST['data']['Email']['date_created'] : date('Y-m-d H:i:s'); ?>">
			</div>
			<div class="input text required">
				<label for="UserEmailSubject">Subject</label><input name="data[Email][subject]" maxlength="255" type="text" id="UserEmailSubject" value="<?php echo (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['subject']) ? $_POST['data']['Email']['subject'] : ''; ?>">
			</div>
			<div class="input text">
				<label for="UserEmailReplyTo">Reply To</label><input name="data[Email][reply_to]" maxlength="255" type="text" id="UserEmailReplyTo" value="<?php echo (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['reply_to']) ? $_POST['data']['Email']['reply_to'] : ''; ?>">
			</div>
			<div class="note">
				The default value for the reply-to field is 'hec@cornell.edu'.
			</div>
			<div class="input textarea required">
				<label for="UserEmailBody">Body</label>
				<textarea name="data[Email][body]" cols="30" rows="6" id="UserEmailBody"><?php echo (isset($_POST) && isset($_POST['data']) && $_POST['data']['Email']['body']) ? $_POST['data']['Email']['body'] : ''; ?></textarea>
			</div>
			<div class="note">
				<p>
					You may include any of the following special items to autofill with the user's information:
				</p>
				<p>
					%%NAME%%, %%FIRST_NAME%%, %%LAST_NAME%%, %%EMAIL%%, %%GRAD_YEAR%%, %%POSITION%%, %%COMPANY%%, %%DATE_PROFILE_CREATED%%, %%BIO%%
				</p>
			</div>
		</fieldset>
		<div class="submit">
			<input type="submit" value="Send">
		</div>
	</form>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
	</ul>
</div>
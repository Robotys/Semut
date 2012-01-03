<?php require_once('header.php');?>
	<h1>Settings for <?php echo $this->settings->blog_name()?></h1>

	<div id="body">
		
		<form method='post'>
			Blog Name: <br/><input type='text' name='blog_name' value='<?php echo $settings['blog_name']?>'/><br/>
			Blog Description: <br/><input type='text' name='blog_description' value='<?php echo $settings['blog_description']?>'/><br/>
			Username: <br/><input type='text' name='username' value='<?php echo $settings['username']?>'/><br/>
			Password: <br/><input type='password' name='password' value=''/><br/>
			Admin Theme: <br/>
							<select name='admin_theme'/>
								<?php
									foreach($admin_themes as $admin){
										echo "<option value='".$admin."'>".$admin."</option>";
									}
								?>
							</select>
						<br/>
			Blog Theme: <br/>
							<select name='blog_theme'/>
								<?php
									foreach($blog_themes as $theme){
										echo "<option value='".$theme."'>".$theme."</option>";
									}
								?>
							</select>
						<br/>
			<input type='submit' value='Update &raquo'/><br/>
			
			
		</form>
	</div>

<?php require_once('footer.php')?>
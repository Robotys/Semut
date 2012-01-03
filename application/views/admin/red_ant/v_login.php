<?php require_once('header.php');?>
	<h1>Welcome to <?php echo $this->settings->blog_name()?></h1>

	<div id="body">
		<p>Login time!</p>

		<form method='post'>
			<table>
				<tr><td>Username: <br/> <input type='text' name='uname'/></td></tr>
				<tr><td>Password: <br/> <input type='password' name='pword'/></td></tr>
				<tr><td><input type='submit' value='login'/></td></tr>
			</table>
		</form>
	</div>

<?php require_once('footer.php')?>
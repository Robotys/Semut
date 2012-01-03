<?php require_once('header.php');?>
	<h1>New Blog Post for <?php echo $this->settings->blog_name()?></h1>
	
	<div class='content_menu'>
	</div>

		
	<div id="body">
		
	
		<?php 
			echo form_open_multipart('yellowpad/uploader');			
			if(isset($error)) echo $error;
			if(isset($upload_data)) echo $upload_data['file_name'].' successfully uploaded';
		?>
		
		<input type='hidden' name='pegi' value='pegi'/>
		
		<input type="file" name="userfile" size="20" />
		
		<input type="submit" value="upload" style='width: auto;' />
		</form>
	</div>
	

<?php require_once('footer.php')?>
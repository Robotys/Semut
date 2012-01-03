<?php require_once('header.php');?>

	<h1>Manage Post for <?php echo $this->settings->blog_name()?></h1>
	
	<div class='content_menu'>
		<!--<a href='<?php echo site_url('yellowpad/uploader')?>'>upload image &raquo; </a>  -->
		
	</div>

	<div id="body">
		<table>
			<tr><th width='450px'>Title <small>click to view</small></th><th>Date</th><th width='120px'>Tag</th><th>Action</th></tr>
			<?php
				//var_dump($table);
				foreach($table as $tr){
					echo "<tr><td><a href='".base_url()."/baca/".str_replace('.txt','.html',$tr['source'])."' target='_blank'>".$tr['title']."</a></td><td>".$tr['date']."</td><td>".$tr['tag']."</td><td>
					<a href='".site_url('yellowpad/edit_post/'.$tr['source'])."' title='edit'>&#10000;</a>
					<a href='".site_url('yellowpad/delete_post/'.$tr['source'])."' title='delete'>&#10006;</a>
					
					</td></tr>";
				}
			?>
		</table>
	</div>
	

<?php require_once('footer.php')?>
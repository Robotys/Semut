<?php require_once('header.php');
	
?>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/wysiwyg.table.js"></script>

<script type='text/javascript'>
	$(function() {
		$("#uploader").hide();
		
		$('#wysiwyg').wysiwyg({
		  controls: {
			bold          : { visible : true },
			italic        : { visible : true },
			underline     : { visible : true },
			strikeThrough : { visible : true },
			
			justifyLeft   : { visible : true },
			justifyCenter : { visible : true },
			justifyRight  : { visible : true },
			justifyFull   : { visible : true },

			indent  : { visible : true },
			outdent : { visible : true },

			subscript   : { visible : true },
			superscript : { visible : true },
			
			undo : { visible : true },
			redo : { visible : true },
			
			insertOrderedList    : { visible : true },
			insertUnorderedList  : { visible : true },
			insertHorizontalRule : { visible : true },
			insertImage  : { visible: true },
			h4: {
				visible: true,
				className: 'h4',
				command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
				arguments: ($.browser.msie || $.browser.safari) ? '<h4>' : 'h4',
				tags: ['h4'],
				tooltip: 'Header 4'
			},
			h5: {
				visible: true,
				className: 'h5',
				command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
				arguments: ($.browser.msie || $.browser.safari) ? '<h5>' : 'h5',
				tags: ['h5'],
				tooltip: 'Header 5'
			},
			h6: {
				visible: true,
				className: 'h6',
				command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
				arguments: ($.browser.msie || $.browser.safari) ? '<h6>' : 'h6',
				tags: ['h6'],
				tooltip: 'Header 6'
			},
			
			cut   : { visible : true },
			copy  : { visible : true },
			paste : { visible : true },
			html  : { visible: true },
			
			increaseFontSize : { visible : true },
			decreaseFontSize : { visible : true },
			/*
			exam_html: {
				exec: function() {
					this.insertHtml('<abbr title="exam">Jam</abbr>');
					return true;
				},
				visible: true
			}*/
		  },
		  events: {
			click: function(event) {
				if ($("#click-inform:checked").length > 0) {
					event.preventDefault();
					alert("You have clicked jWysiwyg content!");
				}
			}
		  },
		  css: '<?php echo base_url()?>assets/editor.css'
		});
		

		// bind form using 'ajaxForm' 
		$('#myForm').ajaxForm({
			dataType: 'json',
			success: processJson
		}); 
		
		function processJson(data){
			//alert(data.message);
			$('.upload_response').html(data.message);
			$('#myForm').resetForm();
			
			get_thumbs();
		};
		
		
		get_thumbs();
		//get thumbnails
		
		function get_thumbs(){
			$.get('<?php echo site_url('yellowpad/get_thumb')?>', function(data){
				$('.thumbnails').html(data);
				
				//set choice of left center and right float to insert image
				$('.thumbnails div').click(function(){
					//alert($(this).attr('rel'));
					$('.choice').hide();
					var choice = "<div class='choice'><span title='left'> left </span><span title='center'> center </span><span title='right'> right </span></div>";
					//$(this).width(200);
					$(this).append(choice);
					
					$('.choice span').click(function(){
						//$("#myForm").($(this).attr('title'));
						//var im = $(this).attr('title');
						//$('#wysiwyg').wysiwyg('insertImage', 'dgfdg');
						var im = $(this).parent().parent().attr('rel');
						var cl = $(this).attr('title');
						$('#wysiwyg').wysiwyg('insertImage', im, {'class':cl});
						//$('.choice').hide();
					});	
				});
				
			});
		}
		
		$('.tag').click(function(){
			//var have = $("input[name=tags]").val();
			if($("input[name=tags]").val() !='') var newt = $("input[name=tags]").val()+", "+$(this).html();
			else var newt = $(this).html();
			$("input[name=tags]").val(newt);
		});
		
		
		
	});
	 
</script>

	<h1>New Blog Post for <?php echo $this->settings->blog_name()?></h1>
	
	<div class='content_menu'>
		<!--<a href='<?php echo site_url('yellowpad/uploader')?>'>upload image &raquo; </a>  -->
		
	</div>

	<div id="body">
	
		<div id='uploader'>
			<div class='upload_box'>
			<h3>Upload Image</h3>
			<form id='myForm' method='post' action='<?php echo site_url('yellowpad/uploader')?>' enctype="multipart/form-data" accept-charset="utf-8">
			<input id="fileupload" type="file" name="userfile[]" multiple>
			
			<input type='submit' value='upload'/> <div class='upload_response'>&laquo; Choose file and click upload to upload image</div>
			</form>
			</div>
			
			<h3>Gallery: (click to insert)</h3>
			<div class='thumbnails'>
				thumbs here
			</div>
			
		</div>
		
		<form method='post'>
			Title: <em><small>will be used in url</small></em><br/>
			<input type='text' name='title' value='<?php echo $post_title?>'/> <br/>		
			
			
			
			
			Content: <em><small>all html can do</small></em><br/>
			<textarea name='content' id='wysiwyg'><?php echo $post_content?></textarea> <br/>
			
			Tags: <em><small>separate by commas i.e: </small></em> <div class='tags'>
			<?php 
			
			$totag = "";
			foreach(get_tags() as $tag=>$count){
				$size = 1 + ($count/10);
				$totag .= "<span class='tag' style='font-size: ".$size."em'>".$tag."</span>";
			}
			echo $totag;
			?>
			</div>
			<br/>			
			<input type='text' name='tags' value='<?php echo $post_tag?>'/> <br/><br/>
			
			<input type='submit' value='Publish Post!'/> <br/>
			
		</form>
	</div>
	
	
	<!--
		<textarea id="messageBody"></textarea>
<input type="button" value="Insert Smiley" 
onclick="insertAtCaret('messageBody',':)');" />
	-->

<?php require_once('footer.php')?>
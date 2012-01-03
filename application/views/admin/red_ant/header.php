<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to <?php echo $this->settings->blog_name();?> powered by SEMUT</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 0px; padding: 0px;		
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px auto;
		
		width: 800px;
	}
	
	#wrapper{
		width: 800px;
		float:left;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	input{
		width: 745px;		
		display: block;
		padding: 10px;
	}
	
	select {
		width: 768px;
		display:block;
		padding: 10px;
	}
	
	input[type=submit]{
		width: 770px;
	}
	
	input[value=upload], input[type=file]{
		width: auto;
		padding: 1px 5px;
		float:left;
	}
	textarea {
		width: 736px;		
		display: block;
		padding: 10px;
		height: 400px;
		font-family: Arial, sans-serif;
	}
	
	.admin {width: 100%; background: #444; float:left;font-size: 10px; margin: -10px 0px 50px 0px; display: block; color: #fff;}
	.left_admin {display: block; float:left; padding: 10px;}
	.right_admin {display: block; float:right; padding: 10px}
	.admin a{color: #ccc;}
	iframe {border: none; height: 50px; width: 767px}
	
	
	#uploader {float:left; width: 750px; padding: 10px;margin-bottom: 10px}
	#uploader h3{margin: 0px;}
	
	.upload_box{width: 100%; float:left; margin-bottom: 20px;}
	input[type=file] {}
	.upload_response{ background: #fffbc2; padding: 0px 6px; margin-top: 2px;border-radius: 3px; border: 1px #ffba00 solid; float:left; width: auto; font-size: 12px; margin-bottom: -1px; margin-left: 5px;}
	
	.thumbnails {float:left;}
	.thumbs{position: relative; vertical-align: top; display:inline-block;width: 105px; height: 105px; background: #eee; text-align:center; padding: 5px; margin: 5px; cursor:pointer;}
	
	.choice {float:left; width: 60px; background: #ccc; position: absolute; top: 25px; left:28px; z-index:100}
	.choice span{float:left; width: 52px; padding: 0px 4px; border-top: 1px solid #ddd; border-bottom: #bbb 1px solid; font-size: 9px; cursor:pointer; text-align: left;}
	.choice span:hover{background: #ddd;}
	
	.tags {font-size: 10px; width: 770px; float:left; margin-bottom: 10px;}
	.tag {padding: 0px 5px; background: #ccc; margin: 1px; display:block; float:left; border-radius: 3px; cursor:pointer;}
	td {padding: 4px 6px;}
	</style>
	
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery.wysiwyg.css" type="text/css"/>
	
	
</head>
<body>
<div class='admin'>	
	<div class='left_admin'><a href='../baca/index.html'>Home</a> | <a href='<?php echo site_url('yellowpad')?>'>Yellow Pad</a> </div>
	
	<div class='right_admin'>
		<a href='<?php echo site_url('yellowpad/post');?>'>New Post</a> | 
		<a href='<?php echo site_url('yellowpad/generate_htmls/');?>'>Regen Post</a> |
		<a href='<?php echo site_url('yellowpad/posts');?>'>Manage Post</a> |
		<a href='<?php echo site_url('yellowpad/blog_setting');?>'>Setting</a>
	</div>
</div>
<div id="container"><div id='wrapper'>
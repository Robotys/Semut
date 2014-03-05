<?php
	require('semut.php');
	// console_log();

?>

<html>
<head>
	<title></title>
	<meta name="elapse_time" value="<?= elapse_time()?>">
	<style>
		/*@import url(http://fonts.googleapis.com/css?family=Allan:700|Merriweather);*/
		@import url(http://fonts.googleapis.com/css?family=PT+Sans+Narrow:700|PT+Serif);
		body{
			font-family: 'PT Serif', Georgia, serif;
			font-size: 1rem;
			line-height: 1.6;
			text-rendering: optimizeLegibility;
		}

		h1,h2,h3,h4,h5{
			font-family: 'PT Sans Narrow', Helvetica, sans-serif;
			text-rendering: optimizeLegibility;
			margin: 0px;
			margin-bottom: -25px;
		}

		h1{font-size: 3em;}
		h2{font-size: 2em;}
		h3{font-size: 1.8em;}
		h4{font-size: 1.5em;}
		h5{font-size: 1.1em;}

		div{
			box-sizing: border-box;
		}

		.center{
			margin: 0 auto;
		}

		.fixedwidth, code{
			max-width: 650px;
		}

		.header{
			border-bottom: 1px #bbb solid;
			margin-bottom: 30px;
			margin-top: 30px; 
		}

		a {
			color: #008aff;
			transition: all 0.5s;
			text-decoration: none;
		}

		a:hover{
			color: #000088;
		}

		a.masthead{
			font-family: 'PT Serif', Georgia, serif;
			font-weight: bold;
			font-size: 5em;
		}

		h1,h2,h3,h5{
			line-height: 1em;
			margin-bottom: 0.4em;
			margin-top: 1em;
		}

		pre{
			background: #444;
			color: #74FF33;
			padding: 15px;
			border-bottom: 2px solid #000;
		}

		code{
			word-wrap: break-word;
		}
/*
		div.post > p:first-child{
			font-size: 1.5em;
		}*/

		blockquote{
			background: #eee;
			color: #444;
			padding: 15px;
			border-left: 4px solid #888;
		}

		.footer{
			border-top: 1px #bbb solid;
			margin: 60px 0;
		}

		img{
			margin: 0 auto;
			display:block;
		}

		footer{
			text-align: center;
			margin-top: 150px;
			margin-bottom: 20px;
			font-size: 0.8em;
			color: #aaa;
		}
	</style>
</head>
<body>
<div class="center fixedwidth"><div class="wrapper">

	<div class="header">
		<a href="<?= base_url();?>" class="masthead">Robotys.net</a>
		<p>Selamat datang ke Robotys.net oleh Izwan Wahab. Tempat beliau mencatat nota dan buah fikiran tentang programming, bisnes dan juga kehidupan. Antara yang menarik adalah perjalan mencapai RM50000 daripada projek sampingan. Cara terbaik untuk mengikuti kemaskini artikel di sini adalah dengan subscribe ke dalam newsletter mingguan beliau. Tiada spam, hanya perkongsian terhad! </p>		
	</div>

	<div class="post">
		<?php echo $html; ?>
	</div>

	<div class="footer">
		<h2>Artikel-artikel lain:</h2>
		<p class="column">
		<ul>
			<?php article_links();?>
			<li><a href="<?= site_url('all/post')?>">all post &raquo;</a></li>
		</ul>
		</p>

	</div>

	<footer>
		all rights reserved &copy; <?= date('Y');?> Robotys.net
	</footer>



</div></div>
</body>
</html>
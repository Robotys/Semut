<?php
	require('semut.php');
	// console_log();
?>

<html>
<head>
	<title></title>
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
			width: 650px;
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

		pre{
			background: #444;
			color: #74FF33;
			padding: 15px;
			border-bottom: 2px solid #000;
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
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
			<li><a href="">Tajuk Lain</a></li>
		</ul>
		</p>

	</div>

	<div class="subscribe">
		<form method="post"><input type="text" name="name" placeholder="nama"/><input type="text" name="email" placeholder="email"/><input type="submit" value="subscribe &raquo;"/></form>
	</div>

</div></div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
	<head>

		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="@julioelpoeta">

		<meta charset="utf-8">

		<title>InstaTake PHP</title>

		<!-- Bootstrap core CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">


		<link rel="stylesheet" type="text/css" href="/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="/css/slider.css"/>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="site-wrapper">
			<div class="inner cover">
				<div class="page-header">
					<h1 class="cover-heading">INSTATAKE.PHP</h1>
				</div>
				<!-- 		Success alert		 -->
				<div id="downloadDone" class="alert alert-success alert-dismissible" role="alert" style="display:none;">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong>The backup has finished!</strong> Go to your filesystem to check it.
				</div>

				<!-- 		Warning alert		 -->
				<?php if(empty($folder_path)) { ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						You need to set the folder path ($folder_path) on your config file before doing the backups.
					</div>
				<?php } ?>

				<!-- 		Error alert		 -->
				<div id="downloadFailed" class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<span id="errorMsg">Something went wrong. Please, try again or contact the dev.</span>
				</div>

				<div class="jumbotron">
					<p class="lead">With <strong>INSTATAKE.PHP</strong> you can back up all the pictures of your instagram account or download all the pictures from your most beloved instagrammers.
					Just fill the username and click "Download".</p>
				</div>

				<center>
					<div class=slider-cont>
						Select how many pics you want to download at max. </br>
						<input id="ex7" type="text" data-slider-min="1" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $max_number_images; ?>" data-slider-enabled="false"/>
						<input id="ex7-enabled" type="checkbox"/> Custom max value
					</div>
					<input id="search" type="search" class="form-control" placeholder="Instagram username" required autofocus>
					</br>
					<a id="download" class="btn btn-lg btn-warning has-spinner" <?php if(empty($folder_path)) echo 'disabled="disabled"'; ?> >
						<span class="spinner"><i class="icon-spin icon-refresh"></i></span>
						Download
					</a>
				</center>
			</div>

			<div class="mastfoot">
				<center>
					<div class="inner">
					<p>Project by <a href="https://twitter.com/julioelpoeta" target="_blank">@julioelpoeta</a>, inspired by the <a href="http://instatake.com" target="_blank">work</a> of
						<a href="https://twitter.com/duplikey" target="_blank" >@duplikey</a>.</p>
					</div>
				</center>
			</div>

		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap-slider.js"></script>
		<script type="text/javascript" src="/js/global.js"></script>
	</body>
</html>

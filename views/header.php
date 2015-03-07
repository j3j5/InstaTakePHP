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

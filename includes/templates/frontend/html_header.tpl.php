<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"  lang="en" dir="ltr"><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"  lang="en" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"  lang="en" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="lt-ie9"  lang="en" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html  lang="en" dir="ltr"><!--<![endif]-->

<head profile="http://www.w3.org/1999/xhtml/vocab">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="AUSaving content delivery team">
  <link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon" />
  <title><?php echo $data->title; ?></title>
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  
  <!-- Bootstrap CDN -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  
  <!--
  <link rel="stylesheet" href="/libraries/bootstrap-3.1.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/libraries/bootstrap-3.1.1/dist/css/bootstrap-theme.min.css">
  <script src="/libraries/bootstrap-3.1.1/dist/js/bootstrap.min.js"></script>
  -->


  <script type="text/javascript" src="/<?php echo $data->level; ?>js/script.js"></script>
  <link rel='stylesheet' href='/<?php echo $data->level; ?>css/style.css' type='text/css' media='all' />

</head>

<body <?php echo isset($data->body_class) ? "class='$data->body_class'" : "" ?>>
<?php if (!is_dev()): ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50665711-3', 'ausaving.com');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
<?php endif; ?>


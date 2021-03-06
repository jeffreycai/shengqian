<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"  lang="zh-CN" dir="ltr"><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"  lang="zh-CN" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"  lang="zh-CN" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="lt-ie9"  lang="zh-CN" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html lang="zh-CN" dir="ltr"><!--<![endif]-->

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

  <script type="text/javascript" src="/<?php echo $data->level; ?>libraries/bootstrap-datepicker/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="/<?php echo $data->level; ?>libraries/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="/<?php echo $data->level; ?>js/backend.js"></script>
  <!-- <link rel='stylesheet' href='/<?php echo $data->level; ?>css/reset.css' type='text/css' media='all' /> -->
  <link rel='stylesheet' href='/<?php echo $data->level; ?>css/dashboard.css' type='text/css' media='all' />
  <link rel='stylesheet' href='/<?php echo $data->level; ?>libraries/bootstrap-datepicker/datepicker.css' media='all' />
  <link rel='stylesheet' href='/<?php echo $data->level; ?>css/style.css' type='text/css' media='all' />

</head>

<body class="admin <?php if (isset($data->body_class)) {echo $data->body_class; }?>">


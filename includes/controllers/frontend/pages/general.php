<?php
$slug = $vars[1];

$page = Page::findBySlug($slug);

// forward 404 if page does not exist
if (!$page) {
  HTML::forward('/404');
}

die('in');
<?php

/** views **/

header("HTTP/1.0 404 Not Found");

$html = new HTML();

$html->renderOut('html_header', array(
  'title' => 'Page does not exist' . ' :: Phone list :: Transport for NSW',
));

// header
//$html->renderOut('header');

// body
$html->output('<!-- #body -->');
$html->output('<section id="body" class="inner box">');

$html->output('<h1>Page not found</h1>');

$html->output('<p>The page you are looking for does not exist.</p>');
//$html->renderOut('top_navigator');

$html->output('</section>');
$html->output('<!-- /#body -->');

// footer
//$html->renderOut('footer');
$html->renderOut('html_footer');



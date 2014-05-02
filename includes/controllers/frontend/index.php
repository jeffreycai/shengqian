<?php

$html = new HTML();
$html->renderOut('frontend/html_header', array('title' => 'Homepage'));

$html->output('
  <div class="navbar-wrapper">
    <div class="container">
    ' . $html->render('frontend/nav/main', array('current_url' => get_cur_page_url(true))) . '
    </div>
  </div>
');



echo $html->render('frontend/jumbotron/homepage');
echo $html->render('frontend/html_footer');

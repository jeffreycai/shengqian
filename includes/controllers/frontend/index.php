<?php
global $conf;

$html = new HTML();
$html->renderOut('frontend/html_header', array(
    'title' => 'Homepage',
    'body_class' => 'home'
));

$html->renderOut('frontend/nav/main', array(
    'current_url' => get_cur_page_url(true),
    'site_name_html' => $conf['site_name_html'],
    'categories' => $conf['category']
));
$html->renderOut('frontend/sidemenu');
$html->renderOut('frontend/jumbotron/homepage');
$html->renderOut('frontend/homepage', array(
    'promoted_deals' => Deal::getAllPromoted()
));

$html->renderOut('frontend/html_footer');

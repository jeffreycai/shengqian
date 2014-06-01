<?php
global $conf;

$html = new HTML();
$html->renderOut('frontend/html_header', array(
    'title' => 'AuSaving 澳洲省钱网是全澳大利亚最大、最全的折扣信息、省钱攻略以及优惠消息发布集散地',
    'body_class' => 'home'
));

$html->renderOut('frontend/nav/main', array(
    'current_url' => get_cur_page_url(true),
    'site_name_html' => $conf['site_name_html'],
    'categories' => $conf['category']
));
$html->renderOut('frontend/sidemenu');
$html->renderOut('frontend/jumbotron/homepage');
$html->renderOut('frontend/homepage');
$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');

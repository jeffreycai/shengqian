<?php
$deal_id = isset($vars[1]) ? $vars[1] : null;
if (is_null($deal_id)) {
  HTML::forward('/404');
}
$deal = SydneytodayDeal::findById($deal_id);
if (!$deal) {
  HTML::forward('/404');
}

$html = new HTML();
$html->renderOut('frontend/html_header_tracking', array('title' => $deal->getTitle()));
$html->renderOut('frontend/html_footer_tracking');

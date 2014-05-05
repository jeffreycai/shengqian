<?php
$did = isset($vars[1]) ? strip_tags($vars[1]) : null;
if (is_null($did)) {
  HTML::forward('/404');
}
$deal = SydneytodayDeal::findById($did);
if (!$deal) {
  HTML::forward('/404');
}

$deal = SydneytodayDeal::findById($did);

$instance = new SydneytodayDealInstance();
$instance->setDeal($deal);
$instance->setCreatedAt(time());
$instance->save();

<?php
$did = isset($vars[1]) ? strip_tags($vars[1]) : null;
if (is_null($did)) {
  HTML::forward('/404');
}
$deal = SydneytodayDeal::findById($did);
if (!$deal) {
  HTML::forward('/404');
}


global $conf;
// login to sydneytoday first
$user = new SydneytodayUser($conf['sydneytoday']['username'], $conf['sydneytoday']['password']);
$user->login($conf['sydneytoday']['loginurl']);

$deal = SydneytodayDeal::findById($did);
$now = time();

$instance = new SydneytodayDealInstance();
$instance->setDeal($deal);
$instance->setCreatedAt($now);
$instance->save();
$deal->setLastPublished($now);
$deal->save();

echo time_ago($now);
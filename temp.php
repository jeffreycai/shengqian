<?php
include_once 'bootstrap.php';
$i = 0;
foreach (SydneytodayDeal::findAllByDeleted(0) as $syddeal) {
  $deal = new Deal();
  $deal->setTitle($syddeal->getTitle());
  $deal->setSlug('slug-'. $i++);
  
  $type = $syddeal->getType();
  $cid;
  switch ($type) {
    case SydneytodayDeal::TYPE_FASHION:
      $cid = 'event'; break;
    case SydneytodayDeal::TYPE_FOOD:
      $cid = 'food'; break;
    case SydneytodayDeal::TYPE_FREE:
      $cid = 'goods'; break;
    case SydneytodayDeal::TYPE_OTHER:
      $cid = 'goods'; break;
    case SydneytodayDeal::TYPE_TECH:
      $cid = 'goods'; break;
  }
  
  $deal->setCid($cid);
  $deal->setUrl($syddeal->getGrouponLink());
  $deal->setDetails('<p>' . str_replace("\n", "<br />", $syddeal->getDetails()) . '</p>');
  $deal->setImage($syddeal->getImage());
  $deal->setPublished(1);
  $deal->setCreatedAt(time());
  $deal->save();
}

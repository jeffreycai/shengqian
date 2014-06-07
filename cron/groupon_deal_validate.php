<?php

// prevent call from webserver
if (PHP_SAPI != 'cli') {
  exit();
}

require_once __DIR__ . '/../bootstrap.php';

$group_deals = Deal::findAllGrouponDealByValid(1);
$report = array();
foreach ($group_deals as $deal) {
  $deal->checkValid();
  if (!$deal->getValid()) {
    $report[] = $deal;
  }
}

SydneytodayDealInstance::sendInvalidReport($report);

echo "Success!\n";
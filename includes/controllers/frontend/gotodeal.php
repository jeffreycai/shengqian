<?php
$id = $vars[1];
if ($deal = Deal::findById($id)) {
  HTML::secretForward($deal->getUrl());
} else {
  HTML::forward('/404');
}
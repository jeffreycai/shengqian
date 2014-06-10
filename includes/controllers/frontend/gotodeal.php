<?php
$id = $vars[1];
if ($deal = Deal::findById($id)) {
  HTML::forward($deal->getUrl());
} else {
  HTML::forward('/404');
}

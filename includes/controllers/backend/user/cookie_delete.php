<?php
$user = new SydneytodayUser();
if (!is_file($user->getCookiePath())) {
  setMsg(MSG_WARNING, 'Sydneytoday user cookie has already been deleted.');
} elseif ($user->deleteCookie()) {
  setMsg(MSG_SUCCESS, 'Sydneytoday user cookie file deleted successfully!');
} else {
  setMsg(MSG_ERROR, 'Oops.. Something goes wrong when deleting Sydneytoday user cookie file.');
}
HTML::forwardBackToReferer();
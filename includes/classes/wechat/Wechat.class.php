<?php
class Wechat {
  private function setUsername($un) {
    $this->username = $un;
  }
  
  private function setPassword($pw) {
    $this->password = $pw;
  }
  
  public function login($tor = false) {
    $login_url = 'https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN';
    // if cookie was created less than 30 days, do not redo login
//    if ($this->check_cookie()) {
//      return;
//    }
    // otherwise do login
    // username=jeffreycaizhenyuan%40gmail.com&pwd=2ff8a4badc2e1bfab7eadbf8247d563c&imgcode=&f=json
    
    $curl = new Curl($this->getCookiePath());
    $result = $curl->post(
            $login_url,
            "username=jeffreycaizhenyuan%40gmail.com&pwd=2ff8a4badc2e1bfab7eadbf8247d563c&imgcode=&f=json",
            'https://mp.weixin.qq.com',
            $tor,
            true
    );
    if (strpos($result, '"err_msg":"ok"') == FALSE) {
      die('login to wechat failed.');
    } else {
      $tokens = array();
      preg_match('/token=(\d+)/', $result, $tokens);
      $token = isset($tokens[1]) ? $tokens[1] : null;
      return $token;
    }
  }
  
  public function getCookiePath() {
    return CACHE_DIR . DS . 'wechat_cookie.txt';
  }
  
  private function check_cookie($valid_days = 1) {
    // do nothing if the cookie file is created less than 25 days ago
    if (file_exists($this->getCookiePath())) {
      if (  (time() - filectime($this->getCookiePath())) < $valid_days * 24 * 60 * 60  ) {
        return true;
      }
    }
    
    // otherwise, create a blank file
    $this->flush_cookie();
    return false;
  }
  
  private function flush_cookie() {
    $f = fopen($this->getCookiePath(), 'w');
    fclose($f);
  }
  
  public function deleteCookie() {
    if (is_file($this->getCookiePath())) {
      return unlink($this->getCookiePath());
    }
  }
}
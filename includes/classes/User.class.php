<?php
class User {
  private $username;
  private $password;
  
  public function __construct($username = null, $password = null) {
    $this->username = $username;
    $this->password = $password;
  }
  
  public function getUsername() {
    return $this->username;
  }
  public function getPassword() {
    return $this->password;
  }
  
  public function login($login_url) {
    $this->check_cookie();
  }
  
  private function getCookiePath() {
    return CACHE_DIR . 'cookie.txt';
  }
  
  private function check_cookie($valid_days = 25) {
    // do nothing if the cookie file is created less than 25 days ago
    if (file_exists($this->getCookiePath())) {
      if (  (time() - filectime($this->getCookiePath())) < $valid_days * 24 * 60 * 60  ) {
        return;
      }
    }
    
    // otherwise, create a blank file
    $this->flush_cookie();
  }
  
  private function flush_cookie() {
    $f = fopen($this->getCookiePath());
    fclose($f);
  }
}
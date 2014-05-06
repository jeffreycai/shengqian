<?php
class SydneytodayUser {
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
  
  /**
   * login to Sydneytoday
   * 
   * @param type $login_url
   * @return type
   */
  public function login($login_url) {
    global $conf;
    // if cookie was created less than 30 days, do not redo login
    if ($this->check_cookie()) {
      return;
    }
    // otherwise do login
    // username=jeangirl186%40163.com&password=0172122a&cookietime=2592000&step=2&fromurl=http%3A%2F%2Fwww.sydneytoday.com%2F
    $ch = curl_init($login_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // whether to print out or not when curl_exec();
    curl_setopt($ch, CURLOPT_HEADER, 0); // whether to include HEADER in output
    curl_setopt($ch, CURLOPT_COOKIEFILE, $this->getCookiePath());
    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->getCookiePath()); // where to put cookie after curl_close()
    curl_setopt($ch, CURLOPT_USERAGENT, $conf['curl']['useragent']);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=" . urlencode($this->getUsername()) . "&password=" . urlencode($this->getPassword()) . "&cookietime=2592000&step=2&fromurl=http%3A%2F%2Fwww.sydneytoday.com%2F");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Follow redirect or not
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // Max redirects to follow. Use it along with CURLOPT_FOLLOWLOCATION

    $result = curl_exec($ch);
    curl_close($ch);
    if (strpos($result, 'history.back(-1);')) {
      die('Sydneytoday login failed.');
    }
  }
  
  public function getCookiePath() {
    return CACHE_DIR . DS . 'sydneytoday_cookie.txt';
  }
  
  private function check_cookie($valid_days = 25) {
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
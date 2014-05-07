<?php
class Curl {
  private $cookie_path;
  private $user_agent;
  
  public function __construct($cookie_path) {
    global $conf;
    $this->setCookiePath($cookie_path);
    $this->setUserAgent($conf['curl']['useragent']);
  }
  
  public function setCookiePath($path) {
    $this->cookie_path = $path;
  }
  public function getCookiePath() {
    return $this->cookie_path;
  }
  public function setUserAgent($ua) {
    $this->user_agent = $ua;
  }
  public function getUserAgent() {
    return $this->user_agent;
  }


  public function read($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // whether to print out or not when curl_exec();
    curl_setopt($ch, CURLOPT_HEADER, 0); // whether to include HEADER in output
    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->getCookiePath()); // where to put cookie after curl_close()
    curl_setopt($ch, CURLOPT_USERAGENT, $this->getUserAgent());
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }
  
  
  public function post($url, $data, $referer = null) {
    $cookie_path = $this->getCookiePath();
    $user_agent = $this->getUserAgent();
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // whether to print out or not when curl_exec();
    curl_setopt($ch, CURLOPT_HEADER, 0); // whether to include HEADER in output
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_path);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_path); // where to put cookie after curl_close()
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    
    if ($referer) {
      curl_setopt($ch, CURLOPT_REFERER, $referer);
    }

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Follow redirect or not
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // Max redirects to follow. Use it along with CURLOPT_FOLLOWLOCATION

    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
  }
}
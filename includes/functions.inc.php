<?php
/**
 * Auto-load register
 * 
 * @param type $class
 */
function custom_loader($class) {
  if (is_file(CLASS_DIR . DS . $class . '.class.php')) {
    include(CLASS_DIR . DS . $class . '.class.php');
  } elseif (is_file(CLASS_DIR . DS . 'sydneytoday' . DS . $class . '.class.php')) {
    include(CLASS_DIR . DS . 'sydneytoday' . DS . $class . '.class.php');
  } elseif (is_file(CLASS_DIR . DS . 'deal' . DS . $class . '.class.php')) {
    include(CLASS_DIR . DS . 'deal' . DS . $class . '.class.php');
  } elseif (is_file(CLASS_DIR . DS . 'wechat' . DS . $class . '.class.php')) {
    include(CLASS_DIR . DS . 'wechat' . DS . $class . '.class.php');
  }
}

/**
 * Dispatch to a controller
 * 
 * @param type $controller
 */
function dispatch($controller, $vars = array()) {
  $controller_file = dirname(__FILE__) . DS . 'controllers' . DS . $controller . ".php";
  if (is_file($controller_file)) {
    require_once $controller_file;
  } else {
    die("Controller '$controller' does not exist.");
  }
}

/**
 * Check if the current user is login or not
 */
function isLogin() {
  return isset($_SESSION['login']) && $_SESSION['login'] == true;
}

/**
 * Login the user
 */
function login($username) {
  $_SESSION['login'] = true;
  $_SESSION['username'] = $username;
}

/**
 * Logout the user
 */
function logout() {
  unset($_SESSION['login']);
  unset($_SESSION['username']);
  HTML::forward('/login');
}

/**
 * Print out a var
 * 
 * @param type $var
 * @param type $html
 */
function _debug($var, $html = true) {
  if ($html) {
    echo "<pre>";
  }
  var_dump($var);
  if ($html) {
    echo "</pre>";
  }
  die();
}

/**
 * Setup a Massage
 * 
 * @param type $type
 * @param type $text
 */
function setMsg($type, $text) {
  $_SESSION[$type] = $text;
}

/**
 * Get a Massage and clear it
 * 
 * @param type $type
 * @return type
 */
function getMsg($type) {
  $msg = null;
  if (isset($_SESSION[$type])) {
    $msg = $_SESSION[$type];
    unset($_SESSION[$type]);
  }
  return $msg;
}

/**
 * render a single massage
 * 
 * @param type $type
 */
function renderMsg($type) {
  $msg = getMsg($type);
  if ($msg) {
    $rtn = "
<div id='msg' class='alert alert-$type'>
  $msg
</div>
";
  }
  return isset($rtn) ? $rtn : '';
}

/**
 * render all messages
 */
function renderMsgs() {
  $msgs = renderMsg(MSG_SUCCESS);
  $msgs.= renderMsg(MSG_WARNING);
  $msgs.= renderMsg(MSG_ERROR);

  return $msgs;
}


function app_requirement_check() {
  if (!is_dir(CACHE_DIR) || !is_writable(CACHE_DIR)) {
    die("'cache' folder needs to be writable.");
  }
}

/**
* Update a $_REQUEST parameter value and output the query string
*/
function update_query_string($input) {
  $url = explode('?', get_cur_page_url()); 
  $url = $url[0];
  $params = $_REQUEST;
  foreach ($input as $key => $val) {
    $params[$key] = $val;
  }
  return $url . build_query_string($params);
}

/**
* Get current page url
*/
function get_cur_page_url($with_domain = false) {
  global $cur_page_url;
  if (isset($cur_page_url)) {
    return $cur_page_url;
  }
  
 $pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 if (!$with_domain) {
   return preg_replace('/^https?:\/\/[^\/]+/', '', $pageURL);
 }
 $cur_page_url = $pageURL;
 return $cur_page_url;
}

/**
* Build GET query string from drupal_get_query_parameters()
*/
function build_query_string($params) {
  $rtn = array();
  foreach ($params as $key => $val) {
    if (empty($val)) {
      continue;
    }
    
    // we only build query string with the params related with phonelist application
    if (!in_array($key, array('page', 'sort', 'keyword', 'shortcut', 'id', 'order', 'agency'))) {
      continue;
    }
    
    $key = urlencode(strip_tags($key));
    $val = urlencode(strip_tags($val));
    $rtn[] = $key.'='.$val;
  }
  return '?'.implode('&', $rtn);
}

/**
 * echo "active" class for a link according to the current page url
 * 
 * @param type $active_url
 * @param type $current_url
 * @param type $class
 */
function echo_link_active_class($active_url, $current_url, $class='active') {
  global $conf;

  if ("$active_url" == $current_url) {
    echo " class='$class' ";
  }
}

/**
 * convert a time stamp to time ago
 * 
 * @param type $ptime
 * @return string
 */
function time_ago($ptime) {
  $etime = time() - $ptime;
  if ($etime < 1) {
    return '0 seconds';
  }
  $a = array( 12 * 30 * 24 * 60 * 60  =>  '年',
              30 * 24 * 60 * 60       =>  '月',
              24 * 60 * 60            =>  '日',
              60 * 60                 =>  '小时',
              60                      =>  '分钟',
              1                       =>  '秒'
  );

  foreach ($a as $secs => $str) {
    $d = $etime / $secs;
    if ($d >= 1)
    {
      $r = round($d);
//      return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
      return $r . ' ' . $str . '之前';
    }
  }
}

function loadLibraryWideImage() {
  require_once  WEBROOT . DS . 'includes' . DS . 'libraries' . DS . 'wideimage' . DS . 'lib' . DS . 'WideImage.php';
}

function generateRandomChars($len = 10) {
  return 'a'.substr(md5(rand(0,9999)), 0, $len);
}

function resetSpamTokens() {
  $_SESSION['spam_key'] = generateRandomChars();
  $_SESSION['spam_val'] = generateRandomChars();
}
function getSpamKey() {
  return $_SESSION['spam_key'];
}
function getSpamVal() {
  return $_SESSION['spam_val'];
}

function html_to_text($html) {
  $rtn = preg_replace('/<\/?p([^>]+)?>/', '', $html);
  $rtn = preg_replace('/<\/?a([^>]+)?>/', '', $rtn);
  $rtn = preg_replace('/<img[^>]+\/?>/', '', $rtn);
  $rtn = preg_replace('/<br ?\/?>/', "\n", $rtn);
  $rtn = preg_replace('/<\/?strong>/', '', $rtn);
  $rtn = preg_replace('/<\/?blockquote>/', '', $rtn);

  
  $rtn = preg_replace('/<\/?[u|o]l>/', '', $rtn);
  $rtn = preg_replace('/<li>/', '- ', $rtn);
  $rtn = preg_replace('/<\/li>/', '', $rtn);
  return $rtn;
}

/**
 * Check if the request comes from wechat
 * 
 * @return boolean
 */
function comeFromWechat() {
  $flag = isset($_SESSION['come_from_wechat']) ? $_SESSION['come_from_wechat'] : false;
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
  // if flag already set, return true
  if ($flag) {
    return true;
  // if flag not set, check referer, if wechat, set to true
  } else {
    if (strpos($referer, 'mp.weixin.qq.com')) {
      $_SESSION['come_from_wechat'] = true;
      return true;
    }
    return false;
  }
}

function setWechatShareConfirmed() {
  $_SESSION['wechat_share_confirmed'] = true;
}

function getWechatShareConfirmed() {
  return isset($_SESSION['wechat_share_confirmed']) ? $_SESSION['wechat_share_confirmed'] : false;
}

function is_dev() {
  if (strpos(WEBROOT, 'dev-ausaving')) {
    return true;
  }
  return false;
}

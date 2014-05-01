<?php
require('bootstrap.php');

/** rounting **/
$query_string = $_SERVER['QUERY_STRING'];
$uri = str_replace('?' . $query_string, '', $_SERVER['REQUEST_URI']);

// try to match a route
foreach ($conf['routing'] as $route) {
  $path = $route['path'];
  $isSecure = $route['isSecure'];
  $controller = $route['controller'];
  
  $vars = array();
  if (preg_match('/'.$path.'/', $uri, $vars)) {
    if ($isSecure && !isLogin()) {
      dispatch('login');
    } else {
      dispatch($controller, $vars);
    }
    exit;
  }
}
// if no route matches, dispatch to 404
dispatch('404');
exit;


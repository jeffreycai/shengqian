<?php
global $conf;

// we only do stuff when the user is not login
if (!isLogin()) {
  $isSubmit = isset($_POST['submit']) ? true : false; // is submission or not;
  // deal with form submission
  if ($isSubmit) {
    // authentication
    $authentication_success = false;
    $username = isset($_POST['username']) ? strip_tags($_POST['username']) : null;
    $password = isset($_POST['password']) ? strip_tags($_POST['password']) : null;
    foreach($conf['backend_user'] as $un => $pwd) {
      if ($un == $username && $pwd == $password) {
        $authentication_success = true;
      }
    }
    // if success
    if ($authentication_success) {
      login($username);
      
      HTML::forward();
    // if fail
    } else {
      setMsg(MSG_ERROR, 'Username or password incorrect. Please try again.');;
    }
    
  // if not form submission, show the login form
  }
  
  
      /** views **/
      $html = new HTML();

      $html->renderOut('backend/html_header', array(
        'title' => 'Login',
      ));

      // header
      $html->renderOut('backend/header');

      // body
      $html->output('<!-- #body -->');
      $html->output('<section id="body" class="inner box">');

      $html->renderOut('login');
      
      $html->output('</section>');
      $html->output('<!-- /#body -->');

      // footer
//      $html->renderOut('footer');
      $html->renderOut('backend/html_footer');
      
      exit;
      
// if already login, go to admin home apge
} else {
  HTML::forward('/admin');
}



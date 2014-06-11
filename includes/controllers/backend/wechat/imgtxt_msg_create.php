<?php
//-- handle submission
if (isset($_POST['submit'])) {
  $ids = strip_tags(trim($_POST['ids']));
  // validation
  if (!preg_match('/^(\d*,)+\d*$/', $ids)) {
    setMsg(MSG_ERROR, 'IDs format not correct');
  } else {
    $ids = explode(',', $ids);
    $deals = array();
    foreach ($ids as $id) {
      $deal = Deal::findById($id);
      if (!$deal) {
        setMsg(MSG_ERROR, 'Deal with ID "' . $id . '" does not exist.');
      } else {
        $deals[] = $deal;
        $wechat = new Wechat();
        $token = $wechat->login();
        _debug($token . '');
      }
    }
  }
}

//-- otherwise, show the create form
$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Create a Image Test Msg'));
echo $html->render('backend/header');

?>

<div class="main">
  <?php $html->renderOut('backend/wechat/nav'); ?>
  <h2 class='sub-header'>
    创建一个新的图文消息
  </h2>
  <?php echo $html->render('backend/wechat/imgtxt_msg_form'); ?>
</div>

<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');


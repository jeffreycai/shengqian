<?php 
$html = new HTML();

$html->renderOut('backend/html_header', array('title' => 'Wechat'));
$html->renderOut('backend/header');

?>

<div class="main">
  <?php $html->renderOut('backend/wechat/nav'); ?>
  <h3 class='sub-header'>功能设置</h3>
  <?php echo renderMsgs(); ?>
  <div class="row placeholders">
    <ul class="nav nav-pills">
      <li><a href="/admin/wechat/user/flush-cookie">清除用户Cookie信息</a></li>
    </ul>
  </div>
<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');
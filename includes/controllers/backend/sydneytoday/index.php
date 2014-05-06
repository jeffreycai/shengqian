<?php 
$html = new HTML();

$html->renderOut('backend/html_header', array('title' => 'Sydneytoday'));
$html->renderOut('backend/header');
$html->renderOut('backend/sydneytoday/sidebar');
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <?php $html->renderOut('backend/sydneytoday/nav'); ?>
  <h3 class='sub-header'>功能设置</h3>
  <?php echo renderMsgs(); ?>
  <div class="row placeholders">
    <ul class="nav nav-pills">
      <li><a href="/admin/sydneytoday/user/flush-cookie">清除用户Cookie信息</a></li>
    </ul>
  </div>
<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');
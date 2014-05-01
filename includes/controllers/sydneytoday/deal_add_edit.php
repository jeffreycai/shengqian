<?php
//-- if this is a submit action, create the record
if (isset($_POST['submit'])) {
  $title        = isset($_POST['title'])        ? $_POST['title']        : null;
  $details      = isset($_POST['details'])      ? $_POST['details']      : null;
  $image        = isset($_POST['image'])        ? $_POST['image']        : null;
  $groupon_link = isset($_POST['groupon_link']) ? $_POST['groupon_link'] : null;
  $type         = isset($_POST['type'])         ? $_POST['type']         : null;
  $contact      = isset($_POST['contact'])      ? $_POST['contact']      : null;
  $hoster       = isset($_POST['hoster'])       ? $_POST['hoster']       : null;
  $id           = isset($_POST['id'])           ? $_POST['id']           : null;
  
  $is_new = $id ? false : true;
  
  if ($is_new) {
    $deal = new SydneyTodayDeal();
  } else {
    $deal = SydneyTodayDeal::findById($id);
  }
  
  $deal->setTitle($title);
  $deal->setDetails($details);
  $deal->setImage($image);
  $deal->setGrouponLink($groupon_link);
  $deal->setType($type);
  $deal->setContact($contact);
  $deal->setHoster($hoster);
  $deal->save();
  
  if ($is_new) {
    setMsg(MSG_SUCCESS, '新折扣信息任务创建成功！');
    HTML::forward('/sydneytoday/deal/add');
  } else {
    setMsg(MSG_SUCCESS, '折扣信息任务修改成功！');
    HTML::forward('/sydneytoday/deal/list');
  }
}

//-- otherwise, show the create form
$html = new HTML();

echo $html->render('html_header', array('title' => 'Create a Deal'));
echo $html->render('header');

echo $html->render('sydneytoday/sidebar');
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class='page-header'>今日悉尼</h1>
  <h2 class='sub-header'>创建折扣信息任务</h2>
  <?php echo $html->render('sydneytoday/deal_form'); ?>
</div>

<?php

echo $html->render('footer');
echo $html->render('html_footer');


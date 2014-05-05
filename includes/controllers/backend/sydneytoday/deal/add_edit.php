<?php
//-- if this is a submit action, create the record
$deal = null;
if (isset($_POST['submit'])) {
  // http://www.sydneytoday.com/bencandy.php?fid=12&id=166758
  $id = isset($_POST['id']) ? $_POST['id'] : null;
  $title = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
  $details = isset($_POST['details']) ? strip_tags($_POST['details']) : null;
  $image = isset($_POST['image']) ? strip_tags($_POST['image']) : null;
  $groupon_link = isset($_POST['groupon_link']) ? strip_tags($_POST['groupon_link']) : null;
  $type = isset($_POST['type']) ? strip_tags($_POST['type']) : null;
  $contact = isset($_POST['contact']) ? strip_tags($_POST['contact']) : null;
  $hoster = isset($_POST['hoster']);
  
  
  
  // TODO - validation
  
  // create / update deal
    $deal = new SydneytodayDeal();
    if ($id) {
      $deal->setId($id);
    }
    if (!empty($title)) $deal->setTitle($title);
    if (!empty($details)) $deal->setDetails($details);
    if (!empty($image)) $deal->setImage($image);
    if (!empty($groupon_link)) $deal->setGrouponLink($groupon_link);
    if (!empty($type)) $deal->setType($type);
    if (!empty($contact)) $deal->setContact($contact);
    if (!empty($hoster)) $deal->setHoster($hoster);
    $deal->save();
    
    setMsg(MSG_SUCCESS, '折扣信息创建成功！');
    HTML::forwardBackToReferer();

} else {
  $id = isset($vars[1]) ? $vars[1] : null;
  $html = new HTML();
  if ($id) {
    $deal = SydneyTodayDeal::findById($id);
  }
}

//-- otherwise, show the create form
$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Create a Deal'));
echo $html->render('backend/header');

echo $html->render('backend/sydneytoday/sidebar');
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <?php $html->renderOut('backend/sydneytoday/deal/nav'); ?>
  <h2 class='sub-header'>
    <?php if ($deal): ?>
    编辑折扣信息：“<?php echo $deal->getTitle(20); ?>”;
    <?php else: ?>
    创建一个新的折扣信息
    <?php endif; ?>
  </h2>
  <?php echo $html->render('backend/sydneytoday/deal/form', array('deal' => $deal)); ?>
</div>

<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');


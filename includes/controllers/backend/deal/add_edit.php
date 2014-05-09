<?php
//-- if this is a submit action, create the record
$deal = null;
if (isset($_POST['submit'])) {
  // http://www.sydneytoday.com/bencandy.php?fid=12&id=166758
  $id = isset($_POST['id']) ? $_POST['id'] : null;
  $cid = isset($_POST['cid']) ? $_POST['cid'] : null;
  $title = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
  $url = isset($_POST['url']) ? strip_tags($_POST['url']) : null;
  $coupon_code = isset($_POST['coupon_code']) ? strip_tags($_POST['coupon_code']) : null;
  $details = isset($_POST['details']) ? strip_tags($_POST['details']) : null;
  $image = isset($_POST['image']) ? strip_tags($_POST['image']) : null;
  $saving = isset($_POST['saving']) ? strip_tags($_POST['saving']) : null;
  $discount = isset($_POST['discount']) ? strip_tags($_POST['discount']) : null;
  $published = isset($_POST['published']) ? strip_tags($_POST['published']) : null;
  $promoted = isset($_POST['promoted']) ? strip_tags($_POST['promoted']) : null;
  $hoster = isset($_POST['hoster']) ? strip_tags($_POST['hoster']) : null;
  $due = isset($_POST['due_date']) ? strip_tags($_POST['due_date']) : null;
  
  
  
  // TODO - validation
  
  // create / update deal
    $deal = new Deal();
    if ($id) {
      $deal->setId($id);
    }
    if (!empty($cid)) $deal->setTitle($cid);
    if (!empty($title)) $deal->setTitle($title);
    if (!empty($url)) $deal->setTitle($url);
    if (!empty($coupon_code)) $deal->setTitle($coupon_code);
    if (!empty($details)) $deal->setDetails($details);
    if (!empty($image)) $deal->setImage($image);
    if (!empty($saving)) $deal->setTitle($saving);
    if (!empty($discount)) $deal->setDiscount($discount);
    if (!empty($published)) $deal->setGrouponLink($published);
    if (!empty($promoted)) $deal->setTitle($promoted);
    if (!empty($hoster)) $deal->setHoster($hoster);
    if (!empty($due)) $deal->setDueDate($due);
    $deal->save();
    
    setMsg(MSG_SUCCESS, '折扣信息创建成功！');
    HTML::forwardBackToReferer();

} else {
  $id = isset($vars[1]) ? $vars[1] : null;
  $html = new HTML();
  if ($id) {
    $deal = Deal::findById($id);
  }
}

//-- otherwise, show the create form
$html = new HTML();

echo $html->render('backend/html_header', array('title' => 'Create a Deal'));
echo $html->render('backend/header');

echo $html->render('backend/deal/sidebar');
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <?php $html->renderOut('backend/deal/nav'); ?>
  <h2 class='sub-header'>
    <?php if ($deal): ?>
    编辑折扣信息：“<?php echo $deal->getTitle(20); ?>”;
    <?php else: ?>
    创建一个新的折扣信息
    <?php endif; ?>
  </h2>
  <?php echo $html->render('backend/deal/form', array('deal' => $deal)); ?>
</div>

<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');


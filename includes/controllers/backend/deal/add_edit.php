<?php
//-- if this is a submit action, create the record
$deal = null;
if (isset($_POST['submit'])) {
  // http://www.sydneytoday.com/bencandy.php?fid=12&id=166758
  $id = isset($_POST['id']) ? $_POST['id'] : null;
  $cat = isset($_POST['cid']) ? $_POST['cid'] : null;
  $title = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
  $slug = isset($_POST['slug']) ? strip_tags(trim($_POST['slug'])) : null;
  $url = isset($_POST['url']) ? strip_tags($_POST['url']) : null;
  $coupon_code = isset($_POST['coupon_code']) ? strip_tags($_POST['coupon_code']) : null;
  $details = isset($_POST['details']) ? $_POST['details'] : null;
  $image = isset($_POST['image']) ? strip_tags($_POST['image']) : null;
  $saving = isset($_POST['saving']) ? strip_tags($_POST['saving']) : null;
  $discount = isset($_POST['discount']) ? strip_tags($_POST['discount']) : null;
  $published = isset($_POST['published']) ? strip_tags($_POST['published']) : null;
  $promoted = isset($_POST['promoted']) ? strip_tags($_POST['promoted']) : null;
  $valid = isset($_POST['valid']) ? strip_tags($_POST['valid']) : 0;
  $hoster = isset($_POST['hoster']) ? strip_tags($_POST['hoster']) : null;
  $due = isset($_POST['due_date']) ? strip_tags($_POST['due_date']) : null;
  
  
  // TODO - validation
  if (!empty($slug) && preg_match('/[^a-z\-0-9]/', $slug)) {
    setMsg(MSG_ERROR, 'slug 只能是小写或者数字');
  } elseif(Deal::findBySlug($slug, $cat, $id)) { 
    setMsg(MSG_ERROR, '同样的slug已经有了，换个吧');
  }else {
  
    // create / update deal
    $deal = new Deal();
    if ($id) {
      $deal->setId($id);
    }
    if (!empty($cat)) $deal->setCategory(Category::findById($cat));
    if (!empty($title)) $deal->setTitle($title);
    if (!empty($slug)) $deal->setSlug($slug);
    if (!empty($url)) $deal->setUrl($url);
    $deal->setCouponCode($coupon_code);
    if (!empty($details)) $deal->setDetails($details);
    if (!empty($image)) $deal->setImage($image);
    if (!empty($saving)) $deal->setSaving($saving);
    if (!empty($discount)) $deal->setDiscount($discount);
    if (!empty($published)) $deal->setPublished($published); else $deal->setPublished (0);
    if (!empty($promoted)) $deal->setPromoted($promoted); else $deal->setPromoted (0);
    $deal->setValid ($valid);
    if (!empty($hoster)) $deal->setHoster($hoster);
    if (!empty($due)) $deal->setDue(strtotime($due));

    if ($deal->isNew()) {
      $deal->setCreatedAt(time());
    }
    $deal->save();
    if ($id) {
      setMsg(MSG_SUCCESS, '折扣信息更新成功！');
      HTML::forward('/admin/deal/list');
    } else {
      setMsg(MSG_SUCCESS, '折扣信息创建成功！');
      HTML::forwardBackToReferer();
    }
    
    
    
  }

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

//echo $html->render('backend/deal/sidebar');
?>

<div class="main">
  <?php $html->renderOut('backend/deal/nav'); ?>
  <h2 class='sub-header'>
    <?php if ($deal): ?>
    编辑折扣信息："<?php echo $deal->getTitle(20); ?>";
    <?php else: ?>
    创建一个新的折扣信息
    <?php endif; ?>
  </h2>
  <?php echo $html->render('backend/deal/form', array('deal' => $deal)); ?>
</div>

<?php

echo $html->render('backend/footer');
echo $html->render('backend/html_footer');


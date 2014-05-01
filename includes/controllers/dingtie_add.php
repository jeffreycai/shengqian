<?php
//-- if this is a submit action, create the record
if (isset($_POST['submit'])) {
  // http://www.sydneytoday.com/bencandy.php?fid=12&id=166758
  $url = $_POST['url'];
  $matches = array();
  preg_match('/fid=(\d+)&id=(\d+)/i', $url, $matches);
  $fid = isset($matches[1]) ? $matches[1] : null;
  $tid = isset($matches[2]) ? $matches[2] : null;
  $title = strip_tags($_POST['title']);
  // validation
  if (is_null($fid) || is_null($tid)) {
    setMsg(MSG_ERROR, '链接地址不正确，请重新填写');
  } else {
    $topic = new Topic();
    $topic->setFid(strip_tags($fid));
    $topic->setTid(strip_tags($tid));
    $topic->setTitle(strip_tags($title));
    $topic->save();
    setMsg(MSG_SUCCESS, '顶贴任务创建成功！');
    HTML::forwardBackToReferer();
  }
}

//-- otherwise, show the create form
$html = new HTML();

echo $html->render('html_header', array('title' => 'Create a Dingtie'));
echo $html->render('header');

echo $html->render('sidebar');
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class='page-header'>顶贴</h1>
  <h2 class='sub-header'>创建一个新的顶贴任务</h2>
  <?php echo $html->render('dingtie_form'); ?>
</div>

<?php

echo $html->render('footer');
echo $html->render('html_footer');


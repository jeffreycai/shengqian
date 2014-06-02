<?php
global $conf;

// generate spam tokens
$name;$email; $conmment; $phone;
$error_flag = 0;
// handle form submission
if (isset($_POST['submit'])) {
  $name = trim(strip_tags($_POST['name']));
  $email = trim(strip_tags($_POST['email']));
  $comment = trim(strip_tags($_POST['comment']));
  $phone = trim(strip_tags($_POST['phone']));
  $spam_val = $_POST[getSpamKey()];

  $error_flag = 1;
  if (empty($name)) {
    setMsg(MSG_ERROR, '请填写您的姓名');
  } elseif (empty($email)) {
    setMsg(MSG_ERROR, '请填写您的邮箱');
  } else if (!preg_match('/[^@]+@.+/', $email)) {
    setMsg(MSG_ERROR, '请帖写合法的邮箱地址');
  } else if ($spam_val != getSpamVal()) {
    setMsg(MSG_ERROR, '本站严禁使用机器人自动提交表单！做人要厚道啊，亲~~');
  } else {
    mail(
            $conf['site_admin_email'], 
            "AuSaving contact form submission", 
            "Name: $name\r\nEmail: $email\r\nPhone: $phone\r\nComment:\r\n----------\r\n\r\n$comment",
              'From: jeffreycai-sydney@hotmail.com' . "\r\n" .
              'Reply-To: jeffreycai-sydney@hotmail.com' . "\r\n" .
              'X-Mailer: PHP/' . phpversion());
    setMsg(MSG_SUCCESS, '亲，谢谢您的留言以及对我们的支持！我们会更加努力的！！<br />我们的小编会尽快和您进一步沟通。 谢谢');
    HTML::forwardBackToReferer();
  }
}
if ($error_flag == 0) {
  resetSpamTokens();
}

$html = new HTML();
$html->renderOut('frontend/html_header', array(
    'title' => '联系我们',
    'body_class' => 'contact'
));

$html->renderOut('frontend/nav/main', array(
    'current_url' => get_cur_page_url(true),
    'site_name_html' => $conf['site_name_html'],
    'categories' => $conf['category']
));
$html->renderOut('frontend/sidemenu');

?>

<div class="container body">
  <div class="row">
    <div class="col-sm-8 col-md-9">
      <ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li class="active">联系我们</li>
      </ol>
      
      <div class="content">

          
          <div class="col-lg-6">
            <h1>联系我们</h1>
            <blockquote>
              <p>团结海外华人，互帮互助一同省钱致富！</p>
              <footer>《<strong><?php echo $conf['site_name_html'] ?></strong>》  <cite>众小编</cite></footer>
            </blockquote>
            <p>您的意见和建议是我们进步的动力。</p>
            <p>我们的网站还在建站的初级阶段，有很多地方做的不够，我们在不断的完善网站的信息资源以及各项功能。希望通过您的反馈以及我们不懈的努力，<strong><span style="color: #3C7E9E;">Au</span><span style="color: #D53115">Saving</span> 澳洲省钱网</strong> 将成为您生活中的得力小助手，帮你在海外的生活中节省开销。</p>
            
            <div class="divider dotted"></div>
            
            <p>
              <strong>Email: </strong>ausaving[dot]com[at]gmail[dot]com
              <br />
              <strong>微信号: </strong>ausaving
            </p>
            
            <div class="divider dotted visible-xs visible-sm visible-md"></div>

          </div>

          <div class="col-lg-6">
            <?php echo renderMsgs(); ?>
            <form action="" method="POST" role="form" class="form-horizontal">
              <div class="form-group">
                <label for="name" class="col-sm-3 col-lg-12">姓名 <span>*</span></label>
                <div class="col-sm-9 col-lg-12">
                  <input id="name" name="name" type="text" required="" placeholder="您的姓名" class="form-control" <?php if (isset($name) && $name): ?>value="<?php echo $name; ?>"<?php endif; ?> />
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-3 col-lg-12 ">邮箱 <span>*</span></label>
                <div class="col-sm-9 col-lg-12">
                  <input id="email" name="email" type="email" required="" placeholder="您的邮箱地址" class="form-control" <?php if (isset($email) && $email): ?>value="<?php echo $email; ?>"<?php endif; ?> />
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="col-sm-3 col-lg-12">电话</label>
                <div class="col-sm-9 col-lg-12">
                  <input id="phone" name="phone" type="tel" placeholder="您的电话" class="form-control" <?php if (isset($phone) && $phone): ?>value="<?php echo $phone; ?>"<?php endif; ?> />
                </div>
              </div>
              <div class="form-group">
                <label for="comment" class="col-sm-3 col-lg-12">留言 <span>*</span></label>
                <div class="col-sm-9 col-lg-12">
                  <textarea class="form-control" id="comment" name="comment" rows="7" required="" placeholder="您想对我们说的话"><?php if (isset($comment) && $comment): ?><?php echo $comment ?><?php endif; ?></textarea>
                </div>
              </div>
              <input id="spam_tokens" type="hidden" name="dummy" value="dummy" />
              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3 col-lg-12 col-lg-offset-0" style="text-align: right">
                  <input type="submit" value="提交" name="submit" class="btn btn-default" />
                </div>
              </div>
            </form>
          </div>

        <div class="clearfix"></div>
      </div>
    </div>
    <div class="col-sm-4 col-md-3 sidebar">
      <?php $html->renderOut('frontend/deal/sidebar_left'); ?>
    </div>
  </div>
</div>


<?php

$html->renderOut('frontend/footer');

$html->renderOut('frontend/html_footer');

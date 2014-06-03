<?php 
global $conf;

$current_url = $data->current_url;
$site_name_html = $data->site_name_html;
$categories = $data->categories;

$html = new HTML();
?> 

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="sidemenu-switch"></button>
          <a class="navbar-brand" href="/"><?php echo $conf['site_name_html'] ?></a>
          
          <!-- Button trigger modal -->
          <button type="button" class="top-action" data-toggle="modal" data-target="#follow-us"></button>

        </div>
        <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
           <li<?php echo_link_active_class('/', $current_url); ?>><a href="/">首页</a></li>
           <li<?php echo_link_active_class('/deals', $current_url); ?> class="dropdown">
             <a href="/deals" class="dropdown-toggle" data-toggle="dropdown">省钱折扣 <b class="caret"></b></a>
             <ul class="dropdown-menu">
               <li<?php echo_link_active_class('/deals', $current_url); ?>><a href="/deals">全部折扣</a></li>
               <li<?php echo_link_active_class('/deals/promoted', $current_url); ?>><a href="/deals/promoted">精选折扣</a></li>
               <li class="divider"></li>
               <li class="dropdown-header">分类折扣</li>
               <?php foreach ($categories as $key => $name): ?>
               <li<?php echo_link_active_class("/deals/$key", $current_url); ?>><a href="<?php echo "/deals/$key"; ?>"><?php echo $name; ?></a></li>
               <?php endforeach; ?>
             </ul>
           </li>
           
           <li<?php echo_link_active_class('/contact-us', $current_url); ?>><a href="/contact-us">联系我们</a></li>
          </ul>
          <!--
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Default</a></li>
            <li class="active"><a href="./">Static top</a></li>
            <li><a href="../navbar-fixed-top/">Fixed top</a></li>
          </ul>
          -->
        </div>
        
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="follow-us" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">欢迎您订阅我们的微信，第一时间抢占省钱高地！</h4>
      </div>
      <div class="modal-body">
        <p>亲，欢迎您光临 <strong><?php echo $conf['site_name_html'] ?>！</strong></p>
        <p>我们的微信号是： <strong>ausaving</strong>, 或者扫描我们的二维码，立马订阅！！</p>
        <p><img class="img-responsive" alt="AuSaving.com 微信二维码" src="/images/wechat-logo.jpg" /></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">知道了</button>
      </div>
    </div>
  </div>
</div>

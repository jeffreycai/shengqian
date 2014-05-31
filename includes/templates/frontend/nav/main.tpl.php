<?php 
$current_url = $data->current_url;
$site_name_html = $data->site_name_html;
$categories = $data->categories;
?> 
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="sidemenu-switch"></button>
          <a class="navbar-brand" href="/"><span style="color: #F7E8D1">Au</span><span style="color: #D53115">Saving</span> 澳洲省钱网</a>
          <button type="button" class="top-action"></button>
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
           
<!--           <li<?php echo_link_active_class('/tips', $current_url); ?>><a href="/tips">省钱小贴士</a></li>-->
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


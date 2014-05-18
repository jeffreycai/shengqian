<?php global $conf; ?>

<div class="sidemenu collapse">
  <div class="inner">
    <div class="logo">
      <img src="/images/piggy.jpg" alt="<?php echo $conf['site_name'] ?>" />
    </div>
    <nav>
      <ul>
        <li><a href="/">首页</a></li>
        <li>
          <a href="#">折扣信息</a>
          <ul>
            <li><a href="">今日推荐折扣</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">分类折扣</li>
            <?php foreach ($conf['category'] as $key => $name): ?>
            <li><a href="<?php echo "/$key"; ?>"><?php echo $name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/saving-tips">省钱小贴士</a></li>
        <li><a href="/contact-us">联系我们</a></li>
      </ul>
    </nav>
  </div>
</div>

<div class="overlay"></div>
<?php global $conf; ?>

<div class="sidemenu collapse">
  <div class="inner">
    <div class="logo">
      <img src="/images/piggy.jpg" alt="<?php echo $conf['site_name'] ?>" />
    </div>
    <nav>
      <ul>
        <li><a href="/"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
        <li><a href="/deals"><span class="glyphicon glyphicon-credit-card"></span> 折扣信息</a></li>
        <li>
          <ul>
            <?php 
              foreach ($conf['category'] as $key => $name): 
                $class;
                switch ($key) {
                  case 'food':
                    $class = 'cutlery'; break;
                  case 'goods':
                    $class = 'gift'; break;
                  case 'event':
                    $class = 'bullhorn'; break;
                  case 'travel':
                    $class = 'plane'; break;
                }
            ?>
            <li>
              <a href="<?php echo "/deals/$key"; ?>">
                <span class="glyphicon glyphicon-<?php echo $class; ?>"></span>
                <?php echo $name; ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/saving-tips"><span class="glyphicon glyphicon-info-sign"></span> 省钱小贴士</a></li>
        <li><a href="/contact-us"><span class="glyphicon glyphicon-envelope"></span> 联系我们</a></li>
      </ul>
    </nav>
  </div>
</div>

<div class="overlay"></div>
<?php global $conf; ?>

  <!-- overlay -->
  <div class="overlay"></div>

  <!-- Wechat share prompt -->
  <?php if (comeFromWechat() && !getWechatShareConfirmed()): ?>
  <div class="wechat-share visible-xs">
    <div class="popover bottom">
      <div class="arrow"></div>
      <h3 class="popover-title">点击分享给更多朋友</h3>

      <div class="popover-content">
        <p>感谢您访问<strong><?php echo $conf['site_name_html']; ?></strong>。分享给小伙伴们一起省钱！</p>
        <button type="button" class="btn btn-default">知道了</button>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $('.wechat-share .btn').click(function(event){
      event.preventDefault();
      $('.wechat-share').fadeOut(function(){
        $(this).remove();
      });
      // send ajax to confirm wechat share action
      $.get('/wechat/share_confirm');
    });
  </script>
  <?php endif; ?>


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
</body>

</html>

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

</body>

</html>

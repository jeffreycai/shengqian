<?php 
$share_text = $data->share_text;
$share_img = $data->share_img;
?>

<div class="bdsharebuttonbox">
  <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
  <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
  <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
  <a href="#" class="bds_fbook" data-cmd="fbook" title="分享到Facebook"></a>
  <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
  <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
  <a href="#" class="bds_more" data-cmd="more"></a>
</div>
<script>
  window._bd_share_config={
    "common":{
      "bdSnsKey":{},
      "bdText":"<?php echo $share_text ?>",
      "bdMini":"2",
      "bdMiniList":false,
      "bdPic":"<?php echo $share_img ?>",
      "bdStyle":"0",
      "bdSize":"24"
    },
    "share":{}
  };
  with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
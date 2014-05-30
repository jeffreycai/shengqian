<div class="row sidebar">
  <div class="col-xs-12 search block">
    <form action="/search/deal" method="GET">
      <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="全站搜索" required="" />
        <span class="input-group-btn">
          <button class="btn btn-default" onclick="$(this).parents('form').first().submit();" type="button">Go!</button>
        </span>
      </div>
      <input type="submit" value="提交" style="display: none;" />
    </form>
  </div>
  
  <div class="col-xs-12 wechat block">
    <img class="img-responsive" src="/images/wechat-logo.jpg" alt="AuSaving.com 微信二维码" />
  </div>
</div>

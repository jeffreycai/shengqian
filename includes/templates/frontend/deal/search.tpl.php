  <div>
    <form action="/search/deal" method="GET">
      <div class="input-group input-group-lg">
        <input type="text" name="keyword" class="form-control" placeholder="全站搜索" required="" />
        <span class="input-group-btn">
          <button class="btn btn-default" onclick="$(this).parents('form').first().submit();" type="button">Go!</button>
        </span>
      </div>
      <input type="submit" value="提交" style="display: none;" />
    </form>
  </div>

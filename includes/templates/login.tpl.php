<form role="form" class="form-signin" action="/login" method="POST">
  <h2 class="form-signin-heading">Please sign in</h2>
  <?php echo renderMsgs(); ?>
  <input type="text" autofocus="" required="" placeholder="User name" class="form-control" name="username">
  <input type="password" required="" placeholder="Password" class="form-control" name="password">
  <br />
  <button type="submit" name="submit" value="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
</form>


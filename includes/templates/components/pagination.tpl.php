<?php
global $conf;

// get total record num
// do a db query on the current query to get total number
// store the total number of this query in session, so that if it's the same query again, we don't have to query database one more time just to get the total result number
$total = $data->total_page;
$page = $data->page;
$need_dot_on_left = $page - $conf['pagination_range'] > 1 ? true : false;
$need_dot_on_right = $page + $conf['pagination_range'] < $total ? true : false;

?>

<?php if ($total > 1): ?>

<div class="item-list">
  <ul class="pagination" style="text-align: left;">
    <?php if ($need_dot_on_left): ?>
      <li class="pager-first"><a href="<?php echo update_query_string(array('page' =>1)); ?>">&laquo; first</a></li>
      <li class="pager-previous"><a href="<?php echo update_query_string(array('page' => $page - 1)); ?>">&lt; previous</a></li>
      <li class="pager-ellipsis">...</li>
      <?php for ($j = $conf['pagination_range']; $j > 0; $j--): ?>
        <li><a href="<?php echo update_query_string(array('page' => $page - $j)); ?>"><?php echo $page - $j; ?></a></li>
      <?php endfor; ?>
    <?php else: ?>
      <?php for ($j = 1; $j < $page; $j++): ?>
        <li><a href="<?php echo update_query_string(array('page' => $j)); ?>"><?php echo $j; ?></a></li>
      <?php endfor; ?>
    <?php endif; ?>

    <li class="pager-current active"><a href="<?php echo update_query_string(array('page' => $page)); ?>"><?php echo $page; ?></a></li>

    <?php if ($need_dot_on_right): ?>
      <?php for ($j = 1; $j <= $conf['pagination_range']; $j++): ?>
        <li><a href="<?php echo update_query_string(array('page' => $page + $j)); ?>"><?php echo $page + $j; ?></a></li>
      <?php endfor; ?>
      <li class="pager-ellipsis">...</li>
      <li class="pager-next"><a href="<?php echo update_query_string(array('page' => $page + 1)); ?>">next &gt;</a></li>
      <li class="pager-last"><a href="<?php echo update_query_string(array('page' => $total)); ?>">last &raquo;</a></li>
    <?php else: ?>
      <?php for ($j = $page + 1; $j <= $total; $j++): ?>
        <li><a href="<?php echo update_query_string(array('page' =>$j)); ?>"><?php echo $j; ?></a></li>
      <?php endfor; ?>
    <?php endif; ?>

  </ul>
</div>

<?php endif; ?>

jQuery(function ($) {
  //-- delete a topic
  $('.delete').click(function(){
    var r = window.confirm("Are you sure to delete?");
    if (r == false) {
      return;
    }
    
    var btn = $(this);
    var tr = btn.parents('tr').first();
    var id = tr.attr('id');
    btn.button('loading');
    $.ajax({
      url: "/dingtie/delete/" + id
    }).always(function(data){
      if (data == 'delete completely') {
        tr.fadeOut();
      } else if (data = 'marked as deleted') {
        btn.button('reset').html('Delete forever');
      }
    });
  });
});
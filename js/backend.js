jQuery(function ($) {
  //-- delete a topic
  $('.delete').click(function(){
    var r = window.confirm("Are you sure to delete?");
    if (r == false) {
      return;
    }
    
    var btn = $(this);
    var tr = btn.parents('tr').first();
    var tokens = tr.attr('id').split('-');
    var table = tokens[0];
    var id = tokens[1];
    btn.button('loading');
    $.ajax({
      url: "/backend/delete/"+ table + "/" + id
    }).always(function(data){
      if (data == 'delete completely') {
        tr.fadeOut();
      } else if (data = 'marked as deleted') {
        btn.button('reset').html('Delete forever');
      }
    });
  });
});
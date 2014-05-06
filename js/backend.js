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
      url: "/admin/delete/"+ table + "/" + id
    }).always(function(data){
      if (data == 'delete completely') {
        tr.fadeOut();
      } else if (data = 'marked as deleted') {
        btn.button('reset').html('Delete forever');
      }
    });
  });
  
  //-- publish a deal
  $('.publish-deal').click(function(){
    var btn = $(this);
    var tr = btn.parents('tr').first();
    var tokens = tr.attr('id').split('-');
    var table = tokens[0];
    var id = tokens[1];
    btn.button('loading');
    $.ajax({
      url: "/admin/sydneytoday/deal/"+id+"/instance/add"
    }).always(function(data){
      btn.button('reset');
      $('.last_published', tr).html(data);
      $('.publish', tr).prepend('<li class="disabled"><a href="#">' + data + '</a></li>');
    });
  });
});
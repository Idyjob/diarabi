
function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }
 function getDateTime() {
    var now     = new Date();
    var year    = now.getFullYear();
    var month   = now.getMonth()+1;
    var day     = now.getDate();
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds();
    if(month.toString().length == 1) {
        var month = '0'+month;
    }
    if(day.toString().length == 1) {
        var day = '0'+day;
    }
    if(hour.toString().length == 1) {
        var hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
        var minute = '0'+minute;
    }
    if(second.toString().length == 1) {
        var second = '0'+second;
    }
    var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute;
     return dateTime;
}
function addCommentArticle(id,comment){
  comment = escapeHtml(comment);
  $.ajax({
    type: "POST",
    url : Routing.generate('addCommentArticle', {id:id}),
    data: {comment:comment},
    error: function(error)
            {
            alert(error);
          },
    success: function(data){
      var currentDate = getDateTime();
      var commentCount = $('#comments_article_count_'+id).text();
      var gravatar = 'http://www.gravatar.com/avatar/' + md5(data.user.email);

      var newComment =   '<div class="media well" id="comment_'+data.id+'" style="color:#3B5998;">'
          +'<div class="media-left">'
            +'<a href="#" class="image-post">'
                  +'<img src="'+gravatar+'"   >'
            +'</a>'
          +'</div>'
          +'<div class="media-body">'
              +'<h4 class="media-heading"><a href="#" >Moi </a> '
              +'<small><i> <time class="timeago" datetime="'+currentDate+'"></time></i></small></h4>'
              +'<p> '+data.contenu+'</p>'
          +'</div>'
    +'</div>';

    $('.allcomments_'+id).prepend(newComment).html();

    commentCount = parseInt(commentCount);
    $('#comments_article_count_'+id).text(commentCount + 1);



    }
  });
}

  function deleteCommentArticle(id,currentArticle){

    var commentid = parseInt(id);



    if(confirm(" Voulez vous supprimer cet élément ?")){

      $.ajax(
        {
                  type: "GET",
                  url : Routing.generate('deleteCommentArticle', {id:commentid}),

                  error:function(jQXHR, textStatus, errorThrown) {
                     console.log(jQXHR);
                     console.log(textStatus);
                     console.log(errorThrown);
                   },
                  success: function(data){

                    $('div#comment_'+id).remove();
                    var commentCount = $('#comments_article_count_'+currentArticle).text();
                    commentCount = parseInt(commentCount);

                    $('#comments_article_count_'+currentArticle).text(commentCount - 1);
                  }

      }
    );
    }
  }



$("textarea.commentinputarticle").keypress(function(event) {
  if (event.which == 13) {
      event.preventDefault();
      var id = $(this).attr('id');
      var comment = $(this).val();

      $(this).val('');
      addCommentArticle(id,comment);
  }
});

$('a.deletecomment_article').click(function(e){
  e.preventDefault();

  var id = $(this).attr('id');
  var currentArticle = $(this).attr('aria-label');
  deleteCommentArticle(id,currentArticle);

});

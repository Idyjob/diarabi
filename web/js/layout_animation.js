
$().ready(function(){

  $('.mainprofile ,.mainleft ,.mainright').hide(2000, function(){$(this).remove();});
  $('.mainbody').removeClass('col-sm-6').addClass('col-sm-6 col-sm-offset-3');
});

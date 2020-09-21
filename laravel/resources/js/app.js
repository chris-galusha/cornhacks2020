$(document).ready(function(){

  $('#hide-notification').click(function () {
    let notification = $(this).parent('.notification');
    $(notification).fadeOut();
  });

  // Change the text under 'file name' on upload screens

$('.file').on('change', function () {

  if($(this).find('.file-input')[0].files.length > 0)
  {
    $(this).find('.file-name')[0].innerHTML = $(this).find('.file-input')[0].files[0].name;
  }
});

});

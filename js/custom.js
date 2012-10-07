$(function(){
  $('#edit-file').fileInputField();
  
  // adjsut sidebar css to properly float right sidebar based on content block height.
  // Check windo width to see which media query we're running
  if ($(window).width() > 768 && $(window).width() < 992){
    // if using 08cols, set the css for right column for proper floating based on region heights
    if ($('#content').height() > $('#sidebar-left-region').height()){
      $('#sidebar-right-region').css('clear','none')
    }
  }
});
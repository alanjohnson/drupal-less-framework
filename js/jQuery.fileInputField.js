/*
* --------------------------------------------
* jQuery custom file input field
* Based on work by Trevor Davis (http://www.viget.com/inspire/custom-file-inputs-with-a-bit-of-jquery/)
* --------------------------------------------
*/

$.fn.fileInputField = function(){
  fileInputs = function() {
        tempArray = $(this).val().split('\\'),
        fieldVal = tempArray[tempArray.length-1],
        $('#edit-file-wrapper .file-field-wrapper .file-holder').val(fieldVal);
  };
  
  $(document).ready(function() {
    // create custom elements to display rather than the default input(type=file), these elements can then be styled to match the site design
    $('#edit-file-wrapper input[type=file]').wrap('<span class="file-wrapper"</span>')
    $('#edit-file-wrapper input[type=file]').after('<div class="file-field-wrapper"><input type="text" class="file-holder" value="select a file..." /></div>')
    $('#edit-file-wrapper .file-field-wrapper').after('<span class="button">Browse</span>')    
    $('#edit-file-wrapper input[type=file]').bind('change focus click', fileInputs)
    //on mouseover/mouseout udpdate style of button
    $("#edit-file-wrapper .file-wrapper input.form-file")
      .mouseover(function(){
        $(this).siblings('.button').addClass("hover")
      })
      .mouseout(function(){
        $(this).siblings('.button').removeClass("hover")
      });
    });
    // END custom elements
};
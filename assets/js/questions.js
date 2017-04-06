var tbl;

var baseurl = $("#base_url").val();

$(document).ready(function() {
   $( "#contact" ).submit(function( event ) {
    

    event.preventDefault();
    var params = $(this).serialize();

    var url = baseurl + "questions/continue"; // the script where you handle the form input.

    $.ajax({
         type: "POST",
         url: url,
         data: params, // serializes the form's elements.
         success: function(data)
         {
            alert(data);
            window.location = baseurl + "questions/part_1";
            // window.location.href = baseurl + "questions/part_1"
         }
       });


  });
} );
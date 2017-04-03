var tbl;

var baseurl = $("#base_url").val();

$(document).ready(function() {
   $( "#history-preserv-submit" ).click(function( e ) {

    e.preventDefault();
    var params = $("#municipality-form").serialize();

    var url = baseurl + "questions/save"; // the script where you handle the form input.

    $.ajax({
       type: "POST",
       url: url,
       data: params, // serializes the form's elements.
       dataType: 'json',
       success: function(data)
       {
          var status = data.status;
          var msg = data.msg;
          var his_mun = data.his_mun;
          if (status == '0')
          {
            alert(msg);
          }
          else{
            confirm_part_two(his_mun);
          }
       }
     });


  });
} );

function confirm_part_two(his_mun){

    bootbox.confirm({
      message: "Are you willing to provide more detailed information about the types of ordinances, resource designations, regulated or incentivized activities, or preservation-specific advisory bodies in the municipalities you selected above? This information can be completed in electronic or paper format at your convenience. We are trying to collect this information by May 1, 2017​",
      size: 'large',
      buttons: {
          confirm: {
              label: 'Yes, I am willing to provide more information​',
              className: 'btn-success'
          },
          cancel: {
              label: 'No, I am not able to provide more information at this time​',
              className: 'btn-danger'
          }
      },
      callback: function (result) {
          console.log('This was logged in the callback: ' + result);

          if (result === true)
          {
            window.location.href = baseurl + "questions/part_2";
          }
      }
  });

}



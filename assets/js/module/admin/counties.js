var tbl;

var baseurl = $("#base_url").val();

$(document).ready(function() {
   tbl =  $('#datatables').dataTable({
        "processing": true,
        "serverSide": false,
        "fnDrawCallback": function( oSettings ){
             $("a[data-target=#myModal]").on('click', function(ev) {

                ev.preventDefault();
                var target = $(this).attr("href");

                // load the url and show modal on success
                $("#myModal .modal-content").load(target, function() { 
                     $("#myModal").modal("show"); 
                });
            });
          },
        "ajax": {
            "url": baseurl + "admin/counties/get_counties/",
            "type": "POST"
        }
    });
} );
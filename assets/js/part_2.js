

$(document).ready(function() {

	var baseurl = $("#base_url").val();
	$("#btn-next").off("click");
	$("#btn-next").on("click", function(){
		var totalStep = $("#total-step").val();
		var step_no = $("#progress-step").val();
		var fieldInp = "#fieldset_" + step_no + " input";
	

		var cont = "y";

		$(fieldInp).each(function() {
		  var inpName = $(this).attr("class");
		  
		  var totalChecked = $("."+inpName + ":checked").size();
		  
		  if (totalChecked < 1)
		  {
		     cont = "n";
		    
		  }
		  
		});



		if(cont === "n")
		{
		   alert("Please choose atleast one for each question");
		}
		else
		{

			var next_step = Number(step_no) + 1;
			$("#step_number").val();
			var current_page = "#fieldset_" + step_no;
			var next_page = "#fieldset_" + next_step;
			$(current_page).hide();
			$(next_page).show();
			$("#progress-step").val(next_step);
			$("#step_bar").html(next_step);
			var totStep = Number(totalStep);
			$("#btn-previous").show();
			if (totStep == next_step)
			{
				$("#btn-next").hide();
				$("#survey-submit").show();
			}


		}


	});


	$("#btn-previous").off("click");
	$("#btn-previous").on("click", function(){
		var totalStep = $("#total-step").val();
		var step_no = $("#progress-step").val();
		var fieldInp = "#fieldset_" + step_no + " input";
	

		

		var prev_step = Number(step_no) - 1;
		$("#step_number").val();
		var current_page = "#fieldset_" + step_no;
		var prev_page = "#fieldset_" + prev_step;
		$(current_page).hide();
		$(prev_page).show();
		$("#progress-step").val(prev_step);
		$("#step_bar").html(prev_step);
		var totStep = Number(totalStep);
		$("#btn-next").show();

		if (prev_step == 1)
		{
			$("#btn-previous").hide();
		}


		$('html, body').animate({
		        scrollTop: $("#history-preservation").offset().top
		    }, 1000);		

	});


	$("#survey-submit").off("click");
	$("#survey-submit").on("click", function(){
		var totalStep = $("#total-step").val();
		var step_no = $("#progress-step").val();
		var fieldInp = "#fieldset_" + step_no + " input";
	

		var cont = "y";

		$(fieldInp).each(function() {
		  var inpName = $(this).attr("class");
		  
		  var totalChecked = $("."+inpName + ":checked").size();
		  
		  if (totalChecked < 1)
		  {
		     cont = "n";
		    
		  }
		  
		});



		if(cont === "n")
		{
		   alert("Please choose atleast one for each question");
		}
		else
		{

			bootbox.confirm({
		      message: "Are you sure you want to submit the survey?",
		      size: 'large',
		      buttons: {
		          confirm: {
		              label: 'Yes',
		              className: 'btn-success'
		          },
		          cancel: {
		              label: 'No',
		              className: 'btn-danger'
		          }
		      },
		      callback: function (result) {

		          if (result === true)
		          {
		          	var url = baseurl + "questions/submit_survey"
		            var params = $("#questions-form").serialize();
		            $.ajax({
				       type: "POST",
				       url: url,
				       data: params, // serializes the form's elements.
				       dataType: 'json',
				       success: function(data)
				       {
				       		alert(data.msg);
				         
				       }
				     });
		          }
		      }
		  });


		}


	});

});


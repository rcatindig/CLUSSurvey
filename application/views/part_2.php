
<div class="container-preservation">



	<div class="history-preservation">
		<div class="hist-description text-justify">To the best of you knowledge, do the following municipalities in your county have standalone historic preservation ordinances, provisions in their zoning or building codes, or include specific language in a subdivision and land development ordinance (SALDO) focused on regulating or preserving historic resources?​</div>

		<ul class="skill-list">
		  <li class="skill">
		    <h5>Step <span class='Step'>50</span> of <span class="total-step"><?php echo $total;?></span></h5>
		    <progress class="skill-1" max="<?php echo $total;?>" value="20">
		    </progress>
		  </li>
		  
		  
		</ul>

		<form id="questions-form">
			<?php
					if(!empty($municipalities)): 
						$count = 0;
						foreach($municipalities as $mun): 
							$municipality_name = $mun->municipality_name;
							$municipality_id = $mun->id;
							$count++;

				?>
				<fieldset class="question_page <?php echo ($count == 1) ? 'active' : ''; ?>">

					<div class="municipality-title"><?php echo $municipality_name?></div>

					<?php

						if(!empty($questions)):
							foreach($questions as $quest): 
								$question_id = $quest["question_id"];
								$question_name = $quest["question_name"];
								$options = $quest["options"];
					?>

						<div class="control-group">

						    <h5><?php echo $question_name; ?></h5>
						    	<?php
						    		if(!empty($options)):
						    			foreach ($options as $opt) :
						    				$option_name = $opt["option_name"];
						    				$option_id = $opt["option_id"];
						    	?>

								    <label class="control control--checkbox">
								    	<?php echo $option_name; ?>
								      <input type="checkbox" name="question_<?php echo $question_id; ?>" value="<?php echo $option_id; ?>"/>
								      <div class="control__indicator"></div>
								    </label>

						    	<?php 
						    			endforeach;
						    		endif;
						    	?>
						    
						 </div>


				<?php
							endforeach;
						endif;
						
				?>



				
			</fieldset>
		<?php 
				endforeach;
			endif;
		?>	
		</form>

		<div class="row">
			<div class="col-md-4"><button class="button-survey-previous" id="history-preserv-submit" data-submit="...Sending">Previous</button></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"><button class="button-survey-next" id="history-preserv-submit" data-submit="...Sending">Next</button></div>
		</div>

		
	</div>
</div>
<div class="container-preservation">

	<div class="history-preservation">

		<h4>HISTORIC PRESERVATION IN​ <?php ECHO strtoupper($county_name); ?></h4>
		<div class="hist-description text-justify">To the best of you knowledge, do the following municipalities in your county have standalone historic preservation ordinances, provisions in their zoning or building codes, or include specific language in a subdivision and land development ordinance (SALDO) focused on regulating or preserving historic resources?​</div>
		<form id="municipality-form">
			<input type="hidden" name="county_id" value="<?php echo $county_id ?>">
			<input type="hidden" name="county_name" value="<?php echo $county_name ?>">
			<table id="no-more-tables" class="table table-striped table-bordered table-hover no-more-tables">
				<thead>
					<tr>
						<th>Municipality</th>
						<th width="15%" class="text-center">Yes</th>
						<th width="15%" class="text-center">No</th>
						<th width="15%" class="text-center">Not Sure</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!EMPTY($municipalities)) :
						foreach ($municipalities as $mun) :

				?>
					<tr>
						<td class="municipality_name" data-title="Municipality"><?php echo $mun->municipality_name; ?></td>
						<td data-title="Yes" class="text-center"><input data-id="<?php echo $mun->id; ?>" name="mun_<?php echo $mun->id; ?>" type="radio" value="Yes"></td>
						<td data-title="No" class="text-center"><input name="mun_<?php echo $mun->id; ?>" type="radio" value="No"></td>
						<td data-title="Not Sure" class="text-center"><input name="mun_<?php echo $mun->id; ?>" type="radio" value="Not Sure"></td>
					</tr>
				<?php
						endforeach;
					endif; 
				?>
				</tbody>


			</table>
		</form>
		<div class="row">
			<div class="col-md-4"></div>
			<button class="col-md-4 button-survey" id="history-preserv-submit" data-submit="...Sending">Continue</button>
			<div class="col-md-4"></div>
		</div>
	</div>
	<div id="part_two">
	</div>
</div>
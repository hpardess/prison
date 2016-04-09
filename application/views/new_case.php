<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;" dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>
				&nbsp;<?= $this->lang->line('general'); ?>&nbsp;
			</h3>
			<hr />
			<div id="newCaseRegistrationForm">
				<form action="#" id="form" class="form-horizontal">
					<div class="row">
	<!-- ------------------------------------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="newPrisoner"> New Prisoner?
										</label>
									</div>
								</div>
							</div>
						</div>
	<!-- ------------------------------------------------------------------- -->
						<div class="col-sm-6">
							<fieldset>
								<div class="form-group">
									<div class="input-group">
										<input type="text" class="form-control" id="searchPrisonerIdInput" placeholder="Search for registered prisoner by ID ...">
										<span class="input-group-btn">
											<button class="btn btn-primary" id="searchPrisonerIdBtn" type="button">Verify!</button>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					</div>

					<div class="row">
						<hr />
					</div>

					<div class="row" id="existingPrisonForm" style="display: none;">
	<!-- ---------------------------- view Prisoer Column 1 --------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('tazkira_number'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="tazkiraNumber"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="name"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('father_name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="fatherName"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('grand_father_name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="grandFatherName"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('age'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="age"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('marital_status'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="maritalStatus"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('num_of_children'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="numOfChildren"></p>
								</div>
							</div>
						</div>
	<!-- ----------------------------- view Prisoer Column 2 -------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('criminal_history'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="criminalHistory"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('permanent_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('permanent_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentDistrict"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('present_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentProvince"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('present_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentDistrict"></p>
								</div>
							</div>
						</div>
	<!-- ------------------------------ view Prisoer Column 3 ------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group center-block">
								<div class="col-sm-8 col-sm-offset-2">
									<div class="thumbnail">
										<img id="profilePicDisplay" alt="Profile Photo" class="img-rounded" src="<?= base_url('photos/') ?>/1.jpg">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="newPrisonForm" style="display: none;">
	<!-- ---------------------------- new Prisoer Column 1 --------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('tazkira_number'); ?></label>
								<div class="col-sm-8">
									<input name="tazkiraNumber" placeholder="Tazkira Number" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('name'); ?></label>
								<div class="col-md-8">
									<input name="name" placeholder="Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('father_name'); ?></label>
								<div class="col-md-8">
									<input name="fatherName" placeholder="Father Name" class="form-control" type="text">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('grand_father_name'); ?></label>
								<div class="col-sm-8">
									<input name="grandFatherName" placeholder="Grand Father Name" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('age'); ?></label>
								<div class="col-sm-8">
									<input name="age" placeholder="Age" class="form-control" type="number">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('marital_status'); ?></label>
								<div class="col-sm-8">
									<select name="maritalStatus" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($maritalStatusList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->status . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('num_of_children'); ?></label>
								<div class="col-sm-8">
									<input name="numOfChildren" placeholder="Number of Children" class="form-control" type="number">
								</div>
							</div>
						</div>
	<!-- ----------------------------- new Prisoer Column 2 -------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="criminalHistory"> <?= $this->lang->line('criminal_history'); ?>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('permanent_province'); ?></label>
								<div class="col-sm-8">
									<select name="permanentProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('permanent_district'); ?></label>
								<div class="col-sm-8">
									<select name="permanentDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('present_province'); ?></label>
								<div class="col-sm-8">
									<select name="presentProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('present_district'); ?></label>
								<div class="col-sm-8">
									<select name="presentDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
						</div>
	<!-- ------------------------------ new Prisoer Column 3 ------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group center-block">
								<div class="col-sm-7 col-sm-offset-2">
									<div class="thumbnail">
										<img id="profilePicDisplay" alt="Profile Photo" class="img-rounded" src="<?= base_url('photos/') ?>/1.jpg">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4"><?= $this->lang->line('profile_pic'); ?></label>
								<div class="col-sm-8">
									<input name="profilePic" placeholder="Number of Children" class="form-control" type="file" size="20">
								</div>
							</div>
						</div>
					</div>


	<!-- ------------------------------------------------------------------- -->
					<div class="row">
						<hr />
					</div>

					<div class="row">
	<!-- ------------------------------- Criminal Case Column 1 ------------------------------------ -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('registration_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="registrationDate"></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('case_number'); ?></label>
								<div class="col-md-8">
									<input name="caseNumber" placeholder="Case Number" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('crime_type'); ?></label>
								<div class="col-md-8">
									<select multiple name="crimeType" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($crimeTypeList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->type_name . "</option>";
										} ?>
									</select>
									<span><small><?= $this->lang->line('select_multiple_tip'); ?></small></span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('police_custody'); ?></label>
								<div class="col-md-8">
									<input name="policeCustody" placeholder="Police Custody" class="form-control" type="text">
								</div>
							</div>
						</div>
	<!-- ------------------------------ Criminal Case Column 2 ------------------------------------- -->
						<div class="col-sm-4">
							<br><br><br><br>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('crime_date'); ?></label>
								<div class="col-md-8">
									<input name="crimeDate" placeholder="Crime Date" class="form-control" type="date">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_province'); ?></label>
								<div class="col-sm-8">
									<select name="crimeProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_district'); ?></label>
								<div class="col-sm-8">
									<select name="crimeDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_location'); ?></label>
								<div class="col-sm-8">
									<input name="crimeLocation" placeholder="Crime Location" class="form-control" type="text">
								</div>
							</div>
						</div>
	<!-- -------------------------------- Criminal Case Column 3 ----------------------------------- -->
						<div class="col-sm-4">
							<br><br><br><br>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('arrest_date'); ?></label>
								<div class="col-md-8">
									<input name="arrestDate" placeholder="Arrest Date" class="form-control" type="date">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_province'); ?></label>
								<div class="col-sm-8">
									<select name="arrestProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_district'); ?></label>
								<div class="col-sm-8">
									<select name="arrestDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_location'); ?></label>
								<div class="col-sm-8">
									<input name="arrestLocation" placeholder="Arrest Location" class="form-control" type="text">
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="padding-left: 12px; padding-right: 12px;">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('crime_reason'); ?></label>
								<!-- <input name="commissionMember" placeholder="Commission Member" class="form-control" type="text"> -->
								<textarea name="crimeReason" class="form-control" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('crime_supporter'); ?></label>
								<!-- <input name="commissionMember" placeholder="Commission Member" class="form-control" type="text"> -->
								<textarea name="crimeSupporter" class="form-control" rows="3"></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<hr />
					</div>

					<div class="row">
						
	<!-- -------------------------------- Court Decision all 3 Columns ----------------------------------- -->
	<!-- Iteration of Court Types -->
								<?php foreach ($courtDecisionTypeList as $key => $value) { ?>
							<div class="col-sm-4">
								<fieldset>
									<legend><?= $value->decision_type_name; ?></legend>

									<!-- <div class="form-group">
										<label class="control-label col-md-12"><?= $value->decision_type_name; ?></label>
									</div> -->

									<input type="hidden" value="<?= $value->id ?>" name="courtDecisionType[]"/>
									<!-- <div class="form-group">
										<label class="control-label col-md-4"><?= $this->lang->line('crime_id'); ?></label>
										<div class="col-md-8">
											<input name="crimeId[]" placeholder="Crime Id" class="form-control" type="text">
										</div>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label col-md-4"><?= $this->lang->line('court_decision_type'); ?></label>
										<div class="col-md-8">
											<select name="courtDecisionType[]" class="form-control" class="form-control">
												<option></option>
												<?php foreach ($courtDecisionTypeList as $key => $value) {
													echo "<option value='" . $value->id . "'>" . $value->decision_type_name . "</option>";
												} ?>
											</select>
										</div>
									</div> -->
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
										<div class="col-sm-8">
											<input name="decisionDate[]" placeholder="Decision Date" class="form-control" type="date">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('decision'); ?></label>
										<div class="col-sm-8">
											<input name="decision[]" placeholder="Decision" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_name'); ?></label>
										<div class="col-sm-8">
											<input name="defenceLawyerName[]" placeholder="defence Lawyer Name" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_certificate_id'); ?></label>
										<div class="col-sm-8">
											<input name="defenceLawyerCertificateId[]" placeholder="defence Lawyer Certificate Id" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('sentence_execution_date'); ?></label>
										<div class="col-sm-8">
											<input name="sentenceExecutionDate[]" placeholder="Sentence Execution Date" class="form-control" type="date">
										</div>
									</div>

								</fieldset>
								
							</div>
								<?php } ?>
	<!-- END of Iteration of Court Types -->
					</div>
	<!-- ------------------------------------------------------------------- -->
					<div class="row">
						<hr />
					</div>

					<div class="row">
	<!-- --------------------------------- Criminal Case Column 1 ---------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('command_issue_date'); ?></label>
								<div class="col-sm-8">
									<input name="commandIssueDate" placeholder="Command Issue Date" class="form-control" type="date">
								</div>
							</div>

						</div>
	<!-- -------------------------------- Criminal Case Column 2 ----------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('time_spent_in_prison'); ?></label>
								<div class="col-sm-8">
									<input name="timeSpentInPrison" placeholder="Time Spent_in Prison" class="form-control" type="text">
								</div>
							</div>
						</div>
	<!-- -------------------------------- Criminal Case Column 3 ----------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('remaining_jail_term'); ?></label>
								<div class="col-sm-8">
									<input name="remainingJailTerm" placeholder="Remaining Jail Term" class="form-control" type="text">
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="padding-left: 12px; padding-right: 12px;">
	<!-- -----------------------------------Criminal Case last section -------------------------------- -->
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('use_benefit_forgiveness_presidential'); ?></label>
								<!-- <input name="useBenefitForgivenessPresidential" placeholder="Use Benefit Forgiveness Presidential" class="form-control" type="text"> -->
								<textarea name="useBenefitForgivenessPresidential" class="form-control" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('commission_proposal'); ?></label>
								<!-- <input name="commissionProposal" placeholder="Commission Proposal" class="form-control" type="text"> -->
								<textarea name="commissionProposal" class="form-control" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('prisoner_request'); ?></label>
								<!-- <input name="prisonerRequest" placeholder="Prisoner Request" class="form-control" type="text"> -->
								<textarea name="prisonerRequest" class="form-control" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('commission_member'); ?></label>
								<!-- <input name="commissionMember" placeholder="Commission Member" class="form-control" type="text"> -->
								<textarea name="commissionMember" class="form-control" rows="3"></textarea>
							</div>
						</div>

					</div>
				</form>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					<button type="button" id="btnSave" onclick="save_record()" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
		
		<link rel="stylesheet" href="<?php echo base_url("assets/datatables/media/css/dataTables.bootstrap.min.css"); ?>" />
		<script src="<?php echo base_url('assets/datatables/media/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/media/js/dataTables.bootstrap.min.js')?>"></script>
		<script src="<?php echo base_url('assets/underscore-min.js')?>"></script>
		  
		  
		<script type= 'text/javascript'>
			var save_method; //for save method string
		    var oTable;
		    var provincesList = <?= json_encode($provincesList) ?>;
		    var districtsList = <?= json_encode($districtsList) ?>;
		    var photos_directory = "<?= base_url('photos/') ?>";

            $(document).ready(function () {
            	$("li#general", ".navbar-nav").addClass("active");
            	$("input[type='date']").datepicker({
            		dateFormat: "yy-mm-dd"
            	});
            	

            	$('[name="newPrisoner"]', '#newCaseRegistrationForm').change(function(event) {
            		var isChecked = $(event.currentTarget).prop('checked');
            		console.log(isChecked);
            		if(isChecked) {
            			$('#searchPrisonerIdInput', '#newCaseRegistrationForm').val("");
            			$('#searchPrisonerIdInput', '#newCaseRegistrationForm').parent().parent().parent().prop('disabled', true);
            			$('#existingPrisonForm', '#newCaseRegistrationForm').slideUp();
            			clean_prisoner_view_form();
            			$('#newPrisonForm', '#newCaseRegistrationForm').slideDown();
            		} else {
            			$('#searchPrisonerIdInput', '#newCaseRegistrationForm').parent().parent().parent().prop('disabled', false);
            			$('#newPrisonForm', '#newCaseRegistrationForm').slideUp();
            		}
            	});

            	
            	$('#searchPrisonerIdBtn', '#newCaseRegistrationForm').click(function(event) {
            		var prisonerId = $('#searchPrisonerIdInput', '#newCaseRegistrationForm').val();
            		view_prisoner_record(prisonerId);
            	});

                // $('[name="permanentProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarget.value), $('[name="permanentDistrict"]', '#modal_form_edit'));
                // });

                // $('[name="presentProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarget.value), $('[name="presentDistrict"]', '#modal_form_edit'));
                // });

                $('[name="crimeProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="newCaseRegistrationForm"]', '#modal_form_edit'));
                });

                $('[name="arrestProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="arrestDistrict"]', '#newCaseRegistrationForm'));
                });

                $('[name="permanentProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="permanentDistrict"]', '#modal_form_edit'));
                });

                $('[name="presentProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="presentDistrict"]', '#modal_form_edit'));
                });
            });

            function get_district_list(province_id)
            {
            	return _.where(districtsList, {"province_id": province_id});
            }

            function render_district_list(district_list, selectEl)
            {
            	$(selectEl).empty();
            	$('<option>').appendTo(selectEl);
            	$.each(district_list, function(index, value) {
					$('<option>').attr('value', value.id).html(value.name).appendTo(selectEl);
				});
            }

            function clean_prisoner_view_form()
            {
            	var existingPrisonFormDiv = $('#existingPrisonForm', '#newCaseRegistrationForm');
            	$("p", existingPrisonFormDiv).empty();
            	$("img", existingPrisonFormDiv).prop("src", "");
            }

            function view_prisoner_record(id)
			{
				$('#existingPrisonForm', '#newCaseRegistrationForm').slideUp();
				clean_prisoner_view_form();
				//Ajax Load data from ajax
				$.ajax({
					url : "<?php echo site_url('prisoner/view/')?>/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data)
					{
						if(data.success === true) {
							if (data.result !== null) {
								$('p#id', '#newCaseRegistrationForm').html(data.result.id);
								$('p#tazkiraNumber', '#newCaseRegistrationForm').html(data.result.tazkira_number);
								$('p#name', '#newCaseRegistrationForm').html(data.result.name);
								$('p#fatherName', '#newCaseRegistrationForm').html(data.result.father_name);
								$('p#grandFatherName', '#newCaseRegistrationForm').html(data.result.grand_father_name);
								$('p#age', '#newCaseRegistrationForm').html(data.result.age);
								$('p#maritalStatus', '#newCaseRegistrationForm').html(data.result.marital_status);
								$('p#numOfChildren', '#newCaseRegistrationForm').html(data.result.num_of_children);
								$('p#criminalHistory', '#newCaseRegistrationForm').html(data.result.criminal_history===1? 'Yes': 'No');
								$('p#permanentProvince', '#newCaseRegistrationForm').html(data.result.permanent_province);
								$('p#permanentDistrict', '#newCaseRegistrationForm').html(data.result.permanent_district);
								$('p#presentProvince', '#newCaseRegistrationForm').html(data.result.present_province);
								$('p#presentDistrict', '#newCaseRegistrationForm').html(data.result.present_district);
								
								if(data.result.profile_pic !== '' && data.result.profile_pic !== null)
								{
									$('img#profilePic', '#newCaseRegistrationForm').attr("src", photos_directory + '/' + data.result.profile_pic);
									$('img#profilePic', '#newCaseRegistrationForm').attr("alt", 'Failed to display the photo.');
								}
								else
								{
									$('img#profilePic', '#newCaseRegistrationForm').attr("alt", 'Profile photo is not uploaded.');
								}

								$('#existingPrisonForm', '#newCaseRegistrationForm').slideDown();
							} else {
								alert("A prisoner with entered ID doesn't exist in database.");
							}
							
						} else {
							alert(data.message);
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error get data from ajax');
					}
				});
			}

			function save_record()
			{
				var url;
				if(save_method == 'new')
				{
					url = "<?php echo site_url('general/add')?>";
				}
				else
				{
					url = "<?php echo site_url('general/update')?>";
				}

				var formData = new FormData($('#form', '#modal_form_edit')[0]);

				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: $('#form', '#modal_form_edit').serialize(),
					dataType: "JSON",
					success: function(data)
					{
						if(data.success === true)
						{
							// $('#modal_form_edit').modal('hide');
							reload_table();
						}
						else
						{
							alert(data.message);
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error adding / update data');
					}
				});

				// ajax adding data to database
				// $.ajax({
				// 	url : url,
				// 	type: "POST",
				// 	data: $('#form', '#modal_form_edit').serialize(),
				// 	dataType: "JSON",
				// 	success: function(data)
				// 	{
				// 		//if success close modal and reload ajax table
				// 		$('#modal_form_edit').modal('hide');
				// 		reload_table();
				// 	},
				// 	error: function (jqXHR, textStatus, errorThrown)
				// 	{
				// 		alert('Error adding / update data');
				// 	}
				// });
			}
		</script>

		<?php $this->load->view('footer'); ?>
	</body>
</html>
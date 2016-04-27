<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 70px;" dir="<?=$this->session->userdata('direction') ?>">
		<?php $this->load->view('menu_bar'); ?>
		<div class="container">
			<h3>
				<?php if(!$isEdit) { ?>
					&nbsp;<?= $this->lang->line('new_case'); ?>&nbsp;
				<?php } else { ?>
					&nbsp;<?= $this->lang->line('edit_case'); ?>&nbsp;
				<?php } ?>
			</h3>
			<hr />
			<div id="newCaseRegistrationForm">
				<form action="#" id="form" class="form-horizontal">
					<?php if(!$isEdit) { ?>
					<div class="row">
	<!-- ------------------------------------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="newPrisoner"> <?= $this->lang->line('is_new_prisoner'); ?>
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
											<button class="btn btn-primary" id="searchPrisonerIdBtn" type="button"> <?= $this->lang->line('verify'); ?> </button>
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
						<input type="hidden" value="" name="prisoner_id"/>
	<!-- ---------------------------- view Prisoer Column 1 --------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="prisoner_id"></p>
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
										<img id="profilePicDisplay" alt="Profile Photo" class="img-rounded" src="<?= base_url('assets/images/') ?>/profile.png">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row" id="newPrisonForm" style="display: none;">
					<?php } else { ?>
					<div class="row" id="newPrisonForm">
					<?php } ?>
	<!-- ---------------------------- new Prisoer Column 1 --------------------------------------- -->
						<div class="col-sm-4">
							<?php if($isEdit) { ?>
								<input type="hidden" value="<?= $prisoner->id ?>" name="prisoner_id"/>
							<?php } ?>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('tazkira_number'); ?></label>
								<div class="col-sm-8">
									<input name="tazkiraNumber" placeholder="Tazkira Number" class="form-control" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('name'); ?></label>
								<div class="col-md-8">
									<input name="name" placeholder="Name" class="form-control" type="text" <?php echo $isEdit? 'value="' . $prisoner->name . '"': ''; ?> >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('father_name'); ?></label>
								<div class="col-md-8">
									<input name="fatherName" placeholder="Father Name" class="form-control" type="text" <?php echo $isEdit? 'value="' . $prisoner->father_name . '"': ''; ?> >
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('grand_father_name'); ?></label>
								<div class="col-sm-8">
									<input name="grandFatherName" placeholder="Grand Father Name" class="form-control" type="text" <?php echo $isEdit? 'value="' . $prisoner->grand_father_name . '"': ''; ?> >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('age'); ?></label>
								<div class="col-sm-8">
									<input name="age" placeholder="Age" class="form-control" type="number" <?php echo $isEdit? 'value="' . $prisoner->age . '"': ''; ?> >
								</div>
							</div>
							<div class="form-group has-error">
								<label class="control-label col-sm-4"><?= $this->lang->line('marital_status'); ?></label>
								<div class="col-sm-8">
									<select name="maritalStatus" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($maritalStatusList as $key => $value) {
											if ($isEdit && $prisoner->marital_status_id == $value->id) {
												echo "<option value='" . $value->id . "' selected>" . $value->status . "</option>";
											} else {
												echo "<option value='" . $value->id . "'>" . $value->status . "</option>";
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('num_of_children'); ?></label>
								<div class="col-sm-8">
									<input name="numOfChildren" placeholder="Number of Children" class="form-control" type="number" <?php echo $isEdit? 'value="' . $prisoner->num_of_children . '"': ''; ?> >
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
							<div class="form-group has-error">
								<label class="control-label col-sm-4"><?= $this->lang->line('permanent_province'); ?></label>
								<div class="col-sm-8">
									<select name="permanentProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											if ($isEdit && $prisoner->permanent_province_id == $value->id) {
												echo "<option value='" . $value->id . "' selected>" . $value->name . "</option>";
											} else {
												echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group has-error">
								<label class="control-label col-sm-4"><?= $this->lang->line('permanent_district'); ?></label>
								<div class="col-sm-8">
									<select name="permanentDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group has-error">
								<label class="control-label col-sm-4"><?= $this->lang->line('present_province'); ?></label>
								<div class="col-sm-8">
									<select name="presentProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											if ($isEdit && $prisoner->present_province_id == $value->id) {
												echo "<option value='" . $value->id . "' selected>" . $value->name . "</option>";
											} else {
												echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group has-error">
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
										<img id="profilePicDisplay" alt="Profile Photo" class="img-rounded" src="<?= (!empty($prisoner->profile_pic)?  base_url('photos/') . '/' . $prisoner->profile_pic: base_url('assets/images/') . '/profile.png') ?> ">
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
							<input type="hidden" name="crimeId"  <?php echo $isEdit? 'value="' . $crime->id . '"': ''; ?> />
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crime_id"><?php echo $isEdit? $crime->id: ''; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('registration_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="registrationDate"><?php echo $isEdit? $crime->registration_date: ''; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('case_number'); ?></label>
								<div class="col-md-8">
									<input name="caseNumber" placeholder="Case Number" class="form-control" type="text" <?php echo $isEdit? 'value="' . $crime->case_number . '"': ''; ?> >
								</div>
							</div>
							<div class="form-group has-error">
								<label class="control-label col-md-4"><?= $this->lang->line('crime_type'); ?></label>
								<div class="col-md-8">
									<select multiple name="crimeType[]" class="form-control" class="form-control">
										<option></option>
										<?php 
										$crimeTypesArray = array();
										if ($isEdit) {
											foreach ($crimeTypes as $key => $value) {
												$crimeTypesArray[] = $value->id;
											}
										}

										foreach ($crimeTypeList as $key => $value) {
											if ($isEdit && in_array($value->id, $crimeTypesArray)) {
												echo "<option value='" . $value->id . "' selected>" . $value->type_name . "</option>";
											} else {
												echo "<option value='" . $value->id . "'>" . $value->type_name . "</option>";
											}
										} ?>
									</select>
									<span><small><?= $this->lang->line('select_multiple_tip'); ?></small></span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('police_custody'); ?></label>
								<div class="col-md-8">
									<input name="policeCustody" placeholder="Police Custody" class="form-control" type="text" <?php echo $isEdit? 'value="' . $crime->police_custody . '"': ''; ?> >
								</div>
							</div>
						</div>
	<!-- ------------------------------ Criminal Case Column 2 ------------------------------------- -->
						<div class="col-sm-4">
							<br><br><br><br>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('crime_date'); ?></label>
								<div class="col-md-8">
									<input name="crimeDate" placeholder="Crime Date" class="form-control date" type="text" <?php echo $isEdit? 'value="' . $crime->crime_date_shamsi . '"': ''; ?> >
								</div>
							</div>
							<div class="form-group has-error">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_province'); ?></label>
								<div class="col-sm-8">
									<select name="crimeProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											if ($isEdit && $crime->crime_province_id == $value->id) {
												echo "<option value='" . $value->id . "' selected>" . $value->name . "</option>";
											} else {
												echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group has-error">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_district'); ?></label>
								<div class="col-sm-8">
									<select name="crimeDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_location'); ?></label>
								<div class="col-sm-8">
									<input name="crimeLocation" placeholder="Crime Location" class="form-control" type="text" <?php echo $isEdit? 'value="' . $crime->crime_location . '"': ''; ?> >
								</div>
							</div>
						</div>
	<!-- -------------------------------- Criminal Case Column 3 ----------------------------------- -->
						<div class="col-sm-4">
							<br><br><br><br>
							<div class="form-group">
								<label class="control-label col-md-4"><?= $this->lang->line('arrest_date'); ?></label>
								<div class="col-md-8">
									<input name="arrestDate" placeholder="Arrest Date" class="form-control date" type="text" <?php echo $isEdit? 'value="' . $crime->arrest_date_shamsi . '"': ''; ?> >
								</div>
							</div>
							<div class="form-group has-error">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_province'); ?></label>
								<div class="col-sm-8">
									<select name="arrestProvince" class="form-control" class="form-control">
										<option></option>
										<?php foreach ($provincesList as $key => $value) {
											if ($isEdit && $crime->arrest_province_id == $value->id) {
												echo "<option value='" . $value->id . "' selected>" . $value->name . "</option>";
											} else {
												echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="form-group has-error">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_district'); ?></label>
								<div class="col-sm-8">
									<select name="arrestDistrict" class="form-control" class="form-control">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_location'); ?></label>
								<div class="col-sm-8">
									<input name="arrestLocation" placeholder="Arrest Location" class="form-control" type="text" <?php echo $isEdit? 'value="' . $crime->arrest_location . '"': ''; ?> >
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="padding-left: 12px; padding-right: 12px;">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('crime_reason'); ?></label>
								<!-- <input name="commissionMember" placeholder="Commission Member" class="form-control" type="text"> -->
								<textarea name="crimeReason" class="form-control" rows="3"><?php echo $isEdit? $crime->crime_reason: ''; ?> </textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('crime_supporter'); ?></label>
								<!-- <input name="commissionMember" placeholder="Commission Member" class="form-control" type="text"> -->
								<textarea name="crimeSupporter" class="form-control" rows="3"><?php echo $isEdit? $crime->crime_supporter: ''; ?> </textarea>
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
							<?php 	$found = false; ?>
							<?php 	if(isset($courtSessions)) { ?>
							<?php  		foreach ($courtSessions as $k => $v) {
											if ($value->id == $v->court_decision_type_id) { 
												$found = true; ?>

							<div class="col-sm-4">
								<fieldset>
									<legend style="background-color: seashell;"><?= $value->decision_type_name; ?></legend>

									<input type="hidden" value="<?= $v->id ?>" name="courtSessionId[]"/>
									<!-- <input type="hidden" value="<?= $v->crime_id ?>" name="crimeId[]"/> -->
									<input type="hidden" value="<?= $value->id ?>" name="courtDecisionType[]"/>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
										<div class="col-sm-8">
											<input name="decisionDate[]" placeholder="Decision Date" class="form-control date" type="text" <?php echo $isEdit? 'value="' . $v->decision_date_shamsi . '"': ''; ?> >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('decision'); ?></label>
										<div class="col-sm-8">
											<input name="decision[]" placeholder="Decision" class="form-control" type="text" <?php echo $isEdit? 'value="' . $v->decision . '"': ''; ?> >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_name'); ?></label>
										<div class="col-sm-8">
											<input name="defenceLawyerName[]" placeholder="defence Lawyer Name" class="form-control" type="text" <?php echo $isEdit? 'value="' . $v->defence_lawyer_name . '"': ''; ?> >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_certificate_id'); ?></label>
										<div class="col-sm-8">
											<input name="defenceLawyerCertificateId[]" placeholder="defence Lawyer Certificate Id" class="form-control" type="text" <?php echo $isEdit? 'value="' . $v->defence_lawyer_certificate_id . '"': ''; ?> >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('sentence_execution_date'); ?></label>
										<div class="col-sm-8">
											<input name="sentenceExecutionDate[]" placeholder="Sentence Execution Date" class="form-control date" type="text" <?php echo $isEdit? 'value="' . $v->sentence_execution_date_shamsi . '"': ''; ?> >
										</div>
									</div>

								</fieldset>
								
							</div>
							<?php 		}
									}
								}

								if (!$found) { ?>
							<div class="col-sm-4">
								<fieldset>
									<legend style="background-color: seashell;"><?= $value->decision_type_name; ?></legend>

									<input type="hidden" name="courtSessionId[]"/>
									<input type="hidden" value="<?= $value->id ?>" name="courtDecisionType[]"/>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
										<div class="col-sm-8">
											<input name="decisionDate[]" placeholder="Decision Date" class="form-control date" type="text">
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
											<input name="sentenceExecutionDate[]" placeholder="Sentence Execution Date" class="form-control date" type="text">
										</div>
									</div>

								</fieldset>
								
							</div>

							<?php }
								} ?>
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
									<input name="commandIssueDate" placeholder="Command Issue Date Multiple" class="form-control" type="text" <?php echo $isEdit? 'value="' . $crime->command_issue_date_shamsi . '"': ''; ?> >
								</div>
							</div>

						</div>
	<!-- -------------------------------- Criminal Case Column 2 ----------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('time_spent_in_prison'); ?></label>
								<div class="col-sm-8">
									<input name="timeSpentInPrison" placeholder="Time Spent_in Prison" class="form-control" type="text" <?php echo $isEdit? 'value="' . $crime->time_spent_in_prison . '"': ''; ?> >
								</div>
							</div>
						</div>
	<!-- -------------------------------- Criminal Case Column 3 ----------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('remaining_jail_term'); ?></label>
								<div class="col-sm-8">
									<input name="remainingJailTerm" placeholder="Remaining Jail Term" class="form-control" type="text" <?php echo $isEdit? 'value="' . $crime->remaining_jail_term . '"': ''; ?> >
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
								<textarea name="useBenefitForgivenessPresidential" class="form-control" rows="3"><?php echo $isEdit? $crime->use_benefit_forgiveness_presidential: ''; ?> </textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('commission_proposal'); ?></label>
								<!-- <input name="commissionProposal" placeholder="Commission Proposal" class="form-control" type="text"> -->
								<textarea name="commissionProposal" class="form-control" rows="3"><?php echo $isEdit? $crime->commission_proposal: ''; ?> </textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('prisoner_request'); ?></label>
								<!-- <input name="prisonerRequest" placeholder="Prisoner Request" class="form-control" type="text"> -->
								<textarea name="prisonerRequest" class="form-control" rows="3"><?php echo $isEdit? $crime->prisoner_request: ''; ?> </textarea>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('commission_member'); ?></label>
								<!-- <input name="commissionMember" placeholder="Commission Member" class="form-control" type="text"> -->
								<textarea name="commissionMember" class="form-control" rows="3"><?php echo $isEdit? $crime->commission_member: ''; ?> </textarea>
							</div>
						</div>

					</div>
				</form>

				<div class="modal-footer">
					<a class="btn btn-danger" href="<?= base_url() ?>index.php/home">Cancel</a>
					<button type="button" id="btnSave" onclick="save_record()" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
		
		<link rel="stylesheet" href="<?php echo base_url('assets/persianDatepicker/css/persianDatepicker-default.css')?>" />
		<script src="<?php echo base_url('assets/persianDatepicker/js/persianDatepicker.min.js')?>"></script>
		<script src="<?php echo base_url('assets/underscore-min.js')?>"></script>
		  
		  
		<script type= 'text/javascript'>
			var save_method; //for save method string
		    var oTable;
		    var provincesList = <?= json_encode($provincesList) ?>;
		    var districtsList = <?= json_encode($districtsList) ?>;
		    var photos_directory = "<?= base_url('photos/') ?>";

            $(document).ready(function () {
            	$("li#general", ".navbar-nav").addClass("active");

            	// $("input[type='date']").datepicker({
            	// 	dateFormat: "yy-mm-dd"
            	// });

				var months;
				<?php if($this->session->userdata('language') == 'dari') { ?>
					months = ["حمل", "ثور", "جوزا", "سرطان", "اسد", "سنبله", "میزان", "عقرب", "قوس", "جدی", "دلو", "حوت"],
					// ["حوت", "دلو", "جدی", "قوس", "عقرب", "میزان", "سنبله", "اسد", "سرطان", "جوزا", "ثور", "حمل"],
				<?php } else { ?>
					months = ["وری", "غويی", "غبرګولی", "چنګاښ", "زمری", "وږی", "تله", "لړم", "ليندۍ", "مرغومی", "سلواغه", "كب"],
					// ["كب", "سلواغه", "مرغومی", "ليندۍ", "لړم", "تله", "وږی", "زمری", "چنګاښ", "غبرګولی", "غويی", "وری"],
				<?php } ?>

				$("input.date", '#newCaseRegistrationForm').persianDatepicker({
					alwaysShow: false,
					closeOnBlur: false,
					months: months,
					formatDate: "YYYY-0M-0D",
					cellWidth: 35, 
					cellHeight: 30,
					fontSize: 18,
				});

            	$('#form', '#newCaseRegistrationForm')[0].reset(); // reset form 

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
            		$('[name="prisoner_id"]', '#newCaseRegistrationForm').val("");
            		view_prisoner_record(prisonerId);
            	});

            	<?php if($isEdit) { ?>
	            	triggerProvincesToSelectDistricts();
	            	$('[name="crimeDistrict"]', '#newCaseRegistrationForm').val('<?= $crime->crime_district_id? $crime->crime_district_id: ''; ?>');
	            	$('[name="arrestDistrict"]', '#newCaseRegistrationForm').val('<?= $crime->arrest_district_id? $crime->arrest_district_id: ''; ?>');
	            	$('[name="permanentDistrict"]', '#newCaseRegistrationForm').val('<?= $prisoner->permanent_district_id? $prisoner->permanent_district_id: ''; ?>');
	            	$('[name="presentDistrict"]', '#newCaseRegistrationForm').val('<?= $prisoner->present_district_id? $prisoner->present_district_id: ''; ?>');
	            <?php } ?>
                // $('[name="permanentProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarget.value), $('[name="permanentDistrict"]', '#modal_form_edit'));
                // });

                // $('[name="presentProvince"]', '#modal_form_edit').change(function(event) {
                // 	render_district_list(get_district_list(event.currentTarg<et.value), $('[name="presentDistrict"]', '#modal_form_edit'));
                // });

                $('[name="crimeProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="crimeDistrict"]', '#newCaseRegistrationForm'));
                });

                $('[name="arrestProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="arrestDistrict"]', '#newCaseRegistrationForm'));
                });

                $('[name="permanentProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="permanentDistrict"]', '#newCaseRegistrationForm'));
                });

                $('[name="presentProvince"]', '#newCaseRegistrationForm').change(function(event) {
                	render_district_list(get_district_list(event.currentTarget.value), $('[name="presentDistrict"]', '#newCaseRegistrationForm'));
                });
            });

			function triggerProvincesToSelectDistricts()
			{
				render_district_list(get_district_list($('[name="crimeProvince"]', '#newCaseRegistrationForm').val()), $('[name="crimeDistrict"]', '#newCaseRegistrationForm'));
				render_district_list(get_district_list($('[name="arrestProvince"]', '#newCaseRegistrationForm').val()), $('[name="arrestDistrict"]', '#newCaseRegistrationForm'));
				render_district_list(get_district_list($('[name="permanentProvince"]', '#newCaseRegistrationForm').val()), $('[name="permanentDistrict"]', '#newCaseRegistrationForm'));
				render_district_list(get_district_list($('[name="presentProvince"]', '#newCaseRegistrationForm').val()), $('[name="presentDistrict"]', '#newCaseRegistrationForm'));
			}

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
								$('[name="prisoner_id"]', '#newCaseRegistrationForm').val(data.result.id);

								$('p#prisoner_id', '#newCaseRegistrationForm').html(data.result.id);
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
									$('img#profilePicDisplay', '#newCaseRegistrationForm').attr("src", photos_directory + '/' + data.result.profile_pic);
									$('img#profilePicDisplay', '#newCaseRegistrationForm').attr("alt", 'Failed to display the photo.');
								}
								else
								{
									$('img#profilePicDisplay', '#newCaseRegistrationForm').attr("alt", 'Profile photo is not uploaded.');
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
				<?php if($isEdit) { ?>
				var url = "<?php echo site_url('general/update')?>";
				<?php } else { ?>
				var url = "<?php echo site_url('general/add')?>";
				<?php } ?>
				
				var formData = new FormData($('#form', '#newCaseRegistrationForm')[0]);

				// ajax adding data to database
				$.ajax({
					url : url,
					type: "POST",
					data: formData,
					mimeType: "multipart/form-data",
					contentType: false,
					cache: false,
					processData: false,
					success: function(data)
					{
						data = JSON.parse(data);
						if(data.success === true)
						{
							<?php if($isEdit) { ?>
								window.location.replace("<?= base_url() ?>index.php/general/view_case/" + data.result);
							<?php } else { ?>
								if(confirm("Successfully saved. If you want to register another case then click ok.")) {
									window.location.reload(false);
								} else {
									window.location.replace("<?= base_url() ?>index.php/general/view_case/" + data.result);
								}
							<?php } ?>
							
							
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
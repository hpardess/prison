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
			<div id="viewCaseRegistrationForm">
				<form action="#" id="form" class="form-horizontal">
					<div class="row">
	<!-- ---------------------------- view Prisoer Column 1 --------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('prisoner_id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"><?= $prisoner->id; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('tazkira_number'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="tazkiraNumber"><?= $prisoner->tazkira_number; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="name"><?= $prisoner->name; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('father_name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="fatherName"><?= $prisoner->father_name; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('grand_father_name'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="grandFatherName"><?= $prisoner->grand_father_name; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('age'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="age"><?= $prisoner->age; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('marital_status'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="maritalStatus"><?= $prisoner->marital_status; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('num_of_children'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="numOfChildren"><?= $prisoner->num_of_children; ?></p>
								</div>
							</div>
						</div>
	<!-- ----------------------------- view Prisoer Column 2 -------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('criminal_history'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="criminalHistory"><?= $prisoner->criminal_history==1? $this->lang->line('yes'): $this->lang->line('no');?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('permanent_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentProvince"><?= $prisoner->permanent_province; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('permanent_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="permanentDistrict"><?= $prisoner->permanent_district; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('present_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentProvince"><?= $prisoner->present_province; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('present_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="presentDistrict"><?= $prisoner->present_district; ?></p>
								</div>
							</div>
						</div>
	<!-- ------------------------------ view Prisoer Column 3 ------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group center-block">
								<div class="col-sm-8 col-sm-offset-2">
									<div class="thumbnail">
										<img id="profilePicDisplay" alt="Profile Photo" class="img-rounded" src="<?= base_url('photos/') . '/' . $prisoner->profile_pic; ?>">
									</div>
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
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_id'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="id"><?= $crime->id; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('registration_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="registrationDate"><?= $crime->registration_date; ?></p>
								</div>
							</div>
	                    	<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('case_number'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="caseNumber"><?= $crime->case_number; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_type'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeType">
										<?php
											$crimeTypesArray = [];
											foreach ($crimeTypes as $key => $value) {
												$crimeTypesArray[] = $value->type_name;
											}
											echo implode(', ', $crimeTypesArray);
										?>
									</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('police_custody'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="policeCustody"><?= $crime->police_custody; ?></p>
								</div>
							</div>
						</div>
	<!-- ------------------------------ Criminal Case Column 2 ------------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeDate"><?= $crime->crime_date .' | ' . $crime->crime_date_shamsi; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeProvince"><?= $crime->crime_province; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeDistrict"><?= $crime->crime_district; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('crime_location'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="crimeLocation"><?= $crime->crime_location; ?></p>
								</div>
							</div>
						</div>
	<!-- -------------------------------- Criminal Case Column 3 ----------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_date'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestDate"><?= $crime->arrest_date .' | ' . $crime->arrest_date_shamsi; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_province'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestProvince"><?= $crime->arrest_province; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_district'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestDistrict"><?= $crime->arrest_district; ?></p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('arrest_location'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="arrestLocation"><?= $crime->arrest_location; ?></p>
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="padding-left: 12px; padding-right: 12px;">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('crime_reason'); ?></label>
								<p class="form-control-static" id="crimeReason"><?= $crime->crime_reason; ?></p>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('crime_supporter'); ?></label>
								<p class="form-control-static" id="crimeSupporter"><?= $crime->crime_supporter; ?></p>
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
							<?php  foreach ($courtSessions as $k => $v) {
									if ($value->id == $v->court_decision_type_id) { 
										$found = true; ?>

							<div class="col-sm-4">
								<fieldset>
									<legend style="background-color: seashell;"><?= $value->decision_type_name; ?></legend>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('court_session_id'); ?></label>
										<div class="col-sm-8">
											<p class="form-control-static" id="id[<?= $key; ?>]"><?= $v->id ?></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
										<div class="col-sm-8">
											<p class="form-control-static" id="decisionDate[<?= $key; ?>]"><?= $v->decision_date .' | ' . $v->decision_date_shamsi?></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('decision'); ?></label>
										<div class="col-sm-8">
											<p class="form-control-static" id="decision[<?= $key; ?>]"><?= $v->decision ?></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_name'); ?></label>
										<div class="col-sm-8">
											<p class="form-control-static" id="defenceLawyerName[<?= $key; ?>]"><?= $v->defence_lawyer_name ?></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_certificate_id'); ?></label>
										<div class="col-sm-8">
											<p class="form-control-static" id="defenceLawyerCertificateId[<?= $key; ?>]"><?= $v->defence_lawyer_certificate_id ?></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"><?= $this->lang->line('sentence_execution_date'); ?></label>
										<div class="col-sm-8">
											<p class="form-control-static" id="sentenceExecutionDate[<?= $key; ?>]"><?= $v->sentence_execution_date .' | ' . $v->sentence_execution_date_shamsi?></p>
										</div>
									</div>

								</fieldset>
								
							</div>
								<?php 	} 
									}

									if (!$found) { ?>
										<div class="col-sm-4">
											<fieldset>
												<legend style="background-color: seashell;"><?= $value->decision_type_name; ?></legend>
												<div class="form-group">
													<label class="col-sm-4 control-label"><?= $this->lang->line('court_session_id'); ?></label>
													<div class="col-sm-8">
														<p class="form-control-static" id="id[<?= $key; ?>]"></p>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label"><?= $this->lang->line('decision_date'); ?></label>
													<div class="col-sm-8">
														<p class="form-control-static" id="decisionDate[<?= $key; ?>]"></p>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label"><?= $this->lang->line('decision'); ?></label>
													<div class="col-sm-8">
														<p class="form-control-static" id="decision[<?= $key; ?>]"></p>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_name'); ?></label>
													<div class="col-sm-8">
														<p class="form-control-static" id="defenceLawyerName[<?= $key; ?>]"></p>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label"><?= $this->lang->line('defence_lawyer_certificate_id'); ?></label>
													<div class="col-sm-8">
														<p class="form-control-static" id="defenceLawyerCertificateId[<?= $key; ?>]"></p>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label"><?= $this->lang->line('sentence_execution_date'); ?></label>
													<div class="col-sm-8">
														<p class="form-control-static" id="sentenceExecutionDate[<?= $key; ?>]"></p>
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
									<p class="form-control-static" id="commandIssueDate"><?= $crime->command_issue_date .' | ' . $crime->command_issue_date_shamsi; ?></p>
								</div>
							</div>

						</div>
	<!-- -------------------------------- Criminal Case Column 2 ----------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('time_spent_in_prison'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="timeSpentInPrison"><?= $crime->time_spent_in_prison; ?></p>
								</div>
							</div>
						</div>
	<!-- -------------------------------- Criminal Case Column 3 ----------------------------------- -->
						<div class="col-sm-4">
							<div class="form-group">
								<label class="col-sm-4 control-label"><?= $this->lang->line('remaining_jail_term'); ?></label>
								<div class="col-sm-8">
									<p class="form-control-static" id="remainingJailTerm"><?= $crime->remaining_jail_term; ?></p>
								</div>
							</div>
						</div>
					</div>

					<div class="row" style="padding-left: 12px; padding-right: 12px;">
	<!-- -----------------------------------Criminal Case last section -------------------------------- -->
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('use_benefit_forgiveness_presidential'); ?></label>
								<p class="form-control-static" id="useBenefitForgivenessPresidential"><?= $crime->use_benefit_forgiveness_presidential; ?></p>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('commission_proposal'); ?></label>
									<p class="form-control-static" id="commissionProposal"><?= $crime->commission_proposal; ?></p>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('prisoner_request'); ?></label>
								<p class="form-control-static" id="prisonerRequest"><?= $crime->prisoner_request; ?></p>
							</div>
							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('commission_member'); ?></label>
								<p class="form-control-static" id="commissionMember"><?= $crime->commission_member; ?></p>
							</div>
						</div>

					</div>
				</form>

				<div class="modal-footer">
					<?php if($hasEditRight) { ?>
					<a class="btn btn-primary" href="<?= base_url() ?>index.php/general/edit_case/<?= $crime->id; ?>"><i class="glyphicon glyphicon-pencil"></i> <?= $this->lang->line('edit'); ?></a>
					<?php } ?>
					<a class="btn btn-danger" href="<?= base_url() ?>index.php/home"> <?= $this->lang->line('cancel'); ?></a>
				</div>
			</div>
		</div>
		
		<!-- <link rel="stylesheet" href="<?php echo base_url("assets/datatables/media/css/dataTables.bootstrap.min.css"); ?>" />
		<script src="<?php echo base_url('assets/datatables/media/js/jquery.dataTables.min.js')?>"></script>
		<script src="<?php echo base_url('assets/datatables/media/js/dataTables.bootstrap.min.js')?>"></script>
		<script src="<?php echo base_url('assets/underscore-min.js')?>"></script> -->
		  
		  
		<script type= 'text/javascript'>
		    var photos_directory = "<?= base_url('photos/') ?>";
		</script>

		<?php $this->load->view('footer'); ?>
	</body>
</html>
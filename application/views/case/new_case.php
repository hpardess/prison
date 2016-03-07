<html>

	<head>
		<?php $this->load->view('meta'); ?>
		
		</head>
	<body style="padding-top: 52px;">
		<?php $this->load->view('menu_bar'); ?>

		<div class="container-fluid" >
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">New Registration</h3>
				</div>
				<div class="panel-body">

				<script type="text/javascript">
					$(function() {
						$("#crimeDate").datepicker();
						$("#dateOfArrest").datepicker();
						$("#dateOfSentence").datepicker();
						$("#dateOfSecondarySentence").datepicker();
						$("#dateOfFinalCourt").datepicker();
						
					});
				</script>
					<form class="form-horizontal">
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="email" class="form-control" id="idNumber" placeholder="IDNumber">
							</div>
							<label for="idNumber" class="col-sm-0 control-label"><h4>نمبر مسلسل</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="caseNumber" class="form-control" id="caseNumber" placeholder="caseNumber">
							</div>
							<label for="caseNumber" class="col-sm-0 control-label"><h4>نمبر قضیه</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="name" placeholder="Password">
							</div>
							<label for="name" class="col-sm-0 control-label"><h4>نام</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="fatherName" placeholder="Password">
							</div>
							<label for="fatherName" class="col-sm-0 control-label"><h4>ولد</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="grandFatherName" placeholder="Password">
							</div>
							<label for="grandFatherName" class="col-sm-0 control-label"><h4>ولدیت</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<div class="checkbox">
									<label>
										<input type="checkbox"> <h4>متاحل</h4>
									</label>
									<label>
										<input type="checkbox"> <h4>مجرد</h4>
									</label>
								</div>
							</div>
							<label for="maritalStatus" class="col-sm-0 control-label"><h4>حالت مدنی</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="residence" placeholder="Password">

							</div>
							<label for="residence" class="col-sm-0 control-label"><h4>سکونت</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="text" class="form-control" id="crimeType" placeholder="Password">
							</div>
							<label for="crimeType" class="col-sm-0 control-label"><h4>نوع جرم</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="crimeLocation" placeholder="Password">
							</div>
							<label for="crimeLocation" class="col-sm-0 control-label"><h4>محل جرم</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="crimeDate" placeholder="Password">
							</div>
							<label for="crimeDate" class="col-sm-0 control-label"><h4>تاریخ جرم</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="province" placeholder="Password">
							</div>
							<label for="province" class="col-sm-0 control-label"><h4>ولایت</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="palceOfArrest" placeholder="Password">
							</div>
							<label for="palceOfArrest" class="col-sm-0 control-label"><h4>محل دستگیری</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="dateOfArrest" placeholder="Password">
							</div>
							<label for="dateOfArrest" class="col-sm-0 control-label"><h4>تاریخ دستگیری</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="rightToSilent" placeholder="Password">
							</div>
							<label for="rightToSilent" class="col-sm-0 control-label"><h4>حق سکوت</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="timeInPoliceAttention" placeholder="Password">
							</div>
							<label for="timeInPoliceAttention" class="col-sm-0 control-label"><h4>مدت حبس در حوزه پولیس</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="preliminarySentence" placeholder="Password">
							</div>
							<label for="preliminarySentence" class="col-sm-0 control-label"><h4>فیصله ابتدای</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="dateOfSentence" placeholder="Password">
							</div>
							<label for="dateOfSentence" class="col-sm-0 control-label"><h4>تاریخ فیصله ابتدای</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="defenceLawyer" placeholder="Password">
							</div>
							<label for="defenceLawyer" class="col-sm-0 control-label"><h4>وکیل مدافع داشتید</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="lawyerName" placeholder="Password">
							</div>
							<label for="lawyerName" class="col-sm-0 control-label"><h4>نام وکیل مدافع</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="lawyerOrganization" placeholder="Password">
							</div>
							<label for="lawyerOrganization" class="col-sm-0 control-label"><h4>وکیل مدافع از کدام ارگان بود</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="secondarySentence" placeholder="Password">
							</div>
							<label for="secondarySentence" class="col-sm-0 control-label"><h4>فیصله استیناف</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="dateOfSecondarySentence" placeholder="Password">
							</div>
							<label for="dateOfSecondarySentence" class="col-sm-0 control-label"><h4>تاریخ فیصله استیناف</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="presenceOfLawyer" placeholder="Password">
							</div>
							<label for="presenceOfLawyer" class="col-sm-0 control-label"><h4>در فیصله استیناف وکیل مدافع داشتید</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="finalCourtSentence" placeholder="Password">
							</div>
							<label for="finalCourtSentence" class="col-sm-0 control-label"><h4>فیصله تمیز</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="dateOfFinalCourt" placeholder="Password">
							</div>
							<label for="dateOfFinalCourt" class="col-sm-0 control-label"><h4>تاریخ فیصله تمیز</h4></label>
						</div>
						<div class="form-group">
							
							<div class="col-sm-3">
								<input type="input" class="form-control" id="presenceOfLawyerAtFinalCourt" placeholder="Password">
							</div>
							<label for="presenceOfLawyerAtFinalCourt" class="col-sm-0 control-label"><h4>در فیصله تمیز وکیل مدافع داشتید</h4></label>
						</div>
						<div class="form-group">
							<div>
								<div class="col-sm-3">
								<input type="input" class="form-control" id="comment" placeholder="Password">
							</div>
							<label for="comment" class="col-sm-0 control-label"><h4>استفاده از مزایای عفو و بخشش فرامین مقام ریاست جمهوری</h4></label>
							
						</div>
					</form>


				</div>
				<div class="panel-footer">
					Panel footer
				</div>
			</div>
		</div>

		<?php $this->load->view('footer'); ?>
	</body>
</html>
   
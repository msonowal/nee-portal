<!DOCTYPE html>
  <html>
    <head>
      <title> NEE Portal {!! $year=Date('Y') !!}</title>
      <link href='https://fonts.googleapis.com/css?family=Roboto+Mono' rel='stylesheet' type='text/css'>
   </head>

<style type="text/css">
	div.block-1{
		border:0px solid #000;
		height: 1028px;
		width: 760px;
		margin: auto;
		margin-top: 20px;
		padding: 5px 5px 5px 5px;
	}
	div.block-2{
		border:1px solid #000;
		height: 171px;
		width: 748px;
		margin: auto;
		margin-top: 0px;
	}
	div.block-3{
		border:0px solid #000;
		height: 170px;
		width: 130px;
		text-align: center;
	}
	div.block-4{
		border:0px solid #000;
		height: 170px;
		width: 580px;
		text-align: center;
		margin-left: 34px;
		font-family: 'Roboto Mono';
		font-style: normal;
  		font-weight: 400;
  		font-size: 16px;
	}
	div.block-5{
		border:1px solid #000;
		height: 192px;
		width: 140px;
		padding:  3px 3px 3px 3px;
		text-align: right;
	}
	div.block-6{
		border-right:1px solid #000;
		border-left:1px solid #000;
		height: 30px;
		width: 744px;
		margin-left: 5px;
		color: #fff;
		padding: 6px 0px 0px 4px;
		background-color: #F44336;
		font-family: 'Roboto Mono';
		font-style: normal;
  		font-weight: 400;
  		font-size: 18px;
	}
	div.block-7{
		border:1px solid #000;
		height: 408px;
		width: 749px;
		margin: auto;
		margin-top: 0px;
		margin-bottom: 0px;
		border-right: 0px;
		font-family: 'Roboto Mono';
		font-style: normal;
  		font-weight: 400;
  		font-size: 12px;
	}
	div.block-8{
		border:0px solid #000;
		width: 740px;
		text-align: center;
	}
	div.block-9{
		border:1px solid #000;
		height: 30px;
		width: 747px;
		text-align: center;
	}
	div.block-10{
		border:1px solid #000;
		height: 360px;
		width: 738px;
		margin: auto;
		padding-left: 5px;
		padding-right: 5px;
		padding-top: 5px;
		margin-bottom: 10px;
		font-family: 'Roboto Mono';
		font-style: normal;
  		font-weight: 400;
  		font-size: 11px;
	}
	div.block-11{
		border:1px solid #000;
		height: 40px;
		width: 747px;
		
	}
	.table-1{
		border: 0px solid #5F5959;
		width: 100%;
		margin: auto;
		table-layout: fixed;

	}
	.table-2{
		border: 0px solid #5F5959;
		width: 100%;
		margin: auto;
		table-layout: fixed;

	}
	.table-3{
		border: 0px solid #5F5959;
		width: 100%;
		margin: auto;
		height: 167px;
		table-layout: fixed;
	}
	td{
		border:1px solid #000;
		border-top: 0px;
		border-left: 0px;
		padding-left: 5px;
	}
	.image{
		width: 130px;
		height: 148px;
		padding: 10px 0px 1px 0px;
	}
	.image-ms{
		width: 100px;
		height: 50px;
	}
	@media print {
   	.noprint{
      display: none !important;
   }
}
	
</style>
<body style="padding-top: 10px;">
<div style="float:right"><button class="noprint" onclick='window.print()'>Print</button></div>
<div class="block-1">
	<div class="block-2">
	<div class="block-4" style="float:left;">
		<br/>
		<P>North Eastern Regional Institute of Science and Technology </p>
		<p>Deemed University under MHRD, Govt. of India</p>
		<p>Nirjuli:791109, Arunachal Pradesh</p>
	</div>
	<div class="block-3" style="float:left;">
		<img src="{{ asset('images/logo.png') }}" class="image">
	</div>
	</div>
	<div class="block-6">
	<div class="block-8" style="float:left; margin:0px;">
		ADMIT CARD for NERIST Entrance Examination-{!! Date('Y') !!}
	</div>
	</div>
	<div class="block-7">
		<div>
		<table class="table-1" cellspacing="0" cellpadding="3">
			<tr>
				<td>
					Centre Code : {{ $centre_code}}({{ $centre_name }})
				</td>
				<td>
					Exam
				</td>
				<td>
					Roll Number
				</td>
			</tr>
			<tr>
				<td>
					Centre Location of Examination :
				</td>
				<td>
					{{ $exam_name }}
				</td>
				<td>
					{{ $candidate_info->rollno }}
				</td>
			</tr>
		</table>
		<table class="table-2" cellspacing="0" cellpadding="3">
			
			        <tr>
			          <td width="240" rowspan="3" valign="top">{{ $candidate_info->centre_capacities_id }}</td>
			          <td height="20" colspan="2" align="center" valign="middle">Date and Time of Exam</td>
			          <td width="140" rowspan="7" align="center">{!! Html::image($step3->getPhoto(), '', array('height' => '150px','width' => '140px')) !!} Candidate's Photo</td>
          </tr>
	        <tr>
			  <td width="23%" colspan="2" height="20">
				  {{ $exam_date }}</td>
			</tr>
			<tr>
			  <td height="20">Date of Birth</td>
		      <td height="20">{{ $step1->dob }}</td>
		  </tr>
			<tr>
			  <td width="240">Candidate's Name :</td>
			  <td height="20">Gender</td>
		      <td height="20">{{ $step1->gender }}</td>
		  </tr>
			<tr>
			  <td height="32">{{ $step2->name }}</td>
		      <td height="8">Registration No.</td>
		      <td height="8">{{ $registration_no }}</td>
		  </tr>
			<tr>
			  <td>Father/Guardian's Name:</td>
		      <td height="4">Reservation Code</td>
		      <td height="4">{{ $step1->reservation_code }}</td>
		  </tr>
			<tr>
			  <td height="32">{{ $step2->father_name}}</td>
			  <td height="4">Category</td>
		      <td height="4">{{ $step1->category }}</td>
		  </tr>
		</table>
		<table class="table-3" cellspacing="0" cellpadding="3">
			<tr>
				<td width="240">
					Complete Address:</td>
		  <td width="24%">
				Paper Code			</td>
		  <td width="24%">{{ $candidate_info->paper_code }}</td>
		  <td width="140" rowspan="3" align="center" valign="middle"> {!! Html::image($step3->getSignature(), '', array('height' => '40px','width' => '140px')) !!} Candidate's Signature</td>
		  </tr>
			<tr>
			  <td rowspan="2" valign="top">{{ $step2->village }}, {{ $step2->po }}, {{ $step2->pin }}, {{ $step2->district }}, {{ $step2->state }}</td>
			  <td height="50">{{ $sub_type }}</td>
		      <td>{{ $subject }}</td>
		  </tr>
			<tr>
			  <td height="92" colspan="2" align="center" valign="top"><img src="{{ asset('images/ms2015.jpg') }}" class="image-ms"><br/>
	           Member Secretary, NEE</td>
		  </tr>
		</table>
	  </div>
	</div>
	<div class="block-6">
		<div class="block-8">
			INSTRUCTIONS FOR THE CANDIDATES
		</div>
	</div>
	<div class="block-10">
		1. Please do not forget to bring <strong>BLACK BALL POINT PEN</strong> to darken the appropriate choices.<br/>
		2. <strong><u>Mobile Phones</u></strong> or any other electronic gadgets are <strong><u>strictly prohibited</u></strong> in the examination hall. Candidates are advised not to bring expensive personal items in the exam centre.<br/>
        3. Report 1 hour before the commencement of the examination at the examination centre. All the candidates are
expected to take their seats at least 20 minutes before the start of the examination.<br/>
        4. No candidate without admit card shall be allowed to sit in the examination by the centre superintendent.<br/>
        5. Entry to the examination hall is strictly forbidden after the first 30 minutes from the start of the examination, i.e, after 10.30 a.m.<br/>
        6. Candidates must preserve the admit card till the counselling / admission process is over.<br/>
        7. Candidates may leave the examination hall after the expiry of 1 hour from the start of the exam. However, he/she
will have to submit question paper to the invigilator which may be collected after the examination is over.<br/>
		8. Calculators / Log Tables, etc are <strong><u>not allowed for NEE‐I</u></strong>. Non programmable calculators are allowed for NEE‐II and
NEE‐III.<br/>
		9.  If a candidate darkens more than one answer it will be treated as incorrect.<br/>	
	   10. Adoption of any kind of unfair means or taking part in any act of impersonation in the examination will render the
candidate liable for cancellation of his/her OMR answer sheet and forfeiture of his/her claim for admission. Decision of
the centre superintendent / NERIST authorities shall be final in this regard.<br/>
       11. The Admit Card is issued provisionally to the candidate subject to his/her satisfying the eligibility condition at the
time of admission.<br/>
	   12. The selected or wait listed candidates may bring an affidavit in case of any mistakes in admit card, i.e., spelling mistake in name of candidate/father/guardian, gender and address at the time of counselling.<br/> 
	   13. In case of any dispute the decision of Chairman, NEE will be final.
	</div>
  </div>
</div>
</body>
</html>


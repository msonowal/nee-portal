<!DOCTYPE html>
  <html>
    <head>
      <title> NEE Portal {!! $year=Date('Y') !!}</title>
   </head>

<style type="text/css">
	div.block-1{
		border:0px solid #000;
		height: 853px;
		width: 760px;
		margin: auto;
		margin-top: 30px;
		margin-bottom: 100px;
		padding: 0px 5px 5px 5px;
	}
	div.block-2{
		border:1px solid #000;
		height: 200px;
		width: 748px;
		margin: auto;
		margin-top: 0px;
	}
	div.block-3{
		border:0px solid #000;
		height: 198px;
		width: 154px;
		text-align: center;
	}
	div.block-4{
		border:0px solid #000;
		height: 198px;
		width: 440px;
		text-align: center;
	}
	div.block-5{
		border:0px solid #000;
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
		background-color: #3399ff;
		font-weight: bold;
	}
	div.block-7{
		border:1px solid #000;
		height: 330px;
		width: 748px;
		margin: auto;
		margin-top: 0px;
		margin-bottom: 0px;
	}
	div.block-8{
		border:0px solid #000;
		width: 360px;
		margin-left: 5px;
	}
	table{
		border: 0px solid #000;
		width: 100%;
		margin: auto;
		table-layout: fixed;
	}
	td{
		padding: 5px 5px 5px 5px;
	}
	.image{
		width: 130px;
		height: 148px;
		padding: 20px 3px 3px 5px;
	}
	@media print {
   	.noprint{
      display: none !important;
   }

}
	
</style>
<body>
<div style="float:right"><button class="noprint" onclick='window.print()'>Print</button></div>
<div class="block-1">
	<div class="block-2">
	<div class="block-3" style="float:left;">
		<img src="{{ asset('images/logo.png') }}" class="image">
	</div>
	<div class="block-4" style="float:left;">
		<br/>
		<h3><P>NERIST ENTRANCE EXAMINATION {{ $year=Date('Y') }}</p></h3>
		<h3><p>Registration Confirmation Page</p></h3>
		<h4><p>Form No: {{ $candidate_info->form_no }}</p></h4>
		<h4><p>Registration No: {{ $registration_no }}</p></h4>
	</div>
	<div class="block-5" style="float:right;">{!! Html::image($step3->getPhoto(), '', array('height' => '150px','width' => '140px')) !!}<br/>
		 {!! Html::image($step3->getSignature(), '', array('height' => '40px','width' => '140px')) !!}
	</div>
	</div>
	<div class="block-6">
	<div class="block-8" style="float:left">
		Candidate's Personal Details
	</div>
	
	</div>
	<div class="block-7">
		<table>
			<tr>
				<td>
					Name:
				</td>
				<td>
					{{ $step2->name }}
				</td>
				<td>
					Father Name:
				</td>
				<td>
					{{ $step2->father_name }}
				</td>
			</tr>

			<tr>
				<td>
					Guardian Name:
				</td>
				<td>
					{{ $step2->guardian_name }}
				</td>
				<td>
					Nationality:
				</td>
				<td>
					{{ $step2->nationality }}
				</td>
			</tr>

			<tr>
				<td>
					Gender:
				</td>
				<td>
					{{ $step1->gender }}
				</td>
				<td>
					Date of Birth:
				</td>
				<td>
					{{ $step1->dob }}
				</td>
			</tr>

			<tr>
				<td>
					Relationship:
				</td>
				<td>
					{{ $step2->relationship }}
				</td>
				<td>
					Are you employed:
				</td>
				<td>
					{{ $step2->emp_status }}
				</td>
			</tr>

			<tr>
				<td>
					State:
				</td>
				<td>
					{{ $step2->state }}
				</td>
				<td>
					District:
				</td>
				<td>
					{{ $step2->district }}
				</td>
			</tr>

			<tr>
				<td>
					Post Office:
				</td>
				<td>
					{{ $step2->po }}
				</td>
				<td>
					PIN:
				</td>
				<td>
					{{ $step2->pin }}
				</td>
			</tr>

			<tr>
				<td>
					Mobile No:
				</td>
				<td>
					{{ $candidate->mobile_no }}
				</td>
				<td>
					Village:
				</td>
				<td>
					{{ $step2->village }}
				</td>
			</tr>

			<tr>
				<td>
					Email Id:
				</td>
				<td  colspan="3">
					{{ $candidate->email }}
				</td>
			</tr>
			<tr>
				<td>
					Address Line:
				</td>
				<td  colspan="3">
					{{ $step2->address_line }}
				</td>
			</tr>
		</table>
	</div>
	<div class="block-6">
		<div class="block-8" style="float:left">
			Candidate's Examination Details
		</div>
	</div>
	<div class="block-7">
		<table>
			<tr>
				<td>
					Quota:
				</td>
				<td>
					{{ $step1->quota }}
				</td>
				<td>
					Category:
				</td>
				<td>
					{{ $step1->category }}
				</td>
			</tr>

			<tr>
				<td>
					Are you Nerist Student:
				</td>
				<td>
					{{ $step1->nerist_stud }}
				</td>
				<td>
					Eligibility:
				</td>
				<td>
					{{ $candidate_info->q_id }}
				</td>
			</tr>

			<tr>
				<td>
					Eligibility Status:
				</td>
				<td>
					{{ $candidate_info->qualification_status }}
				</td>
				<td>
					Exam:
				</td>
				<td>
					{{ $candidate_info->exam_id }}
				</td>
			</tr>

			<tr>
				<td>
					For admission in::
				</td>
				<td>
					{{ $step1->admission_in }}
				</td>
				<td>
					Vocational Subject:
				</td>
				<td>
					{{ $step1->voc_subject }}
				</td>
			</tr>

			<tr>
				<td>
					Branch:
				</td>
				<td>
					{{ $step1->branch }}
				</td>
				<td>
					Branch Subject:
				</td>
				<td>
					{{ $step1->allied_branch }}
				</td>
			</tr>

			<tr>
				<td>
					Centre Preference 1:
				</td>
				<td>
					{{ $step1->c_pref1 }}
				</td>
				<td>
					Centre Preference 2:
				</td>
				<td>
					{{ $step1->c_pref2 }}
				</td>
			</tr>

			<tr>
				<td>
					Paper Code:
				</td>
				<td>
					{{ $candidate_info->paper_code }}
				</td>
				<td>
					Payment Method:
				</td>
				<td>
					{{ $order->trans_type }}
				</td>
			</tr>

			<tr>
				<td>
					Amount Paid:
				</td>
				<td>
					{{ $amount }}
				</td>
				<td>
					Reservation Code
				</td>
				<td>
					{{ $step1->reservation_code }}
				</td>
			</tr>
		</table>
	</div>
  </div>
</div>
</body>
</html>


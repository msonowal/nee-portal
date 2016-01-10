<!DOCTYPE html>
  <html>
    <head>
      <title> NEE Portal {!! $year=Date('Y') !!}</title>
   </head>

<style type="text/css">
	div.border{
		border:1px solid #000;
		height: 930px;
		width: 760px;
		margin: auto;
		margin-bottom: 30px;
	}
	div.border-1{
		border:1px solid #000;
		height: 914px;
		width: 368px;
		margin: 5px 5px 5px 5px;
	}
	div.border-2{
		border:1px solid #000;
		height: 250px;
		margin: 0px;
		margin-top: 2px;
		margin-left: 2px;
		margin-right: 2px;
		width: 357px;
		float: left;
		padding-left: 3px;
		padding-right: 3px;
	}
	div.border-3{
		margin-top: -20px;
		margin-bottom: -20px;
	}
	div.border-4{
		border:1px solid #000;
		height: 226px;
		margin: 0px;
		margin-top: 2px;
		margin-left: 2px;
		margin-right: 2px;
		width: 359px;
		float: left;
		padding-left: 3px;
		padding-right: 0px;
	}
	div.border-5{
		border:1px solid #000;
		height: 240px;
		margin: 0px;
		margin-top: 2px;
		margin-left: 2px;
		margin-right: 2px;
		width: 359px;
		float: left;
		padding-left: 3px;
		padding-right: 0px;
	}
	div.border-6{
		border:1px solid #000;
		height: 180px;
		margin: 0px;
		margin-top: 2px;
		margin-left: 2px;
		margin-right: 2px;
		width: 359px;
		float: left;
		padding-left: 3px;
		padding-right: 0px;
	}
	.image{
		width: 60px;
		height: 60px;
		margin: 0px;
		margin-left: 10px;
	}
	div.box{
		margin-top: 2px;
	}
	div.box-1{
		height:50px;
		width:200px;
		border:1px solid #000;
		float:right;
		margin-right:77px;
	}
	div.box-2{
		height:26px;
		width:180px;
		border:1px solid #000;
		font-size: 24px;
		color: red;
		text-align: center;
		margin: auto;
		margin-top: -5px;
	}
	div.box-3{
		height:40px;
		width:230px;
		border:1px solid #000;
		float:right;
		margin-top: 0px;
		padding-left: 3px;
		padding-right: 3px;
	}
	div.box-4{
		height:80px;
		width:230px;
		border:1px solid #000;
		float:right;
		margin-top: 0px;
		padding-left: 3px;
		padding-right: 3px;
	}
	div.box-5{
		height:40px;
		width:193px;
		border:1px solid #000;
		float:left;
		margin-top: 0px;
		padding-left: 3px;
		padding-right: 3px;
	}
	div.box-6{
		height:100px;
		width:140px;
		border:1px solid #000;
		float:left;
		margin-top: 0px;
		padding-left: 3px;
		padding-right: 3px;
	}
	@media print {
   	.noprint{
      display: none !important;
   }
}
</style>
<body>
<div style="float:right"><button class="noprint" onclick='window.print()'>Print</button></div>
<div align="center"><h2>Challan Copy</h2></div>
<div class="border">
	<div class="border-1" style="float:left">
		<div class="border-2">
       		<div class="border-3" align="center"><h2>NERIST</h2></div>
         		<div class="border-3" align="center"><h3>Nirjuli, Arunachal Pradesh</h3></div>
          		<div align="right">Date: {{ $date=Date('d-m-Y') }}</div>
          		<div align="left">Transaction Reference No. <font color="red"><strong> {{ $candidate_info->form_no }}</strong></font></div>
             	<div>(To be filled by Bank Officials)</div>
          	  <div class="box"><img src="{{ asset('images/challan_1stcopy.jpg') }}" class="image">
          		<div class="box-1">
 				<span style=" margin-left:35%;">Axis Bank</span><br/>
	 			<span style="margin-left:2%">Branch Name: </span>
	  		    </div>
	          </div>
	          <div class="box-2">
	          	PAY-IN-SLIP
	          </div>
	          <div align="center">
	          	(To be retained by Axis Bank Collecting Branch)<br/>
	          	Please credit: NERIST Account Axis Bank Current A/c 
	          </div>
	          <div>No. :<strong>910020031204729</strong></div>
        </div>
        <div class="border-4">
        	<table>
        		<tr>
        			<td>
        					Name of the candidate:
        			</td>
        			<td>		
			         	<div class="box-3"> 
			        		{{ $step2->name }}
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        					Category
        			</td>
        			<td>		
			         	<div class="box-3"> 
			        		{{ $step1->reservation_code }}
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        					Address
        			</td>
        			<td>		
			         	<div class="box-4"> 
			        	   {{ $step2-> village }}, {{ $step2->po }}, {{ $step2->pin }}, {{ $step2->district}}, {{ $step2->state }}
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        					Phone Number
        			</td>
        			<td>		
			         	<div class="box-3"> 
			        	   {{ $candidate->mobile_no }}
			         	</div>
        			</td>
        		</tr>
        	</table>
        </div>
        <div class="border-5">
        	<table>
        		<tr>
        			<td>
        					Amount Paid(Rupees):
        			</td>
        			<td>		
			         	<div class="box-5"> 
			        		{{ $amount }}/-
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        				<div class="box-6">
        					<br/><br/><br/><br/>Notes Denomination 	
        				</div>
        			</td>
        			<td>		
			         	<p>_________________________</p>
			         	<p>_________________________</p>
			         	<p>_________________________</p>
			         	<p></p>
			         	<p align="center">Depositor's Signature</p>
        			</td>
        		</tr>
        	</table>
        </div>
        <div class="border-6">
        	<p>Received the above amount on _______________{{ $year=Date('Y') }}</p>
        	<p></p>
        	<p>Cashier______________________________________</p>
        	<p>Cashier's Scroll No.____________________________</p>
        	<p></p>
        	<p>Note:To be accepted at designated Axis Bank Branches 
        	and funds to be credited to NERIST Account Axis Bank Current A/c No.
            910020031204729</p>
        </div>
    </div>
    <div class="border-1"  style="float:left">
		<div class="border-2">
       		<div class="border-3" align="center"><h2>NERIST</h2></div>
         		<div class="border-3" align="center"><h3>Nirjuli, Arunachal Pradesh</h3></div>
          		<div align="right">Date: {{ $date=Date('d-m-Y') }}</div>
          		<div align="left">Transaction Reference No. <font color="red"><strong> {{ $candidate_info->form_no }}</strong></font></div>
             	<div>(To be filled by Bank Officials)</div>
          	  <div class="box"><img src="{{ asset('images/challan_2ndcopy.jpg') }}" class="image">
          		<div class="box-1">
 				<span style=" margin-left:35%;">Axis Bank</span><br/>
	 			<span style="margin-left:2%">Branch Name: </span>
	  		    </div>
	          </div>
	          <div class="box-2">
	          	PAY-IN-SLIP
	          </div>
	          <div align="center">
	          	(To be retained by the Candidate)<br/>
	          	Please credit: NERIST Account Axis Bank Current A/c 
	          </div>
	          <div>No. :<strong>910020031204729</strong></div>
        </div>
        <div class="border-4">
        	<table>
        		<tr>
        			<td>
        					Name of the candidate:
        			</td>
        			<td>		
			         	<div class="box-3"> 
			        		{{ $step2->name }}
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        					Category
        			</td>
        			<td>		
			         	<div class="box-3"> 
			        		{{ $step1->reservation_code }}
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        					Address
        			</td>
        			<td>		
			         	<div class="box-4"> 
			        	   {{ $step2-> village }}, {{ $step2->po }}, {{ $step2->pin }}, {{ $step2->district}}, {{ $step2->state }}
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        					Phone Number
        			</td>
        			<td>		
			         	<div class="box-3"> 
			        	   {{ $candidate->mobile_no }}
			         	</div>
        			</td>
        		</tr>
        	</table>
        </div>
        <div class="border-5">
        	<table>
        		<tr>
        			<td>
        					Amount Paid(Rupees):
        			</td>
        			<td>		
			         	<div class="box-5"> 
			        		{{ $amount }}/-
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        				<div class="box-6">
        					<br/><br/><br/><br/>Notes Denomination	
        				</div>
        			</td>
        			<td>		
			         	<p>_________________________</p>
			         	<p>_________________________</p>
			         	<p>_________________________</p>
			         	<p></p>
			         	<p align="center">Depositor's Signature</p>
        			</td>
        		</tr>
        	</table>
        </div>
        <div class="border-6">
        	<p>Received the above amount on _______________{{ $year=Date('Y') }}</p>
        	<p></p>
        	<p>Cashier______________________________________</p>
        	<p>Cashier's Scroll No.____________________________</p>
        	<p></p>
        	<p>Note:To be accepted at designated Axis Bank Branches 
        	and funds to be credited to NERIST Account Axis Bank Current A/c No.
            910020031204729</p>
        </div>
    </div>
	
</div>
	
</body>
</html>


<!DOCTYPE html>
  <html>
    <head>
      <title> NEE Portal {!! $year=Date('Y') !!}</title>
   </head>

<style type="text/css">
	div.border-1{
		border:1px solid #000;
		height: 800px;
		width: 726px;
		margin: auto; 
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
		height: 250px;
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
</style>
<body>
	<div class="border-1">
		<div class="border-2">
       		<div class="border-3" align="center"><h2>NERIST</h2></div>
         		<div class="border-3" align="center"><h3>Nirjuli, Arunachal Pradesh</h3></div>
          		<div align="right">Date: {{ $date=Date('d-m-Y') }}</div>
          		<div align="left">Transaction Reference No.NEE-006058</div>
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
			        		dskjdssjk dskjdssjk dskjdssjkdskjdssjkdskjdssjk
			         	</div>
        			</td>
        		</tr>
        		<tr>
        			<td>
        					Category
        			</td>
        			<td>		
			         	<div class="box-3"> 
			        		General
			         	</div>
        			</td>
        		</tr>
        	</table>
        </div>
    </div>
</body>
</html>


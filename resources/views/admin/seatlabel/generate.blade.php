<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sheet Label NEE {{date('Y')}}</title>
</head>
<style type="text/css">
  @media print {
  .no-print{
    display: none;
  }
}

.btn-print { 
  color: #FAFAFA; 
  background-color: #2D99F7; 
  border-color: #000000;
  width:150px;
  height:40px;
  font-size:30px;
  padding:2px;
  position:fixed;
  cursor:pointer;
  right:2%;
  top:40%;
} 
 
.btn-print:hover, 
.btn-print:focus, 
.btn-print:active, 
.btn-print.active, 
.open .dropdown-toggle.btn-print { 
  color: #FAFAFA; 
  background-color: #0D1E8C; 
  border-color: #000000; 
} 
 
.btn-print:active, 
.btn-print.active, 
.open .dropdown-toggle.btn-print { 
  background-image: none; 
} 
 
.btn-print.disabled, 
.btn-print[disabled], 
fieldset[disabled] .btn-print, 
.btn-print.disabled:hover, 
.btn-print[disabled]:hover, 
fieldset[disabled] .btn-print:hover, 
.btn-print.disabled:focus, 
.btn-print[disabled]:focus, 
fieldset[disabled] .btn-print:focus, 
.btn-print.disabled:active, 
.btn-print[disabled]:active, 
fieldset[disabled] .btn-print:active, 
.btn-print.disabled.active, 
.btn-print[disabled].active, 
fieldset[disabled] .btn-print.active { 
  background-color: #2D99F7; 
  border-color: #000000; 
} 
 
.btn-print .badge { 
  color: #2D99F7; 
  background-color: #FAFAFA; 
}
</style>
<body>
<button class="no-print btn-print" onclick="window.print();" title="Please wait untill the page has completely loaded. Then only Click Print">
 Print </button>
<table width="919" border="0" align="center" style="margin-top:0px;">
  <tr>
    <td width="913" colspan="2">
	@foreach($results as $res)
      <textarea readonly="true" name="seat_label" cols="11" rows="2" style="font-family: Arial; font-size: 18pt; text-align: right; border-style: solid; border-color:#000000; padding-left:0px; padding-right:40px; padding-top:15px; margin-left:25px; margin-top:30px; padding-bottom:0px;">
      {{ $exam->exam_name }} {{ $res->rollno }}</textarea>
  @endforeach
  </td>
  </tr>
</table>
<div align="center">
  <center>
  </center>
</div>
</body>
</html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Address List {{ date('Y') }}</title>
<style>
@media all {
 .page-break  { display: none; }
}

@media print {
  .no-print{
    display: none;
  }
}

table tr.page-break{display: block; page-break-before: always;}

@page {
  size: A4;
}
h1 {
  page-break-before: always;
}
h1, h2, h3, h4, h5 {
  page-break-after: avoid;
}
table, figure {
  page-break-inside: avoid;
}
table { 
border-spacing: 0px;
border-collapse: collapse;
}
body {
        height: 990px;
        width: 670px;
        /*width: 595px;*/
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }

td.container > div { width: 100%; height: 100%; overflow:hidden; }
td.container { height: 20px; border-bottom: dashed; }

td {
  text-align:left;
  padding-top:10px;
}

.btn-aug { 
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
 
.btn-aug:hover, 
.btn-aug:focus, 
.btn-aug:active, 
.btn-aug.active, 
.open .dropdown-toggle.btn-aug { 
  color: #FAFAFA; 
  background-color: #0D1E8C; 
  border-color: #000000; 
} 
 
.btn-aug:active, 
.btn-aug.active, 
.open .dropdown-toggle.btn-aug { 
  background-image: none; 
} 
 
.btn-aug.disabled, 
.btn-aug[disabled], 
fieldset[disabled] .btn-aug, 
.btn-aug.disabled:hover, 
.btn-aug[disabled]:hover, 
fieldset[disabled] .btn-aug:hover, 
.btn-aug.disabled:focus, 
.btn-aug[disabled]:focus, 
fieldset[disabled] .btn-aug:focus, 
.btn-aug.disabled:active, 
.btn-aug[disabled]:active, 
fieldset[disabled] .btn-aug:active, 
.btn-aug.disabled.active, 
.btn-aug[disabled].active, 
fieldset[disabled] .btn-aug.active { 
  background-color: #2D99F7; 
  border-color: #000000; 
} 
 
.btn-aug .badge { 
  color: #2D99F7; 
  background-color: #FAFAFA; 
}
  
</style>
</head>
<?php $page_no=1; ?>
<body>
<button class="no-print btn-aug" onclick="window.print();" title="Please wait untill the page has completely loaded. Then only Click Print">
 Print </button>
<div style="border:0px solid #C12225; width:670px; height:93px; margin-top:20px;">

  <div style="width:120px; border:0px solid #26E948; height:20px; float:left; overflow:hidden;">
    <p style="margin:0px; margin-left:2px;">
         <b></b>
      </p>
  </div>

  <div style="width:449px; border:0px solid #26E948; float:right; height:20px; overflow:hidden;text-align: right;">
    <p style="font-weight:bold; margin:0px; border:0px solid red; font-size:16px;">
      NEE {{ date('Y') }} Address Label
      </p>
  </div>

  <div style="float:left; width:500px; height:10px;">
  <p style="margin:0px; margin-left:2px;"><br/>
         <b></b>
      </p>
  </div>
  <div style="width:300px; border:0px solid #26E948; float:right; height:20px; overflow:hidden; text-align: right;">
      <p style="margin:0px; margin-right:2px;">
      Page No: <b> {{ $page_no }}</b>
      </p>
  </div>
  <div style=" width:80%; overflow:hidden; height:20px; float:left; font-weight:bold; margin-top:5px;">
  <p style="margin:0px; margin-left:2px; padding-top:3px;">  &nbsp; <b></b></p>
  </div>

  <div style="width:20%; overflow:hidden; height:20px; float:right; text-align:right; font-weight:bold; margin-top:5px;">
  <p style="margin:0px; margin-right:2px;"> Exam:&nbsp;<b>{{ $exam->exam_name}} </b></p>
  </div>

</div>
<table width="100%" border="0">
  <tbody>
    <tr>
    </tr>
    <?php $sl_no =1; $pbreak = 1; $page_no = 2;?>
  @foreach($results as $result)
    
    @if($pbreak>4)
    </tbody>
  </table>

<div style="margin-top:50px;">
  <div style="float:left; width:225px;">
    <p style="margin:0px;"> </p>
  </div>

  <div style="float:left; text-align:center;">
    <p style="margin:0px;"> </p>
  </div>

  <div style="float:right; width:180px;">
    <p style="margin:0px;"> </p>
  </div>

</div>
<div style="border:0px solid #C12225; margin-top:10px; width:670px; height:93px; page-break-before:always;">
  <div style="width:300px; border:0px solid #26E948; height:40px; float:left; overflow:hidden;">
    <p style="margin:0px; margin-left:2px;">
        <br/> <b></b>
    </p>
  </div>

  <div style="width:300px; border:0px solid #26E948; float:right; height:40px; overflow:hidden;text-align: right;">
    <p style="font-weight:bold; margin:0px; border:0px solid red; font-size:16px;">
      <br/>NEE {{ date('Y')}} Address Label
      </p>
  </div>

  <div style="float:left; width:400px; height:20px;">
  <p style="margin:0px; margin-left:2px;">
         <b></b>
      </p>
  </div>

  <div style="width:200px; border:0px solid #26E948; float:right; height:20px; overflow:hidden; text-align: right;">
      <p style="margin:0px; margin-right:2px;">
      Page No: <b>{{$page_no}}</b>
      </p>
  </div>

  <div style=" width:80%; overflow:hidden; height:20px; float:left; font-weight:bold; margin-top:5px;">
  <p style="margin:0px; margin-left:2px;"> &nbsp; <b></b></p>
  </div>

  <div style="width:20%; overflow:hidden; height:20px; float:right; text-align:right; font-weight:bold; margin-top:5px;">
  <p style="margin:0px; margin-right:2px;"> Exam:&nbsp;<b>{{ $exam->exam_name }}</b></p>
  </div>
</div>
<table width="100%" border="0">
  <tbody>
    <?php $pbreak= 1; $page_no++; ?>
    @endif
    <tr>
      <td class="container">Name: {{ $result->name }}, Roll Number: {{$result->rollno}}<br><br> C/o {{ $result->guardian_name }} <br><br> Village/Town : {{ $result->village}}, Post Office :{{ $result->po }} <br><br> District: {{ Basehelper::getDistrict($result->district) }}, State: {{ Basehelper::getState($result->state) }} <br><br> Pin Code : {{$result->pin}} (Mobile No : {{$result->mobile_no}})<br><br></td>
    </tr>
    <?php $sl_no++; $pbreak++; ?>
  @endforeach
  </tbody>
</table>

@if($sl_no <5)

<div style="margin-top:50px;">
  <div style="float:left; width:225px;">
    <p style="margin:0px;"> </p>
  </div>

  <div style="float:left; text-align:center;">
    <p style="margin:0px;"></p>
  </div>

  <div style="float:right; width:180px;">
    <p style="margin:0px;"></p>
  </div>

</div>

@else

<div style="margin-top:30px;">
  <div style="float:left; width:225px;">
    <p style="margin:0px;"> </p>
  </div>

  <div style="float:left; text-align:center;">
    <p style="margin:0px;"> </p>
  </div>

  <div style="float:right; width:180px;">
    <p style="margin:0px;"> </p>
  </div>

</div>
@endif

  <div style="width:100%; margin-top:10px; float:left;">
    <div style="width:40%; height:50px; text-align:center; border:0px solid red; float:left;">
      <div style="float:left; margin-left:1px; margin-right:5px;">
        <p></p>
      </div>

      <div style="float:right; height:50px;width:50px; border:0px solid black;">
      </div>

    </div>
    <div style="width:50%; height:50px; text-align:center; float:right; text-align:center; border:0px solid red;">
      
      <div style="float:right; height:50px;width:50px; border:0px solid black;">
      </div>

      <div style="float:right; margin-right:5px;">
        <p></p>
      </div>     

    </div>

  </div>
	  <div style="margin-top:100px;">
		  <div style="float:left; width:225px;">
		    <p style="margin:0px;"></p>
		  </div>
		
		  <div style="float:right; text-align:center;">
		    <p style="margin:0px;"></p>
		  </div>
	</div>

</body>
</html>
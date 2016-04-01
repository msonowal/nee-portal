<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href='https://fonts.googleapis.com/css?family=Roboto+Mono' rel='stylesheet' type='text/css'>
<title>Sheet Label NEE {{date('Y')}}</title>
</head>
<body>
<table width="919" border="0" align="center">
  <tr>
    <td width="913" colspan="2" valign="top">
	@foreach($results as $res)
      <strong>
      <textarea name="seat_label" cols="11" rows="2" style="font-family: Roboto Mono; font-size: 17pt; font-weight: bold; text-align: center; border-style: solid; border-color:#000000 border-width: 2; padding-left:0px; padding-right:40px; padding-top:15px; margin:5px; padding-bottom:0px; background:url({{ asset('images/seat_label.jpg') }})">
      {{ $res->rollno }}</textarea>
      </strong>
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
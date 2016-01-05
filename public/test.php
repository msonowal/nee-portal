<?php
$mail=mail('manash149@gmail.com', "Subject: Test", 'testing');
if($mail){
  echo "Thank you for using our mail form";
}else{
  echo "Mail sending failed."; 
}

?>
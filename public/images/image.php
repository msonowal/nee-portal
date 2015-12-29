<?php

$photo_url = $_GET["photo_url"];

$storage_path = __DIR__.'/../../storage/' . $photo_url; 

 // Prepare content headers
$finfo = finfo_open(FILEINFO_MIME_TYPE); 
$mime = finfo_file($finfo, $storage_path);
$length = filesize($storage_path);

header ("content-type: $mime"); 
header ("content-length: $length"); 

// @TODO: Cache images generated from this php file

readfile($storage_path); 
exit;
?> 
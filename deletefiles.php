<?php
$dir = 'data/';
foreach(glob($dir.'*.*') as $v){
    unlink($v);
}
print "<script>";
print " self.location='http://localhost/amplot';"; 
print "</script>";
?>

<?php

#echo print_r($_POST);

$img = $_POST['src'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = 'image.jpg';
$success = file_put_contents($file, $data);
 ?>

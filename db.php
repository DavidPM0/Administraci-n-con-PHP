<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'mvc'
) or die(mysqli_erro($mysqli));

?>
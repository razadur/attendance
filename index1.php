<?php
$conn = mysqli_connect("192.168.50.112","test","test","biostar");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error(); exit;
}
?>

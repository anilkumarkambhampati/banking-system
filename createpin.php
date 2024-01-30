<?php

$con=new mysqli("localhost","root","","bank");

$pin=$_POST['pin'];
$cpin=$_POST['cpin'];
session_start();
$user=$_SESSION['user'];
if($pin!=$cpin)
{
    echo "<script>alert('pins should match')</scrip>";
}
else
{
    $sq="update customers set pin=$pin where username='$user'";
    $con->query($sq);
    header("Location: balance.html");
}

$con->close();

?>
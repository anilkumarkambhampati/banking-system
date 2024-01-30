<?php
$con=new mysqli("localhost","root","","bank");
//retreive username 
session_start();
$user=$_SESSION["user"];
//retreive the pin to verify whether pin is created or not
$sq="select pin from customers where username='$user'";
$res=$con->query($sq);
$a=0;
while($r=$res->fetch_assoc())
{
    $a=$r['pin'];
}
//verify whether pin is created or not
if($a==0)
{
    //if pin is not created then redirect to createpin page
    header("Location: createpin.html");
}
else
{
    //if pin is already created then redirect to balance page to show the balance amount
    header("Location: balance.html");
}
$con->close();
?>

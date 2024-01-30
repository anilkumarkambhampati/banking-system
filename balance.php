<?php
$con=new mysqli("localhost","root","","bank");
//username retreived
session_start();
$user=$_SESSION['user'];
//retrteive the pin from page
$pin=$_POST['pin'];
//query to retreive pin from database
$sq="select pin from customers where username='$user'";
$res=$con->query($sq);
$a=0;
while($row=$res->fetch_assoc())
{
    $a=$row['pin'];
}
//check the pin retreived from page with actual pin
if($pin==$a)
{
    $sq="select acnumber,balance from customers where username='$user'";
$res=$con->query($sq);
$acno="";
$cb=0;
while($row=$res->fetch_assoc())
{
    $acno=$row['acnumber'];
    $cb=$row['balance'];
}
//printing the details
    echo "<html>
<head>
    <link rel='stylesheet' href='styling1.css'>
</head>
<body>
    <center>
        <font color='aliceblue' size='5px'>
            <h1><u>Balance</u></h1>
        </font>
        <div class='container10'>
            <table>
                <tr>
                    <br>
                    <td><b>A/C Number:</b></td>
                    <td>$acno</td>
                    <td><b>IFSC:</b></td>
                    <td>sreyas123</td>
                    <td><b>Current balance:</b></td>
                    <td>$cb</td>
                </tr>
            </table>
        </div>
    </center>
    <br><br><br>
    <a href='home1.html'> <button>Go Back</button> </a>

</body>
</html>";
}
else
{
    echo "<script>alert('incorrect pin')</script>";
}
$con->close();

?>
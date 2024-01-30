<?php
$con=new mysqli("localhost","root","","bank");
//retreive the username
session_start();
$user=$_SESSION['user'];
//retreive the data from database
$sq="select * from customers where username='$user'";
$res=$con->query($sq);
$name="";
$Fname="";
$gen='';
$dob='';
$aadhar='';
$pan='';
$mob1='';
$mob2='';
$mail='';
$actype='';
$acno=0;
while($a=$res->fetch_assoc())
{
    $name=$a['name'];
    $Fname=$a['Fname'];
    $gen=$a['gender'];
    $dob=$a['dob'];
    $aadhar=$a['aadhar'];
    $pan=$a['pan'];
    $mob1=$a['mobile'];
    $mob2=$a['alternate'];
    $mail=$a['email'];
    $actype=$a['actype'];
    $acno=$a['acnumber'];
}
//display the details
echo "
<html>

<head>
    <link rel='stylesheet' href='styling1.css'>
    <style>
    th{
        text-align: left;
    </style>
</head>

<body>
    <center>
        <font color='aliceblue' size='5px'>
            <h1><u>
                    Details
                </u></h1>
        </font>
        <div class='container11'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <table>
                <tr>
                    <th>Full Name:</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th>Father/Guardian Name:</th>
                    <td>$Fname</td>
                </tr>
                <tr>
                    <th>Gender:</th>
                    <td>$gen</td>
                </tr>
                <tr>
                    <th>DOB:</th>
                    <td>
                        $dob
                    </td>
                </tr>
                <tr>
                    <th>Aadhar Number:</th>
                    <td>$aadhar</td>
                </tr>
                <tr>
                    <th>PAN Number:</th>
                    <td>
                        $pan
                    </td>
                </tr>
                <tr>
                    <th>Mobile:</th>
                    <td>
                        $mob1
                    </td>
                </tr>
                <tr>
                    <th>Alternate Number:</th>
                    <td>
                        $mob2
                    </td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>
                        $mail
                    </td>
                </tr>

            </table>
        </div>
    </center>
    <a href='home1.html'> <button>Go Back</button> </a>
</body>
</html>";

$con->close();
?>
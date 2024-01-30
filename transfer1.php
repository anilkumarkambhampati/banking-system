<?php
$con=new mysqli("localhost","root","","bank");
//get the data from the page
$acnumber = $_POST["acnumber"];
$cacnumber = $_POST["c_acnumber"];
$ifsc = $_POST["ifsc"];
$achname = $_POST["acholdername"];
$amount = $_POST["amount"];
//retreive the username
session_start();
$user = $_SESSION['user'];

//check the given account numbers are same or not
if ($acnumber != $cacnumber)
{
    //if the account number are not same give an alert message that the account numbers should match
    echo "<script>alert('Account numbers should match')</script>";
}
else
{
    //if account numbers are matched then check the ifsc is correct or not
    if($ifsc=='sreyas123')
    {
        //if ifsc is correct then 
        //get all acount number in the database
        $sq = "SELECT acnumber FROM customers";
        $res = $con->query($sq);
        $flag = 0;
        while ($row = $res->fetch_assoc())
        {
            if ($row['acnumber'] == $acnumber)
            {
                $flag = 1;
            }
        }
        //check the account number is there in the database
        if ($flag == 1)
        {
            //if account number is registered then get the balance
            $sq = "SELECT balance FROM customers WHERE acnumber = $acnumber";
            $res = $con->query($sq);
            $bal1 = 0;
            $bal2 = 0;
            while ($row = $res->fetch_assoc())
            {
                $bal1 = $row['balance'];
            }

            $res = $con->query("SELECT balance FROM customers WHERE username='$user'");
            while ($row = $res->fetch_assoc()) 
            {
                $bal2 = $row['balance'];
            }
            //check the balance is sufficient to transfer
            if ($bal2 < $amount)
            {
                //if the given amount is greater than the balance then give alert message 'insufficient balance'
                echo "<script>alert('Insufficient balance')</script>";
            }
            else
            {
                //update the balance on sender and receiver in databse
                $bal2 -= $amount;
                $bal1 += $amount;
                $updateUserBalance = "UPDATE customers SET balance=$bal2 WHERE username='$user'";
                $updateRecipientBalance = "UPDATE customers SET balance=$bal1 WHERE acnumber=$acnumber";
                $con->query($updateUserBalance);
                $con->query($updateRecipientBalance);
                //redirect to transfer status page
                header("Location: transferstatus.html");
            }
        }
        else
        {
            //if entered account is not registered then give alert message 'given account number is not registered
            echo "<script>alert('Account number you entered is not registered')</script>";
        }
    }
    else
    {
        //if given ifsc is wrong then give alert message 'incorrect ifsc'
        echo "<script>alert('ifsc is wrong')</script>";
    }
    
}
$con->close();
?>

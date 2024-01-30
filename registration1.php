<?php
	$con=new mysqli("localhost","root","","bank");

	if($con->connect_error)
	{
		echo "connection error";
	}
	else
	{
		//retreive the data from registration page
		$name=$_POST["name"];
		$fname=$_POST["FG_name"];
		$gender=$_POST["gender"];
		$dob=$_POST["dob"];
		$aadhar=$_POST["aadhar"];
		$pan=$_POST["pan"];
		$mobile=$_POST["mobile"];
		$alternate=$_POST["alternate"];
		$email=$_POST["mail"];
		$branch=$_POST["branch"];
		$actype=$_POST["actype"];
		$username=$_POST["username"];
		$password1=$_POST["password1"];
		$password2=$_POST["password2"];
		//check the conformation of password
        if($password1!=$password2)
        {
			//if passwords are not matched give alert message
            echo '<script>alert("passwords should match")</script>';
        }
        else
		{
			//check the aadhar and username entered in page are unique or not
			$sq="select aadhar,username from customers";
			$res=$con->query($sq);
			$adflag=0;
			$usflag=0;
			while($row=$res->fetch_assoc())
			{
				if($row["aadhar"]==$aadhar)
				{
					$adflag=1;
				}

				if($row["username"]==$username)
				{
					$usflag=1;
				}
			}
			//check the aadhar is already regidtered or not
			if($adflag==0)
			{
				//if aadhar is not registered check username 
				if($usflag==0)
				{
					//if username also not matched with the other username then insert the data into database
					$sql="insert into customers (name,Fname,gender,dob,aadhar,pan,mobile,alternate,email,branch,actype,username,password) values('$name','$fname','$gender','$dob','$aadhar','$pan','$mobile','$alternate','$email','$branch','$actype','$username','$password1')";
					if($con->query($sql))
					{
						header("Location: login.html");
					}
					else
					{
						echo "something wrong";
					}
				}
				else
				{
					//if the username is already in the database then give alert message to enter unique username
					echo "<script>alert('username is already exist use another username')</script>";
				}
			}
			else
			{
				//if aadhar is already registered then give alert message that aadhar is already registered
				echo "<script>alert('Aadhar is already registered')</script>";
			}
        }
	}
	$con->close();
?>
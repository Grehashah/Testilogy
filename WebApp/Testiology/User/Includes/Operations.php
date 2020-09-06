<?php

	include_once("Connect.php");

	class Operations
	{
		private $con;

		function __construct()
		{
			$db = new connection();

			$this->con = $db->connect();
		}

		function RegisterUser($uname,$pass,$contactno,$email,$qual)
		{
			date_default_timezone_set('Asia/Kolkata');
			$lastseen=date("Y-m-d h-i-s");
			$doj=date("Y-m-d");
			$isauth = "yes";
			
			$str = "insert into users values('','$uname','$pass','$contactno','$email','$doj','$lastseen','$isauth','$qual')";

			$result = $this->con->query($str);
			return $result;
		}

		function UserExamReg($uname,$eid)
		{	
			$str = "select * from users where uname ='$uname'";

			$result = $this->con->query($str);
			$row = $result->fetch_assoc();
			$uid = $row['userid']; 

			$str = "Insert into userexam values('','$eid','$uid')";
			$result1 = $this->con->query($str);
			return $result1;
		}

		function UserLogin($uname,$pass)
		{
			$str = "select * from users where uname = '$uname' and passwd = '$pass'";
			$result = $this->con->query($str);

			$count = mysqli_num_rows($result);
			$row = $result->fetch_assoc();

			if($count!=0)
			{
				$isauth = $row['isauth'];
				if($isauth=='yes')
				{
					return true;		
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}

		function CheckUser($uname)
		{
			$str = "select * from users where uname = '$uname'";
			$result = $this->con->query($str);
			$count = mysqli_num_rows($result);
		
			if($count!=0)
			{
				return true;
			}	
			else
			{
				return false;
			}
		}

		function LoginRecord($uname,$pass)
		{
			$str = "select * from users where uname = '$uname' and passwd = '$pass'";
			$result = $this->con->query($str);
			return $result;
		}


		function update($uname,$email,$pass,$cno,$qual)
		{
			$str = "update users set email = '$email' , passwd='$pass' , contactno='$cno' , qualification = '$qual' where uname='$uname'";
			$result = $this->con->query($str);
			return $result;
		}

		function readystate($token)
		{
			$str = "update devices set ready = '1' where token='$token'";
			$result = $this->con->query($str);
			return $result;
		}

		function logout($uname)
		{
			date_default_timezone_set('Asia/Kolkata');
			$lastseen=date("Y-m-d h-i-s");
			$str = "update users set lseen = '$lastseen' where uname='$uname'";
			$result = $this->con->query($str);
			return $result;
		}	

		function feedback($email,$choice,$cmt)
		{
			$str = "insert into feedback values('','$email','$choice','$cmt')";

			$result = $this->con->query($str);
			return $result;
		}	

		function getemail($uname)
		{
			$str = "select * from users where uname='$uname'";

			$result = $this->con->query($str);
			return $result;
		}	

		function RegToken($token)
		{
			$str = "insert into devices values('','$token','','0')";
			$result = $this->con->query($str);
			return $result;
		}

		function GetAns($ans,$qid,$uid)
		{
			
			$str = "insert into usersanswer values('','$uid','$qid','$ans')";
			$result = $this->con->query($str);
			return $result;
		}

		function UserTokenReg($uname,$token)
		{
			$str = "select * from users where uname = '$uname'";
			$result = $this->con->query($str);
			$row = $result->fetch_assoc();
			$uid = $row['userid'];

			$str1 = "update devices set userid = '$uid' where token ='$token'";
			$result1 = $this->con->query($str1);
			return $result1;
		}

	}
?>
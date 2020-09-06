<?php

	class connection
	{
		private $con;

		function __construct()
		{

		}

		function connect()
		{
			$con = mysqli_connect("localhost","root","","testiology");

			if(mysqli_connect_error($con))
			{
				echo "Error Occured in DataBase connection!!!";
			}

			return $con;

		}

	}


?>
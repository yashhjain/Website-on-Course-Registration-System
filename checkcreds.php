<?php 
	$dbb= mysqli_connect('localhost','root','root','coursemanagement');
	$count = 0;
	if(isset($_POST['email']))
	{
			$retrieved_from_ajax_email = $_POST['email'];
			//echo($retrieved_from_ajax_email);
			$Query_to_find_email ="SELECT emailid from authentication WHERE emailid = '$retrieved_from_ajax_email'";
			$processed_results = mysqli_query($dbb,$Query_to_find_email);
			//echo("It is "+$processed_results+" years");
			if($processed_results)
			{
				$rows_retrieved = mysqli_num_rows($processed_results);
				//echo("Number of retrieved is ". $rows_retrieved. " yeah");
				if($rows_retrieved > 0)
				{
					
					//It already exists. VIOLATION.
					$count = $count+1;
				}
				else
				{
					//echo("No records with that email id");
				}
			}
			else{
				//echo("No results");
			}
			echo($count);
	}
    
  if(isset($_POST['username']))
	{
		$retrieved_from_ajax_username = $_POST['username'];
		//echo "Came to Delete Address";
		//echo($retrieved_from_ajax_username);
		$Query_to_delete_entry="SELECT username from authentication WHERE username = '$retrieved_from_ajax_username'";
		$processed_username = mysqli_query($dbb,$Query_to_delete_entry);
		if($processed_username)
		{
			$names_retrieved = mysqli_num_rows($processed_username);
			if($names_retrieved > 0)
			{
				//It already exists. VIOLATION.
				$count = $count+1;
			}
		}
		echo ($count);
	}
?>
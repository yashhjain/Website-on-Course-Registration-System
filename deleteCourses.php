<?php
    require_once('connection.php');
    session_start();
    
    if(isset($_POST['login']))
    {
        $code=$_POST['code'];
        $name=$_POST['name'];
        $term=$_POST['term'];
        $section=$_POST['section'];
        $description=$_POST['description'];

        $sql = "delete from course where code='$code' and name='$name' and term='$term' and section='$section' and description='$description'";
	    $execute_this_query = mysqli_query($dbb, $query);
        $rows = mysqli_num_rows($execute_this_query);
        
        if($rows = 1){
            echo("Successful Deletion");
            header('Location: delete.php');
        }
	    
    }


?>
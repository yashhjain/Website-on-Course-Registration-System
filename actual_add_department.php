<?php
    require_once('connection.php');
    if(isset($_POST['department_name']))
    {
        $deptname = $_POST['department_name'];
        $deptname = strtolower($deptname);
        $retrieve_existing = "SELECT dept_name FROM department where dept_name = '$deptname'";
        $ex_this = mysqli_query($dbb, $retrieve_existing);
        if(mysqli_num_rows($ex_this) > 0)
        {
            //Already existing.
            echo("The department is already existing.");
        }
        else
        {
            $sql = "INSERT INTO department (dept_name) VALUES ('$deptname')";
            $execute_this_query = mysqli_query($dbb, $sql);
            if($execute_this_query)
            {
                echo("Successful Addition");
            }
            else
            {
                echo("Query could not be executed at all!");
            }
        }
    }
?>
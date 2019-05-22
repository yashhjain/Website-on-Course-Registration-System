<?php

    require_once('connection.php');
    $departments_get = "SELECT * FROM department";
    $exec = mysqli_query($dbb, $departments_get);
    if($exec)
    {
        $rows_dept = mysqli_num_rows($exec);
        $dept_array = array();
        for($i = 0; $i < $rows_dept; $i++)
        {
            $departmentdetails = mysqli_fetch_array($exec);
            $d_id = $departmentdetails['deptid'];
            $d_name = $departmentdetails['dept_name'];
            $collect = $d_id.":".$d_name;
            array_push($dept_array,$collect);
        }
        echo implode('~',$dept_array);
    }
?>
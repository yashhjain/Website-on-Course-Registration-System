<?php 
    require_once('connection.php');
    $query_for_all_records = "SELECT courseid,course_code, course_name, dept_name, about, seats, time, termname, course_term.term_id, dept_id
                             from course  join course_term  
                             on courseid = course_id join department 
                             on dept_id = deptid join term on term_id = termid";
    $execute_forall_records = mysqli_query($dbb, $query_for_all_records);
    if($execute_forall_records && mysqli_num_rows($execute_forall_records) > 0)
    {
        $data = array();
        $all_record_rows = mysqli_num_rows($execute_forall_records);
        for($z = 0; $z < $all_record_rows; $z++)
        {
            $records = mysqli_fetch_assoc($execute_forall_records);
            $data[] = $records;
        }
        $response = array(
            "data" => $data
        );
        echo json_encode($response);
    }
    else
    {
        echo("The query did not return any results");
    }
?>
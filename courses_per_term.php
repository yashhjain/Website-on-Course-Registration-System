<?php

    require_once('connection.php');
    $term_to_check = $_POST['term'];
    $terms_get = "SELECT course_id FROM course_term where term_id = '$term_to_check'";
    $exec = mysqli_query($dbb, $terms_get);
    if($exec && mysqli_num_rows($exec) > 0)
    {
        $rows_terms = mysqli_num_rows($exec);
        $courseid_array = array();
        for($i = 0; $i < $rows_terms; $i++)
        {
            $termdetails = mysqli_fetch_array($exec);
            $c_id = $termdetails['course_id'];
            array_push($courseid_array,$c_id);
        }
        //Retrieve all the courses for the course_ids.
        $result_array_with_courses = array();
        for($y = 0; $y < count($courseid_array); $y++)
        {
            $get_courses_for_given_term = "SELECT courseid, course_code, course_name,dept_name,about,available_seats,time 
                FROM course join department on dept_id = deptid join enrollment on courseid = course_id where courseid = '$courseid_array[$y]' and term_id='$term_to_check'";
            $process_query = mysqli_query($dbb,$get_courses_for_given_term);
            if($process_query && mysqli_num_rows($process_query) == 1)
            {
                $fetch_rows = mysqli_fetch_array($process_query);
                $course_id = $fetch_rows['courseid'];
                $course_code = $fetch_rows['course_code'];
                $course_ka_naam = $fetch_rows['course_name'];
                $dept_name = $fetch_rows['dept_name'];
                $about = $fetch_rows['about'];
                $avail_seats = $fetch_rows['available_seats'];
                $timings = $fetch_rows['time'];
                $combined_course_record = $course_id . ";" . $course_code . ";" . $course_ka_naam. ";" . $dept_name. ";" . $about. ";" . $avail_seats. ";" . $timings;
                array_push($result_array_with_courses, $combined_course_record);
            }
        }
        echo (implode("~",$result_array_with_courses));
        //That's it. We are done.
    }
?>
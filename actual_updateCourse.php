<?php
    require_once('connection.php');
    //session_start();
    
    $course_id= $_POST['course_id'];
    $code= $_POST['code'];
    $name =  strtolower($_POST['name']);
    $term = $_POST['term'];
    $department = $_POST['department'];
    $timing = $_POST['timings'];
    $seats = $_POST['seats'];
    $previousTerm = $_POST['previous_term'];
    $about =  strtolower($_POST['about']);
    echo($previousTerm);
    echo($term);
    echo("The course id is ".$course_id);
    //$check_for_course = "Select * from course where course_id='$course_id'";
    //$get_course = mysqli_query($dbb,$check_for_course);
    if (empty($code) && empty($name) && empty($term) && empty($department) && empty($timing) && empty($seats) && empty($about)){
        
        echo("Empty Fields");
    }
    else
    {
        echo("Course Id is ".$course_id);
        $update_course = "update course set course_code = '$code', course_name = '$name', dept_id = '$department', 
            about = '$about', seats = '$seats', time = '$timing' where courseid = '$course_id'";
        $course_update = mysqli_query($dbb, $update_course);
        $check_course_term = "Select term_id from course_term where course_id = '$course_id' and term = '$term'";
        $get_course_term = mysqli_query($dbb,$check_course_term);
        if($get_course_term && mysqli_num_rows($get_course_term) > 0){
            echo("Record already exists");
        }
        else{
            $update_ct = mysqli_query($dbb,"update course_term set term_id = '$term' where course_id = '$course_id' and term_id = '$previousTerm'");
            if($update_ct && mysqli_affected_rows($dbb)>0)
            {
                $delete_ue = mysqli_query($dbb,"delete from users_enrolled where course_id = '$course_id' and term_id = '$previousTerm'");
                if(!$delete_ue)
                {
                    echo("There was a problem in deleting the users enrolled.");
                }
            }
            else
            {
                echo("There was a problem while updating course_term table - Probably already exists.");
                //echo($code."  ".$name." ".$about." ".$department." ".$timing." ".$seats." ".$term."--".$previousTerm."  ".mysqli_affected_rows($dbb));
            }
            $check_enrollment = "Select * from enrollment where course_id = '$course_id' and term_id = '$term' and available_seats='$seats'";
            $get_enrollment = mysqli_query($dbb,$check_enrollment);
            if($get_enrollment && mysqli_num_rows($get_enrollment) > 0){
                echo("Record already exists");
            }
            else{
                $update_enrollement = mysqli_query($dbb,"update enrollment set term_id = '$term', available_seats = '$seats' where course_id = '$course_id' and term_id = '$previousTerm'");
                if($update_enrollement && mysqli_affected_rows($dbb)>0)
                {
                    echo("The record was successfully updated.");
                }
                else
                {
                    echo("There was  problem updating the enrollment table");
                }
            }
        }  
    }   
?>
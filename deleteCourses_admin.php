<?php
    require_once('connection.php');
    session_start();
    
    //if(isset($_POST['login']))
    //{
        $code= $_GET['course_code'];
        $name =  strtolower($_GET['course_name']);
        $term = $_GET['term'];
        $department = $_GET['department'];
        //$timing = $_POST['timings'];
        //$seats = $_POST['seats'];
        //$about =  strtolower($_POST['about']);
        $check_for_same_course = "SELECT courseid FROM course join course_term on courseid = course_term.course_id 
                                        where course_term.term_id = '$term' and course_code = '$code' and course_name = '$name' and dept_id = '$department'";
        $get_courses_existing = mysqli_query($dbb, $check_for_same_course);
        echo( $term." ". $department." ".mysqli_num_rows($get_courses_existing));
            
        if($get_courses_existing && mysqli_num_rows($get_courses_existing) == 1)
        {
            $record = mysqli_fetch_array($get_courses_existing);
            $course_id_1 = $record['courseid'];
            echo("......".$course_id_1."........");
            $delete_1 = "delete from course_term where course_id = '$course_id_1' and term_id='$term'";
            $delete_course_term = mysqli_query($dbb, $delete_1);
            $delete_2 = "delete from enrollment where course_id = '$course_id_1' and term_id='$term'";
            $delete_enrollment = mysqli_query($dbb, $delete_2);
            $delete_ue = mysqli_query($dbb,"delete from users_enrolled where course_id = '$course_id_1' and term_id = '$term'");
            if(!$delete_ue)
            {
                echo("There was a problem in deleting the users enrolled.");
            }
            //$delete_3 = "delete from course where courseid = '$course_id_1'";
            //$delete_course = mysqli_query($dbb, $delete_3);
            // if($delete_course)
            // {
            //     echo("It deleted.");
            // }
            // else
            // {
            //     echo("The course table record did not get deleted");
            // }
            
            
            if($delete_course_term && $delete_enrollment){
                echo("Successful Deletion");
                header('Location: pretendadmin.php');
            }
            else{
                echo("Error in Deletion!!!");
            }
        }
        else
        {
            echo("IT probably retrieved more than 1 row or 0 rows - ERROR");
        }
?>
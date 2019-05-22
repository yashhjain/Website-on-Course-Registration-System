<?php
    require_once('connection.php');
    session_start();
    
    //if(isset($_POST['login']))
    //{
        $code= $_POST['code'];
        $name =  strtolower($_POST['name']);
        $term = $_POST['term'];
        $department = $_POST['department'];
        $timing = $_POST['timings'];
        $seats = $_POST['seats'];
        $about =  strtolower($_POST['about']);
        $check_for_same_course = "SELECT courseid FROM course where  course_code = '$code' and course_name = '$name' and dept_id = '$department' and about = '$about' and seats = '$seats' and time = '$timing'";
        $get_courses_existing = mysqli_query($dbb, $check_for_same_course);
        if($get_courses_existing && mysqli_num_rows($get_courses_existing) > 0)
        {
            echo("..........IT is already there........");
            $course_id_existing = mysqli_fetch_array($get_courses_existing);
            $c_id_existing = $course_id_existing['courseid'];    
            for($k = 0; $k < count($term); $k++)
            {
                $lookup_record  = "SELECT * from course_term WHERE course_id = '$c_id_existing' and term_id = '$term[$k]'";
                $course_per_term = mysqli_query($dbb, $lookup_record);
                if($course_per_term && mysqli_num_rows($course_per_term) > 0)
                {
                    echo("Course Already Exists in ".$term[$k]);
                }
                else
                {
                    $add_to_required_term = "INSERT INTO course_term (course_id, term_id) VALUES ('$c_id_existing','$term[$k]')";
                    $add_to_enrollment_aswell = "INSERT INTO enrollment (course_id, term_id, available_seats) VALUES ('$c_id_existing','$term[$k]','$seats')";
                    $half_add = mysqli_query($dbb, $add_to_required_term);
                    $other_halfadd = mysqli_query($dbb, $add_to_enrollment_aswell);
                    if($half_add && $other_halfadd)
                    {
                        echo("Successfully Added the Course from the sub.");
                    }
                    else
                    {
                        echo("There was a problem in adding the Course from the sub.");
                    }
                }
            }                
        }
        else
        {
            echo("..........Looks like you entered new stuff........");
            $insertCourse = "INSERT INTO course (course_code,course_name,dept_id, about, seats, time)VALUES ('$code','$name','$department','$about','$seats','$timing')";
            $insert_this_query = mysqli_query($dbb, $insertCourse);
            if($insert_this_query)
            {
                //added to the course table. Now add it to the term also.
                $get_course_id = "SELECT courseid FROM course WHERE course_code = '$code' and course_name = '$name' and dept_id = '$department' and about = '$about' and seats = '$seats' and time = '$timing'";
                $exec_for_c_id = mysqli_query($dbb, $get_course_id);    
                if($exec_for_c_id)
                {
                    $course_id_retrieved = mysqli_fetch_array($exec_for_c_id);
                    $c_id = $course_id_retrieved['courseid'];    
                    for($j = 0; $j < count($term); $j++)
                    {
                        $insert_to_course_term = "INSERT INTO course_term (course_id,term_id) VALUES ('$c_id','$term[$j]')";
                        $insert_to_enrollment = "INSERT INTO enrollment (course_id,term_id,available_seats) VALUES ('$c_id','$term[$j]','$seats')";
                        $exec_for_courseterm = mysqli_query($dbb, $insert_to_course_term);
                        $exec_for_enrollment = mysqli_query($dbb, $insert_to_enrollment);
                        if($exec_for_courseterm && $exec_for_enrollment)
                        {
                            echo("Successfully Added the Course from the main.");
                        }
                        else
                        {
                            echo("There was a problem in adding the Course from the main 1.");
                        }
                    }
                }
                else
                {
                    echo("There was a problem in adding the Course from the main 2.");
                }
            }
            else
            {
                echo("There was a problem in adding the Course from the main 3.");
            }
        }
?>
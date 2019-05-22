<?php

    require_once('connection.php');

    //Now let's retrieve term no received from the ajax call.
    $course_id = $_GET['course_id'];
    $username_to_add = $_GET['username'];
    $term_id = $_GET['term_id'];
    //echo($course_id);
    echo($username_to_add);
    echo($term_id);
    $check_if_already_enrolled = "SELECT * FROM users_enrolled WHERE user_name = '$username_to_add' and course_id = '$course_id' and term_id = '$term_id'";
    $already_enrolled = mysqli_query($dbb, $check_if_already_enrolled);
    if($already_enrolled && mysqli_num_rows($already_enrolled) > 0)
    {
        echo("You are already enrolled into the course in that semester");
    }
    else
    {
        $query_to_add_user_to_course = "INSERT INTO users_enrolled (user_name,course_id,term_id) VALUES ('$username_to_add' ,'$course_id', '$term_id')";
        $add_course_to_user = mysqli_query($dbb,$query_to_add_user_to_course);
        //Now, we must have inserted.
    
        //Now, we also have to reduce the available seats by 1.
        $query_to_reduce_seats = "UPDATE enrollment SET available_seats = available_seats - 1 WHERE course_id = $course_id and term_id = '$term_id'";
        $reduce_seats_execution = mysqli_query($dbb, $query_to_reduce_seats);
        //We are done with updation as well.
    
        if($add_course_to_user && $reduce_seats_execution)
        {
            echo("Successfully Enrolled.");
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
        else
        {
            echo("Enrollment was Unsuccessful.");
        }
    }
?>
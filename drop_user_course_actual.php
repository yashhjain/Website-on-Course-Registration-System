<?php
    //Delete the course here.
    //Also, increase the number of available seats by 1 in enrollment_status table.
    
    require_once('connection.php');    
    
    //Now let's retrieve term no received from the ajax call.
    $course_id = $_GET['course_id'];
    $username_now = $_GET['username'];
    $term_to_drop = $_GET['term_id'];
    
    $query_to_drop_user_to_course = "DELETE FROM users_enrolled WHERE user_name = '$username_now' and course_id = '$course_id' and term_id = '$term_to_drop'";
    $drop_course_from_user = mysqli_query($dbb,$query_to_drop_user_to_course);
    //Now, we must have inserted.
    if($drop_course_from_user)
    {
        //Now, we also have to reduce the available seats by 1.
        $query_to_increase_seats = "UPDATE enrollment SET available_seats = available_seats + 1 WHERE course_id = $course_id and term_id = '$term_to_drop'";
        $add_seats_execution = mysqli_query($dbb,$query_to_increase_seats);
        //We are done with updation as well.
        if($add_seats_execution)
        {
            echo("Successfully Dropped.");
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
        else
        {
            echo("Dropping course was Unsuccessful (May be you are not enrolled in that semester).");
        }
    }
    else
    {
        echo("Dropping course was Unsuccessful (May be you are not enrolled in that semester).");
    }

?>

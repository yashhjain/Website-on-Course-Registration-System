<?php
    //This actually retrieves the courses from the table - "courses_enrolled" using $_SESSION['user].
    //But temporarily, just fill in manually.
    require_once('connection.php');
    session_start();

    $user_loggedin = $_POST['username'];
    $query = "select courseid, course_code, course_name, termname, about, time
                from course join users_enrolled on courseid = course_id join term on term_id = termid
                where user_name = '$user_loggedin'";
    $result = mysqli_query($dbb, $query);
    if($result && mysqli_num_rows($result) > 0){
        $rows = mysqli_num_rows($result);
        $courses = array();
        for($i = 0; $i < $rows; $i++)
        {
            $info = mysqli_fetch_array($result);
            $course_id= $info['courseid'];
            $course_code = $info['course_code'];
            $courseName = $info['course_name'];
            $term_name = $info['termname'];
            $about = $info['about'];
            $time = $info['time'];
            $collect = $course_id.";".$course_code.";".$courseName.";".$term_name.";".$about.";".$time;
            array_push($courses,$collect);
        }
        echo implode('~',$courses);
    }

    // $array = array('CS6375:Machine Learning','CS5V81:Implementation of Algorithms and Data Structures','CS6363:Design and analysis of algorithms','CS6360:Database Design','CS6350:Big Data','CS6314:Web Programming Languages');
    // echo implode('~',$array); 
?>
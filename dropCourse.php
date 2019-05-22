<html>
<head>
    <title>Course Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="welcome.css">

  <style>
        table {
            width: 100%;
        }
        tr {
            background-color: #def;
            border: solid;
            border-width: 1px 0;
        }
        th {
        background-color:  #3d3d3f;
        color: white;
        text-align: center;
        border-right: solid 1px gray;
        text-decoration: underline; 
        border-left: solid 1px gray;
        white-space:nowrap;
        padding: 20px;
        }
        td {
        border-right: solid 1px black; 
        border-left: solid 1px black;
        padding: 10px;
        width: 30%;
        height: 30px;
        white-space:nowrap;
        text-align: center;
        font-size: 15px;
        background: transparent;
        }
  </style>

</head>
<body>
    <?php session_start(); ?>
    

    <div class="container-fluid">
    <div class="bodycontent">
        <div class="col-sm-2 sidenav" style='height:100%;'>
                <h2>Course Registration System</h2>
                <ul class="nav nav-pills nav-stacked">
                <li ><a href="welcome.php">Home</a></li>
                    <li><a href="enroll_user_to_course.php">Enroll Course</a></li>
                    <li class="active"><a href="dropCourse.php">Drop Course</a></li>
                    <li><a href="schedule.php">View Enrolled Courses</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul><br>
            </div>
    
            <div class="col-md-6">
            <h1> Drop a course.</h1>
            <p style=" font-size: large;"><strong>Choose the term you want to enroll to: </strong></p>
                
                <select class="form-control inputstl" id="term_to_drop">
                    <option value="0"></option>
                    <option value="1">Fall</option>
                    <option value="2">Spring</option>
                    <option value="3">Summer</option>
                </select>
                <br/>
                <br/>
            </div>
            <div class="col-md-10">
            <table id="courses_offered_that_term" class="display">
                    <thead class="thead-dark">
                        <tr>
                            <th class="col-3">Course Code</th>
                            <th class="col-3">Course Name</th>
                            <th class="col-3">About</th>
                            <th class="col-3">Time</th>
                            <th class="col-3">Remove Courses</th>
                        </tr>
                    </thead>
            </table>
            </div>
       


    <!--Making a skeleton now. This is before the database stage-->
    <script>
        $(document).ready(function(){
                    
                    var username_now = '';
                    username_now = <?php echo json_encode($_SESSION['user_logging_in']); ?>;
                    console.log(username_now);
                    $("#term_to_drop").change(function() 
                    {
                        // We have to make sure that element lose focus immediately
                        // this is key to get this working.
                        //$('#courses_for_selected_term').find('option').remove().end();
                        //We need to make an ajax call to the database to retrieve the courses the user is enrolled in.
                        console.log("Changed ob");
                        $.ajax({
                            url: "courses_per_term_drop.php", 
                            data: {username: username_now, term: $('#term_to_drop').val()},
                            type: "POST",
                            success: function(result){
                                console.log(result);
                                var trHTML = '';
                                var term_entered_value = $('#term_to_drop').val();
                                var courses = result.split('~'); //We can probably set the val tag in select tag for course id.
                                var numberOfCourses = courses.length;
                                $("#courses_offered_that_term").find("tr:gt(0)").remove();
                                for(var i = 0; i < numberOfCourses; i++)
                                {
                                    var course_id_and_name = courses[i].split(';');
                                    var url = 'drop_user_course_actual.php?course_id='+course_id_and_name[0]+'&amp;username='+username_now+'&amp;term_id='+term_entered_value;
                                    trHTML = '<tr><td>' + course_id_and_name[1] + '</td><td>' + course_id_and_name[2] + '</td><td>' + course_id_and_name[3] + '</td><td>'+  course_id_and_name[4] + '</td><td><a href="'+url+'">Drop</a></td></tr>';
                                    $('#courses_offered_that_term').append(trHTML);
                                }
                            }
                        });
                        //This blur step is very important and is key to whole trigger event to work continuosly.
                        $('#term_to_enroll').blur();
                    });
                });
            </script>
    </div>
    </div>
    <footer class="container-fluid" id="footer">
        <p>Copyrights@Team</p>
    </footer>
</body>
</html>
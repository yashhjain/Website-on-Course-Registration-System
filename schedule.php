<html lang="en">
<head>
  <title>Course Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="welcome.css">
  <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
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
<body bgcolor="#c1bdba">
    <div class="container-fluid">
        <div class="bodycontent">
            <div class="col-sm-2 sidenav" style='height:100%;'>
                <h2>Course Registration System</h2>
                <ul class="nav nav-pills nav-stacked">
                <li ><a href="welcome.php">Home</a></li>
                    <li><a href="enroll_user_to_course.php">Enroll Course</a></li>
                    <li><a href="dropCourse.php">Drop Course</a></li>
                    <li class="active"><a href="schedule.php">View Enrolled Courses</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul><br>
            </div>

            <div class="col-sm-9" style="background-color:white">
            <br>
            <br>
            <div class='container' style='width:100%; '>
            <h1> Class Schedule: </h1>
                <table id='Enrolled_courses_for_me' class='display'>
                    <thead>
                        <tr>
                            <th class='col-4'>Course Code</th>
                            <th class='col-4'>Course Name</th>
                            <th class='col-4'>Term</th>
                            <th class='col-4'>About</th>
                            <th class='col-4'>Time</th>
                        </tr>
                    </thead>
                </table>
            </div>	
            
            <br><br>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $( document ).ready(function() {
            var username_now = <?php session_start(); echo(json_encode($_SESSION['user_logging_in']));?>;
            $.ajax({
                url: "retrieve_user_courses.php", 
                data: {username: username_now},
                type: "POST",
                success: function(result)
                {
                    console.log(result);
                    var trHTML = '';
                    var courses = result.split('~'); //We can probably set the val tag in select tag for course id.
                    var numberOfCourses = courses.length;
                    $("#Enrolled_courses_for_me").find("tr:gt(0)").remove();
                    for(var i = 0; i < numberOfCourses; i++)
                    {
                        var course_id_and_name = courses[i].split(';');
                        trHTML = '<tr><td>' + course_id_and_name[1] + '</td><td>' + course_id_and_name[2] + '</td><td>' + course_id_and_name[3] + '</td><td>'+  course_id_and_name[4] + '</td><td>'+  course_id_and_name[5] + '</td></tr>';
                        $('#Enrolled_courses_for_me').append(trHTML);
                    }
                }
            });
        });
    </script>
    <footer class="container-fluid" id="footer">
        <p>Copyrights@Team</p>
    </footer>
</body>
</html>
<html lang="en">
<head>
  <title>Course Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.uikit.min.css">

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
        #footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 3.5rem;            /* Footer height */
        }
  </style>
</head>
<body bgcolor="#c1bdba">
    <div class="container-fluid">
        <div class="bodycontent">
            <div class="col-sm-2 sidenav" style='height:100%;'>
                <h2>Course Registration System</h2>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="welcome.php">Home</a></li>
                    <li><a href="enroll_user_to_course.php">Enroll Course</a></li>
                    <li><a href="dropCourse.php">Drop Course</a></li>
                    <li><a href="schedule.php">View Enrolled Courses</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul><br>
            </div>

            <div class="col-sm-9" style="background-color:white">
            <br>
            <br>
            <div class='container' style='width:100%; '>
                <table id='theTable' class='display uk-table uk-table-hover uk-table-striped' >
                    <thead class='thead-dark'>
                        <tr>
                            <th class='col-3'>Course Code</th>
                            <th class='col-3'>Course Name</th>
                            <th class='col-3'>Department</th>
                            <th class='col-3'>Seats</th>
                            <th class='col-3'>About</th>
                            <th class='col-3'>Time</th>
                            <th class='col-3'> Term </th>
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
            $('#theTable').DataTable({
                ajax: {
                    url: 'dtables.php'
                },
                columns: [
                    { data: 'course_code' },
                    { data: 'course_name' },
                    { data: 'dept_name' },
                    { data: 'seats' },
                    { data: 'about' },
                    { data: 'time' },
                    { data: 'termname' }
                ]
            });  
        });
    </script>

    <footer class="container-fluid" id="footer">
        <p>Copyrights@Team</p>
    </footer>
</body>
</html>
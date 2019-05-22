<html lang="en">
<head>
  <title>Course Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="welcome.css">
  <style>
        /* Submit button style from the login page*/
        #submit_style
        {
            text-decoration: none; border: none; background: transparent;
        }
  </style>
</head>
<body bgcolor="#c1bdba">
    <div class="col-sm-2 sidenav" style='height:100%;'>
      <h2>Course Registration System</h2>
      <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="pretendadmin.php">Home</a></li>
                    <li><a href="addCourse_admin.php">Add Course</a></li>
                    <li><a href="add_department_admin.php">Add a Department</a></li>
                    <li><a href="logout.php">Logout</a></li>
        </ul><br>
    </div>
  <div class="container">
    <h1>Update Course </h1>
    <div class="row justify-content-center">
      <div class="form-group row">
        <div class="col-md-6 offset-md-4">
          <label>Course Code: <input type="text" id="course_code" name="courseCode"></label>  
        </div>
        <div class="col-md-6 offset-md-4">
        <label>Course Name: <input type="text" id="course_name" name="courseName"></label>  
        </div>
        <div class="col-md-6 offset-md-4">
        <label>Term: 
            <select name="term" id="terms_load" class="form-control inputstl">
                <script>    
                        $( document ).ready(function() { 
                            $.ajax({
                                url: "term_retrieval.php", 
                                data: {},
                                type: "GET",
                                success: function(result){
                                    var terms = result.split('~'); //We can probably set the val tag in select tag for course id.
                                    var numberOfterms = terms.length;
                                    var select = document.getElementById("terms_load");
                                    for(var i = 0; i < numberOfterms; i++)
                                    {
                                        var termInfo = terms[i].split(':'); 
                                        select.options[select.options.length] = new Option(termInfo[1], termInfo[0]);
                                    }
                                }
                            });
                        });
                </script>
            </select>
        </label>
        </div>
        <div class="col-md-6 offset-md-4">
        <label>Department: 
            <select name="departments" id="departments_load" class="form-control inputstl">
                <script>    
                        $( document ).ready(function() { 
                            $.ajax({
                                url: "department_retrieval.php", 
                                data: {},
                                type: "GET",
                                success: function(result){
                                    var departments = result.split('~'); //We can probably set the val tag in select tag for course id.
                                    var numberOfdepartments = departments.length;
                                    var select = document.getElementById("departments_load");
                                    for(var i = 0; i < numberOfdepartments; i++)
                                    {
                                        var departmentInfo = departments[i].split(':'); 
                                        select.options[select.options.length] = new Option(departmentInfo[1], departmentInfo[0]);
                                    }
                                }
                            });
                        });
                </script>
            </select>
        </label>
        </div>
        <div class="col-md-6 offset-md-4">
        <br/>
        <label>Timings : <input type="text" name="time" id="Timings" placeholder="Format: hh:mm - hh:mm"></label> 
        </div>
        <div class="col-md-6 offset-md-4">
        <label>Maximum Seats : <input type="text" id="seats" placeholder="Enter the seats limit" name = "seats"></label> 
        </div>
        <div class="col-md-6 offset-md-4">
        <label>About: <input type="text" id="about" name="about"></label>
        </div>
      



      <div class="col-md-6 offset-md-4">
        <div class="btn btn-primary">
          <label>
            <input id="submit_style" type="submit" value="Update Course" name="Update Course"> 
          </label>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
            var c_id = <?php echo json_encode($_GET['course_id']); ?>;
            var c_code = <?php echo json_encode($_GET['course_code']); ?>;
            var c_seats = <?php echo json_encode($_GET['seats']); ?>;
            var c_name = <?php echo json_encode($_GET['course_name']); ?>;
            var c_about = <?php echo json_encode($_GET['about']); ?>;
            var c_time = <?php echo json_encode($_GET['time']); ?>;
            var c_term = <?php echo json_encode($_GET['term']); ?>;
            var c_dept = <?php echo json_encode($_GET['department']); ?>;
            console.log("THe course id at update course admin page is "+c_id);
            console.log("HERE");  
            $('#course_code').val(c_code);
            $('#seats').val(c_seats);
            $('#course_name').val(c_name);
            $('#about').val(c_about);
            $('#Timings').val(c_time);
            
            setTimeout(function(){
              $('#terms_load').val(c_term);
              $('#departments_load').val(c_dept);
              console.log(c_term+"    "+c_dept+"   "+$('#terms_load').val()+$('#departments_load').val());

              //$('#terms_load option[value=" + c_term +"]').prop("selected", true);
            }, 2000); 
            
            //$("[value=" + c_term +"]").attr("selected", "True")
            //$('#terms_load').val(c_term).find("option[value=" + c_term +"]").attr('selected', true);
            
            $(document).on("click","#submit_style",function(){
                $.ajax({
                url: "actual_updateCourse.php", 
                data: {course_id: c_id, code: $('#course_code').val(), seats: $('#seats').val(), name: $('#course_name').val(), term: $('#terms_load option:selected').val() , department: $('#departments_load option:selected').val(), timings: $('#Timings').val(), about: $('#about').val(), previous_term: c_term},
                type: "POST",
                success: function(result){
                    alert(result);
                }
              });
            });
        });
    </script>
</div>
</body>
</html>
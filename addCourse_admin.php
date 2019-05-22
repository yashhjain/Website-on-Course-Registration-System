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
                    <li ><a href="pretendadmin.php">Home</a></li>
                    <li class="active"><a href="addCourse_admin.php">Add Course</a></li>
                    <li><a href="add_department_admin.php">Add a Department</a></li>
                    <li><a href="logout.php">Logout</a></li>
        </ul><br>
    </div>
  
  <div class="container-fluid">
    <h1>Add a course </h1>
    <div class="row justify-content-center">
      <div class="form-group row">
        <div class="col-md-6 offset-md-4">
          <label class="nice_input">Course Code: </label><input type="text" id="course_code" name="courseCode" placeholder="Enter the Course Code">  
        </div>
      
        <div class="col-md-6 offset-md-4">
        <label class="nice_input">Course Name: </label> <input type="text" id="course_name" name="courseName" placeholder="Enter the Course Name"> 
        </div>
      
        <div class="col-md-6 offset-md-4">
        <label class="form-check-label" >Term:    <input type="checkbox" class="form-check-input" name="term" value="1"> Fall<br>
                        <input type="checkbox" class="form-check-input" name="term" value="2"> Spring<br>
                        <input type="checkbox" class="form-check-input" name="term" value="3"> Summer<br> </label>  
        </div>
        <div class="col-md-6 offset-md-4">
        <br/>
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
     
        <div class="col-md-6 offset-md-4"><br/>
        <label class="nice_input">Timings : </label><input type="text" name="time" id="Timings" placeholder="Format: hh:mm - hh:mm">
        </div>
     
        <div class="col-md-6 offset-md-4"><br/>
        <label class="nice_input">Seats : </label><input type="text" id="Seats" placeholder="Enter the seats limit" name = "seats"> 
        </div>
      
        <div class="col-md-6 offset-md-4"><br/>
        <label class="nice_input">About: </label><input type="text" id="about" name="about"  placeholder="Tell us about the course">
        </div>
      

 
        <div class="col-md-6 offset-md-4">
        <div class="btn btn-primary">
          <label>
            <input id="submit_style" type="submit" value="Add Course" name="Add Course"> 
          </label>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
            
        $(document).on("click","#submit_style",function(){
            var checked_terms = [];
            $.each($("input[name='term']:checked"), function(){            
                checked_terms.push($(this).val());
            });

            console.log("Entered details are :");
            console.log($('#course_code').val());
            console.log($('#course_name').val());
            console.log(checked_terms);
            console.log($('#departments_load').val());
            console.log($('#Timings').val());
            console.log($('#about').val() );
            $.ajax({
                url: "actual_addCourse.php", 
                data: {code: $('#course_code').val(), seats: $('#Seats').val(), name: $('#course_name').val(), term: checked_terms, department: $('#departments_load').val(), timings: $('#Timings').val(), about: $('#about').val() },
                type: "POST",
                success: function(result){
                    alert(result);
                }
              });
            
            });
        });
    </script>
</div>
<footer class="container-fluid" id="footer">
        <p>Copyrights@Team</p>
    </footer>
</body>
</html>
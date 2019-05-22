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
</head>
<body bgcolor="#c1bdba">
    <div class="container-fluid">
        <div class="bodycontent">
            <div class="col-sm-2 sidenav" style='height:100%;'>
                <h2>Course Registration System</h2>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="pretendadmin.php">Home</a></li>
                    <li><a href="addCourse_admin.php">Add Course</a></li>
                    <li class="active"><a href="add_department_admin.php">Add a Department</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul><br>
            </div>
            
            <div id="add_department" class="container">
                <h1> Enter the New Deparment Name: </h1>
                <input type="text" id = "new_dept" name="newdept"  placeholder="Enter the department name">
                <br/>
                <button id="create_dept" style="background-color: #4CAF50;border-radius: 30px;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin-left: 30px;">Create</button>
            </div>
            
        </div>
    </div>
    <footer class="container-fluid" id="footer">
        <p>Copyrights@Team</p>
    </footer>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).on("click","#create_dept",function(){
                console.log("CLicked "+ $('#new_dept').val());
                $.ajax({
                url: "actual_add_department.php", 
                data: {department_name: $('#new_dept').val()},
                type: "POST",
                success: function(result){
                  alert(result);
                }
              });
            });
        });
    </script>
</body>
</html>
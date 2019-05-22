$(document).ready(function(){

  $('.input').focus(function(){
    $(this).parent().find(".label-txt").addClass('label-active');
  });

  $(".input").focusout(function(){
    if ($(this).val() == '') {
      $(this).parent().find(".label-txt").removeClass('label-active');
    };
  });
  var status = false;
  var count = 0;
  var uname_flag = false;
  var email_flag = false;
  var password_flag = false;
  var repassword_flag = false;


    //Username Validation Module.
    $("#username").focus(function()
    {
        $('#username_error').html('<p>Username must contains only alphabets and numbers.</p>');
    });

    $("#username").focusout(function()
    {
        var username_here = $('input[name="username"]').val();
        var len = username_here.length;
        if(len == 0)
        {
            $('#username_error').html('');
        }
        else
        {
            var validator = /^[a-z0-9]+$/i;
            var status  = validator.test(username_here);
            if(status)
            {
                $.ajax({
                    url: "checkcreds.php", 
                    data: {username: username_here},
                    type: "POST",
                    success: function(result){
                        if($.trim(result) != '0'){
                            uname_flag = false;
                            $('#username_error').html('<p style="color:red;">Record with this username already exists</p>');
                        }
                        else{
                            count = count + 1;
                            uname_flag = true;
                            $('#username_error').html('<p style="color:green;">Username is valid</p>');
                        }
                    }
                });
            }
            else
            {
                uname_flag = false;
                $('#username_error').html('<p style="color:red;">Username is Invalid. It must contain only alphabets and digits</p>');
            }    
        }
    });

    //Password Validation Module.
    $("#password").focus(function(){
        $('#password_error').html('<p>Password must be at least of length 6.</p>');
    });

    $("#password").focusout(function()
    {
        var password = $('input[name="password"]').val();
        var len = password.length;
        if(len == 0)
        {
            $('#password_error').html('');  
            password_flag = false;
        }
        else
        {
            if(len >= 6)
            {
                count = count + 1;
                password_flag = true;
                $('#password_error').html('<p style="color:green;"> Password is valid.</p>');
            }
            else
            {
                password_flag = false;
                $('#password_error').html('<p style="color:red;">Password is Invalid. It must contain at least 6 Characters.</p>');
            }
        }
    });
    //We will also validate the confirm password.
    $("#repassword").focus(function(){
        $('#repassword_error').html('<p>Password must be at least of length 6 and same as the original.</p>');
        repassword_flag = false;
    });

    $("#repassword").focusout(function()
    {
        var intial_password = $('input[name="password"]').val();
        var repassword = $('input[name="repassword"]').val();
        if($.trim(intial_password) == "")
        {
            $('#repassword_error').html('');
        }
        else
        {
            if(intial_password === repassword)
            {
                count = count + 1;
                repassword_flag = true;
                $('#repassword_error').html('<p style="color:green;">Passwords match and are valid</p>');
            }
            else
            {
                //Display the error message.
                repassword_flag = false;
                $('#repassword_error').html('<p style="color:red;">Passwords do not match.</p>');
            } 
        }
    });



    //Email ID validation module

    $("#email").focus(function(){
        $('#email_error').html('<p>Valid email should contain \'@\' and \'.\'</p>');
    });

    $("#email").focusout(function()
    {
        var email = $('input[name="email"]').val();
        var len = email.length;
        var validator  = /\S+@\S+\.\S+/;
        if(len == 0)
        {
            $('#email_error').html('');
            email_flag = false;
        }
        else
        {
            var status  = validator.test(email);
            if(status)
            {
                $.ajax({
                    url: "checkcreds.php", 
                    data: {email: $('#email').val()},
                    type: "POST",
                    success: function(result){
                        console.log("The result is "+result+"haha ");
                        if($.trim(result) != '0'){
                            email_flag = false;
                            $('#email_error').html('<p style="color:red;">Record with this email already exists</p>');
                        }
                        else{
                            count = count + 1;
                            email_flag = true;
                            $('#email_error').html('<p style="color:green;">Email is valid</p>');
                        }
                    }
                });
            }
            else
            {
                email_flag = false;
                $('#email_error').html('<p style="color:red;">Email is not valid</p>');
            }
        }
    });


    //Now let's validate the whole form and accept submit button.
    $("#submitbutton").click(function(){
        console.log("Entered here");
        console.log(count);
        console.log("Flag status: "+ uname_flag+" "+password_flag+" "+repassword_flag+" "+email_flag);
        if(uname_flag == true && password_flag == true && repassword_flag == true && email_flag == true)
        {
            status = true;
            //alert("Correct inputs");
        }
        else
        {
            alert("Please fill out all the details correctly before clicking submit");
            return false;
        }
        console.log(status);

        $.ajax({
            url: "register.php", 
            data: { password: $('#password').val(), name: $('#name').val(), email: $('#email').val(), username: $('#username').val() },
            type: "POST",
            success: function(result){
                alert("After registeration: "+result);
                // if(result == 'success')
                // {
                //     alert("You have been successfully registered.");
                //     window.location = 'login.html';
                // }
                // else
                // {
                //     alert("Registration was not successful.");
                //     return false;
                // }
            }
        });
        return false;
    });
    
});

$(document).ready(function(){
    //show page when user click "login"
    $(document).on('click', '.btn-login-user',function(){
        //api call to load roles
        $.getJSON("http://localhost:81/stms/api/roles/read.php", function(data){
            var roles_options_html="";
            roles_options_html+="<select name='u_role' class='form-control'>";
                $.each(data.roles, function(key, val){
                    roles_options_html+="<option value='" + val.role_id + "'>" + val.role_name + "</option>";
                });
            roles_options_html+="</select>";

            var  login_user_html="";
        // 'create login' html form
    login_user_html+="<form id='user-login-form' action='#' method='post' border='0'>";
    login_user_html+="<table class='table table-hover table-responsive table-bordered'>";
    //email field
    login_user_html+="<tr>";
        login_user_html+="<td>Email</td>";
        login_user_html+="<td><input type='email' name='u_email' class='form-control' required /></td>";
    login_user_html+="</tr>";
    // password field
    login_user_html+="<tr>";
        login_user_html+="<td>Password</td>";
        login_user_html+="<td><input type='password' name='u_password' class='form-control' required /></td>";
    login_user_html+="</tr>";

    ;

    // button to submit form
    login_user_html+="<tr>";
        login_user_html+="<td></td>";
        login_user_html+="<td>";
            login_user_html+="<button type='submit' class='btn btn-primary'>";
                login_user_html+="<span class='glyphicon glyphicon-plus'></span> Login";
            login_user_html+="</button>";
        login_user_html+="</td>";
    login_user_html+="</tr>";

login_user_html+="</table>";
login_user_html+="</form>";

 // inject to 'page-content' of our app
 $("#page-content").html(login_user_html);
 // chage page title
 changePageTitle("Login");
        });
        
    });
    //login Logic goes here
    $(document).on('submit','#user-login-form', function(data){
        event.preventDefault();
        //get form data
        var form_data=JSON.stringify($(this).serializeObject());
        $.ajax({
            url:'http://localhost:81/stms/api/users/login.php',
            type: "POST",
            data:form_data,
            contentType:'application/json',
            success: function(res){
                showTasks();
                if(res.user){
                    const user = res.user.pop();
                    localStorage.setItem("user_id", user.user_id);
                    showTasks();
                }
                 else{
                    var error_message="";
                    error_message+="<h3 class='alert alert-danger'> Wrong email or Password!</h3>";
                    // inject to 'page-content' of our app
                    
                    $("#page-content").html(error_message);
                }
            },
            error:function(xhr,resp,text){
                //show error in console
                console.log(form_data);
                console.log(xhr, resp, text);
            }
        });
        return false;
    });
    
});
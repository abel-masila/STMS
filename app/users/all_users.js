$(document).ready(function(){
    //list all tasks on page load
    showUsers();
});
// when a 'read products' button was clicked
$(document).on('click', '.read-products-button', function(){
    showUsers();
});

//function to show list of user
function showUsers(){
    $.getJSON("http://localhost:81/stms/api/users/read.php",function(data){
        // html for listing products
        var read_users_html="";
        read_users_html+="<table class='table table-bordered table-hover'>";
            //Create table Heading
            read_users_html+="<tr>";
                read_users_html+="<th class='w-25-pct'>User Id:</th>";
                read_users_html+="<th class='w-10-pct'>Username:</th>";
                read_users_html+="<th class='w-15-pct'>User EMail:</th>";
                read_users_html+="<th class='w-25-pct'>User Role:</th>";
            read_users_html+="</tr>";

            //Row will be here
            // loop through returned list of data
            $.each(data.users, function(key,val){
                 // creating new table row per record
                 read_users_html+="<tr>";
                    read_users_html+="<td>" + val.user_id + "</td>";
                    read_users_html+="<td>" + val.u_name + "</td>";
                    read_users_html+="<td>" + val.u_email + "</td>";
                    read_users_html+="<td>" + val.u_role + "</td>";
                    //action buttons
                    read_users_html+="<td>";
                        //Get one user
                        read_users_html+="<button class='btn btn-primary m-r-10px read-one-product-button' data-id='" + val.u_email + "'>";
                            read_users_html+="<span class='glyphicon glyphicon-eye-open'></span> View";
                        read_users_html+="</button>";
                    read_users_html+="</td>";
                 read_users_html+="</tr>"
            });
            //End table
            read_users_html+="</table>";
            // inject to 'page-content' of our app
            $("#page-content").html(read_users_html);
            // chage page title
            changePageTitle("Read Users");
    });
}

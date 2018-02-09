$(document).ready(function(){
    //list all tasks on page load
    showUsers();
});
//function to show list of user
function showTasks(){
    if(localStorage.getItem("user_id")){
        var task_home_html="";
       
        task_home_html+="<div id='create-product' class='btn btn-primary pull-right m-b-15px create-product-button'>";
        task_home_html+="<span class='glyphicon glyphicon-lock'></span> Logout";
        task_home_html+="</div>";

        task_home_html+="<h3>Hello</h3>";
        // inject to 'page-content' of our app
        $("#page-content").html(task_home_html);
    }else{
        showUsers();
    }
   
}
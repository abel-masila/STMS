$(document).ready(function(){
    //list all tasks on page load
    showTasks();
});
//function to show list of user
function showTasks(){
    var taks_home="";
    // inject to 'page-content' of our app
    $("#page-content").html(taks_home);
    // chage page title
    changePageTitle("Home");
}
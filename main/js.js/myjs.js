//toast logout
function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000);
  setTimeout(' window.location.href = "logout.php"; ',1000);
}
//end toast logout
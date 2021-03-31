function myFunction() {
  var r = confirm("يجب تسجيل الدخول");
  if (r == true) {
	  print("header('location:log.php')");
    window.location="log.php";
  
 }  
let btnRegister=document.getElementById("registerBtn");

btnRegister.onclick=(e)=>{
  e.preventDefault();
  location.href="register.php";
  return false;
}

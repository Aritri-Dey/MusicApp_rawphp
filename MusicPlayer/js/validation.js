/**
 * Function for frontend validation of registration form and login form.
 * 
 *  @return bool
 *    TRUE or FLASE depending on condition satisfaction. 
 */
function checkValid() {
  var userNameReg = document.forms["registerForm"]["userNameReg"].value;
  var emailReg = document.forms["registerForm"]["emailReg"].value;
  var numberReg = document.forms["registerForm"]["numberReg"].value;
  var passwordReg = document.forms["registerForm"]["passwordReg"].value;
  var userNameLogin = document.forms["loginForm"]["userNameLogin"].value;
  var emailLogin = document.forms["loginForm"]["emailLogin"].value;
  var passwordLogin = document.forms["loginForm"]["passwordLogin"].value;
  const alphabetRegex = /^[a-zA-Z]+$/;
  const phoneRegex = /^\+91\d{10}$/;

  if (userNameReg == null || userNameLogin == null) {
    $("#err").text("Enter username");
     return false;
  }
  else if (emailReg == null || emailLogin == null) {
    $("#err").text("Enter a email id");
    return false;
  }
  else if (numberReg == null) {
    $("#err").text("Enter contact number");
    return false;
  }
  else if (passwordReg == null || passwordLogin == null) {
    $("#err").text("Enter a password");
    return false;
  }
  else if (!alphabetRegex.test(userNameReg) || !alphabetRegex.test(userNameLogin) ) {
    $("#errorname").text("Should contain only alphabet.");
    return false;
  }
  else if (!phoneRegex.test(number)) {
    $("#errorphone").text("Enter a valid hone number.");
    return false;
  }
}

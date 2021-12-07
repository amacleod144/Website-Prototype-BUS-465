function validateLogin() {
  var email=document.getElementById("email").value;
  var password=document.getElementById("password").value;
  if ((email == ""||email==null)&&(password == ""||password==null)){
    alert("Email and password must be filled out");
    return false;
  }
  else if (email == ""||email==null) {
    alert("Email must be filled out");
    return false;
    }

  else if (password == ""||password==null) {
    alert("Password must be filled out");
    return false;
  }
}

function validateWash() {
  var wash=document.getElementById("wash").value;

  if (wash == "0"){
    alert("Must select a wash");
    return false;
  }
}

function validateDetail() {
  var detail=document.getElementById("detail").value;

  if (detail == "0"){
    alert("Must select a detail");
    return false;
  }
}

function validatePhone(inputtext) {
  var phoneno = /^\d{10}$/;

  if(inputtext.value.match(phoneno)){
      return true;
      }
      else
      {
      alert("Please enter a 10-digit phone number with no spaces");
      return false;
      }
}


// Function to check Whether both passwords
// is same or not.
//help from https://www.geeksforgeeks.org/password-matching-using-javascript/
function checkPass(form) {
  password1 = form.password.value;
  password2 = form.confirmpass.value;

  // If password not entered
  if (password1 == '')
    alert ("Please enter Password");

// If confirm password not entered
  else if (password2 == '')
    alert ("Please enter confirm password");

  // If Not same return False.
  else if (password1 != password2) {
    alert ("\nPassword did not match: Please try again...")
    return false;
    }

  // If same return True.
  else{
    return true;
    }
}

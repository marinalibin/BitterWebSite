
    
function validate(){
  
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirm = document.getElementById("confirm").value;
    var phone = document.getElementById("phone").value;
    var postalCode = document.getElementById("postalCode").value;
    var namePattern = /^[a-zA-Z ]*$/;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var emailResult = emailPattern.test(email);
    var fnameResult = namePattern.test(fname);
    var lnameResult = namePattern.test(lname);
    var phonePattern = /^((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}$/;
    var phoneResult = phonePattern.test(phone);
    var postalCodePattern= /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/;
    var postalCodeResult = postalCodePattern.test(postalCode);
    
    if(fname.length>50){
        alert("First name should be no longer than 50 characters");
        return false;
    }
    else if(fnameResult === false){
        alert ("Only letters and white space allowed");
        return false;
    }
  
    else if(lname.length>50){
        alert("Last name should be no longer than 50 characters");
      
    }
    else if(lnameResult===false){
        alert ("Only letters and white space allowed");
       
    }
 
    else if(email.length>100){
        alert("Email should be no longer than 100 characters");
    }
    else if(emailResult===false){
       alert("Invalid email format");
    }

    else if(password!==confirm){
        alert("Your password does not match");
    }

    else if(phone.length >25){
        alert("Phone should be no longer than 25 characters");
    }
    else if(phoneResult===false){
        alert("Phone number should be in (111)252-2585 or 111-258-2588 format");
    }

    else if(postalCode>7){
        alert("Postal code should be no longer than 7 characters");
    }
    else if(postalCodeResult===false){
        alert("Postal code in a wrong format");
    }
    else return true;
    
    return false;

}



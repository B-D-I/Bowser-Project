// Event handler for registration form submit
$('#formUserRegistration').submit(function(event){
    formData = $('#formUserRegistration').serialize();
    // cancels the form submission
    event.preventDefault();

    checkStrength(); // checkStrength function called
});

// 			Password Strength Checker & Password Match Checker

// Function to calculate strength of input
function checkStrength(){

    document.getElementById("account_submit_button").onclick=function(e){	// function for id="password_create" will execute when (e) is called below

        let strengthValue = {  // strength metrics for checker defined. Set to false, as will not be false wont be counted as a parameter in strength value
            'caps': false,
            'length': false,
            'special': false,
            'numbers': false,
            'small': false,
        };
        var strengthIndicator = 0 ; 	// Strength indicator starts at 0 at increases with additional 'strength values'
        var passwordEntered = document.getElementById("password_create").value;
        var passwordConfirm = document.getElementById("password_confirm").value;

        if(passwordEntered.length >= 8) { 	// minimum character length for password set to 8 characters
            strengthValue.length = true;

            /* each character in the password has it's char code checked. If the char code for uppercase,
            lowercase, symbol and numbers are used in the password; each value will == true and increase the strength indicator. */
            for (let index=0; index < passwordEntered.length; index++) {
                let char = passwordEntered.charCodeAt(index);

                if( strengthValue.caps === false && char >=65 && char <=90) { // characters 65 - 90 are capital letters
                    strengthValue.caps = true;
                    strengthIndicator++;		// if input contains the characters the strenght indicator increases
                }
                else if( strengthValue.small === false && char >=97 && char <=122){
                    strengthValue.small = true;
                    strengthIndicator++;
                }
                else if( strengthValue.numbers === false && char >=48 && char <=57){
                    strengthValue.numbers = true;
                    strengthIndicator++;
                }
                else  if(strengthValue.special === false && ((char >=33 && char <=47) || (char >=58 && char <= 64))) {
                    strengthValue.special = true;
                    strengthIndicator++;
                }
            }
            var message = "";
            // the strength values are checked to confirm if are being used in the password (true), and increased based on the amount of strength values. A message (string) to provide information on the strength
            if (strengthValue.special === true && strengthValue.caps === true && strengthValue.numbers === true && strengthValue.small === true && strengthValue.length === true && passwordEntered === passwordConfirm){
                message = "Password is strong AND passwords match!\n\nAccount Created";

                // if password match and strength checker are true the form information will be sent to server
                $.ajax({
                    type: "POST",
                    url: "registrationDAO.php",
                    data: formData+"&phpFunction=create",
                    success: function(msg){
                        $("#divMessage").html(msg);
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            }
            // else if statements to display why password not allowed
            else if (strengthValue.special === true && strengthValue.caps === true && strengthValue.numbers === true && strengthValue.small === true && strengthValue.length === true && passwordEntered !== passwordConfirm){
                message = "Password is strong like rhino, but passwords do NOT match!\n\n";
            }
            else if (strengthValue.special === true && strengthValue.caps === true && strengthValue.numbers === true && strengthValue.small === true && strengthValue.length === false && passwordEntered === passwordConfirm){
                message = "Passwords match, but NOT strong enough! \n\nMust contain upper and lowercase letters, numbers and symbols\n";
            }
            else if (strengthValue.special === false || strengthValue.caps === false || strengthValue.numbers === false || strengthValue.small === false || strengthValue.length === false && passwordEntered !== passwordConfirm){
                message = "Passwords do NOT match and is NOT strong enough! \n\nMust contain upper and lowercase letters, numbers and symbols\n";
            }
            // display message notifyin password too weak
            else {
                message = "Password too weak. \n\nMust contain upper and lowercase letters, numbers and symbols\n";
            }
            // an alert containing the strength 'message' and the length of the password
            alert(message);
        }
        else{		// alert given if length too short
            alert ("Password must be at least 8 characters long");
        }
    }
}

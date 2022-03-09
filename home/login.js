// LOGIN
// function on submit - send data to php doc
$('#form_login').submit(function(event) {
    event.preventDefault();
    formData = $('#form_login').serialize();

    // AJAX used to send data to php page / url to send data
    // data type / if stored in cache / alert if successful
    $.ajax({
        type: "POST",
        url: "LoginDAO.php",
        data: formData+"&phpFunction=login",
        datatype: 'json',
        success: function(msg){


            dataJson = JSON.parse(msg);
            console.log(dataJson);

            // need if statement for isAdmin

            // if incorrect data - display message
            if (dataJson['result']=='false') {
                $("#divmessage").html("wrong username or password");
                alert("Incorrect Login");
                // else set session storage, alert and redirect to index page
            } else {
                email = dataJson['Email'];
                password = dataJson['Password'];
                sessionStorage.setItem('email', email);
                sessionStorage.setItem('password', password);
                alert("Logged in");
                window.location="../Home/index.php";
            }
        }
    });
});
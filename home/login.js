// LOGIN
// function on submit - send data to php doc
$('#login_form').submit(function(event) {
    event.preventDefault();
    formData = $('#login_form').serialize();

    // AJAX used to send data to php page / url to send data
    // data type / if stored in cache / alert if successful
    $.ajax({
        type: "POST",
        url: "loginDAO.php",
        data: formData+"&phpFunction=login",
        datatype: 'json',
        success: function(msg){
            dataJson = JSON.parse(msg);
            console.log(dataJson);

            // if incorrect data - display message
            if (dataJson['result']=='false') {
                $("#divmessage").html("wrong username or password");
                alert("Incorrect Login");
                window.location="../home/index.php";
                // else set session storage, alert and redirect to index page
            } else {
                email = dataJson['Email'];
                password = dataJson['Password'];
                sessionStorage.setItem('email', email);
                sessionStorage.setItem('password', password);
                alert("Logged in");
                window.location="../home/index.php";
            }
        }
    });
});
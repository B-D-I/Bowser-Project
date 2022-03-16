$('#formUserRegistration').submit(function(event) {
    formData = $('#formUserRegistration').serialize();

    // cancels the form submission
    event.preventDefault();


    // if password match and strength checker are true the form information will be sent to server
    $.ajax({
        type: "POST",
        url: "operationsDAO.php",
        data: formData+"&phpFunction=create",
        success: function(msg){
            $("#divMessage").html(msg);
            window.location="operations.php";

        },
        error: function(msg){
            console.log(msg);
            window.location="operations.php";
        }
    });
});
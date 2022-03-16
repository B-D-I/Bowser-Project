$('#formUserRegistration').submit(function(event) {
    formData = $('#formUserRegistration').serialize();

    // prevents the form submission
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "operationsDAO.php",
        data: formData+"&phpFunction=createUser",
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

$('#formBowserRequest').submit(function(event) {
    formData2 = $('#formBowserRequest').serialize();

    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "operationsDAO.php",
        data: formData2+"&phpFunction=requestBowser",
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
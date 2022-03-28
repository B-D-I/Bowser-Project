<?php
function ex_handler($ex){
	//Get error message.
    $errorMessage = "An error occured in ". $ex->getFile() ." on line ". $ex->getLine() ." Error message: ". $ex->getMessage();
    //Use some kind of error logging to save the error info. 
    //logError($errorMessage);
    //Let the user know something went worong nicely without crashing the app.
	echo $errorMessage;
    //Exit program execution.
	echo '<script type="text/javascript">alert("'.$errorMessage.'");</script>';
	echo '<script type="text/javascript">window.location.reload();</script>';
	
	exit();
};
?>
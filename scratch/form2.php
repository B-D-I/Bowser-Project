<?php
session_start();

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Autocomplete Search Box in PHP MySQL - Tutsmake.com</title>
 
<!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 
<!-- Bootstrap Css -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body> 
<?php
	$_SESSION['query'] = 'SELECT * FROM tbl_bowser_stock WHERE Bowser_Serial LIKE "%{TERM}%" LIMIT 25';
?>
<div class="container">
  <div class="row">
     <h2>Search Here</h2>
     <input type="text" name="term" id="term" placeholder="search here...." class="form-control">  
  </div>
</div>
<script type="text/javascript">
  $(function() {
     $( "#term" ).autocomplete({
       source: 'ajax-db-search2.php',
     });
  });
</script>
</body>
</html>
<?php
session_start();

$filter = NULL;
if(!empty($_POST['filter']))
$filter = $_POST['filter'];
$_SESSION["filter"] = $filter;
if (empty($filter)){
   $_SESSION['query'] = "LLAMAS";
} else {
	$_SESSION['query'] = "ALPACAS";
}

echo $_SESSION['query']."<br />";
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Checkbox</title>
</head>
<body>
<form  action="filter.php" method="post">
Filter<input type="checkbox" name="filter"  value="filter" onchange="this.form.submit()" <?php if(!empty($_SESSION["filter"])){echo "checked";} ?>>

</form>

</body>
</html>
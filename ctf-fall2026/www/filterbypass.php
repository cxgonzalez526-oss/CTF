<?php
	$myUserName = "ctf2026filter";
	$myPassword = "ItWasAllDiegosFault";
	$myDatabase = "filterbypass";
	$myHost = "localhost";
	mysqli_report(MYSQLI_REPORT_OFF);
	$db = mysqli_connect($myHost, $myUserName, $myPassword) or die('I cannot connect to the database.');
	mysqli_select_db($db, $myDatabase) or die("Unable to select database");

	function clean($input) {
		$blacklist = array('select', 'union', '--', '#');
		foreach ($blacklist as $word) {
			$input = str_ireplace($word, '', $input);
		}
		return $input;
	}

	$results = array();
	$searched = false;

	if (isset($_GET['name']) && $_GET['name'] !== '') {
		$searched = true;
		$name = clean($_GET['name']);
		$query = "SELECT id, name, department FROM staff WHERE name LIKE '%" . $name . "%'";
		$myResult = mysqli_query($db, $query);
		if ($myResult) {
			while ($row = mysqli_fetch_assoc($myResult)) {
				$results[] = $row;
			}
		}
	}

	mysqli_close($db);
?>
<!DOCTYPE html>
<html>
<head>
<title>Staff Directory</title>
<link rel="stylesheet" type="text/css" href="yui.2.css" />
<link rel="stylesheet" type="text/css" href="global.6.css" />
</head>
<body>
<h1>Staff Directory</h1>
<p>Search for employees by name.</p>
<form method="get">
<p>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($_GET['name'] ?? ''); ?>" size="30" /></p>
<p><input type="submit" value="Search" /></p>
</form>
<?php if ($searched): ?>
<h2>Results</h2>
<?php if (empty($results)): ?>
<p>No employees found.</p>
<?php else: ?>
<table border="1" cellpadding="4">
<tr><th>ID</th><th>Name</th><th>Department</th></tr>
<?php foreach ($results as $row): ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['department']; ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<?php endif; ?>
</body>
</html>

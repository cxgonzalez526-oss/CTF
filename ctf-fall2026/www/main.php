<?php
	session_start();
	if ($_SESSION['login'] == null)
	{
		header("Location: admin.php");
		exit;
	}
	if (!isset($_COOKIE['admin'])) {
	   setcookie('admin', 'false');
	   $_COOKIE['admin'] = 'false';
	   echo '
<html>
<head><title>404 Not Found</title></head>
<body bgcolor="white">
<center><h1>404 Not Found</h1></center>
<hr><center>nginx/1.14.12</center>
</body>
</html>
<!-- Hmmm, the plot thickens... key{007ff0d25d44fa502acfa3c9ad670158e6c7c186be96e5781f70c4e51c065e91}-->';
     }
     elseif (isset($_COOKIE['admin']) && strcmp($_COOKIE['admin'], 'true') == 0) {
     	    echo "<!DOCTYPE html><html><head><title>Main</title></head><body><p>Congratulations! Here you go: key{f4c1d292a37482e950f6cd48509c91307b1e856c4efbf33830073a078253a2e0}</p></body></html>";
     }
     else {
                echo '
<html>
<head><title>404 Not Found</title></head>
<body bgcolor="white">
<center><h1>404 Not Found</h1></center>
<hr><center>nginx/1.14.12</center>
</body>
</html>
<!-- Hmmm, the plot thickens... key{007ff0d25d44fa502acfa3c9ad670158e6c7c186be96e5781f70c4e51c065e91}-->';}
?>

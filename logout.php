<?php
    session_start();
    session_unset();
    header("Location: index.php");
?>
<html>
	<head>
		<script type="text/javascript">
		sessionStorage.clear();
		</script>
	</head>
	<body></body>
</html>
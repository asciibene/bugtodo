<?php 

include_once "func.php";
include_once "class.php";
    
?>
<html>
<head>
<title>Admin Login<?=VER?> </title>
<link rel="stylesheet" type="text/css" href="./style.css"/> 
</head>
<body>
<h1 id="logo"><a id="logolink" href="index.php" ><sub id="logo_bug">bug</sub>Todo</a><span class="ver_num"><?= VER ?></span> [ADMIN]</h1>
<br><hr>
<?php if($_COOKIE['isAdmin']==true): ?>
<a class="menuitem" href="config.php">Configuration</a>
<a class="menuitem href="."></a>
<hr>
<?php endif; ?>
<hr>
<footer><small> (c) 2023 ascii_bene </small>  </footer>
</body>
</html>

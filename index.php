<?php 
session_start();

include_once "func.php";
include_once "class.php";    

?>
<html>
<head>
<title>bugTodo <?=VER?> </title>
<link rel="stylesheet" type="text/css" href="./style.css"/> 
</head>
<body>
  
<h1 id="logo"><a id="logolink" href="index.php" ><sub id="logo_bug">bug</sub>Todo</a><span class="ver_num"><?= VER ?></span></h1>
<hr>
<a class="menuitem" href="auth.php">Admin Login</a>
<hr>
<?php if(empty($_GET) and empty($_POST)): ?> 
 <form id="intro_action_form" method="post" action="index.php">
  <button name="action" value="showform_newbug">New bug</button>
  <button name="action" value="showform_chprojx">Change Project</button>
  <button name="action" value="">etc</button>
</form>
<hr>
<?php
else:

if( $_POST['action']  == "showform_newbug"): ?>
<h4>New Bug</h4>
<form id="newbug_form" method="post" action="index.php"> 
 <label for="new_title">Title</label>
 <input name="new_title"> </input><br>
 <button name="action" value="new_bug">Create a new bug</button>
</form>
<?php endif; ?>
<hr>
<?php
if($_POST['action']=="new_bug"): 
  indoc_new_bug($_POST["new_title"]);
elseif($_POST['action']=="del_bug" and isset($_GET['id'])):
  indoc_delete_bug($_GET['id']);
endif; 
endif;?>
<h3>Newest bugs</h3>
<?php intro_viewall_bugs(); ?>
<hr>
<footer><small> (c)2023 ascii_bene </small>  </footer>
</body>
</html>

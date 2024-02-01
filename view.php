<html>
<head>
<title>bugTodo Viewer</title>
<link rel="stylesheet" type="text/css" href="./style.css"/> 
</head>
<body>
<?php
  include_once "func.php";
  include_once "class.php";    
  if(isset($_POST['action']) and $_POST['action'] == "upd_bug"):
    indoc_update_bug($_GET['id']);
  endif;
?>

<h1 id="logo"><a id="logolink" href="index.php" ><sub id="logo_bug">bug</sub>Todo</a><span class="ver_num"><?= VER ?></span></h1>
<hr>
<?php if(isset($_GET['id'])):
    indoc_view_bug($_GET['id']);
    #↑↑↑ If id provide then we show the bug ?>
<hr>
<?='<form action="view.php?id='.$_GET['id'].'" method="post">' ?>
  <label for="new_priority">Priority</label>
  <select name="new_priority">
  <option>High</option>
  <option>Normal</option>
  <option>Low</option>
  </select><br>

  <label for="new_state">State</label>
  <select name="new_state">
  <option>no state</option>
  <option>open</option>
  <option>closed</option>
  <option>resolved</option>
  </select>
  <br>

 <label for="new_desc">Description</label><br>
 <textarea name="new_desc"> <?= $db[$_GET['id']]->desc; ?> </textarea>
 <br>
 <button name="action" value="upd_bug">submit</button>
</form>
<hr>

</form>
<?php endif;?>
</body>
</html>

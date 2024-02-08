<html>
<head>
<title>BugTodo config</title>
<link rel="stylesheet" type="text/css" href="./style.css"/> 
</head>
<body>
<?php
    include_once "func.php";
?>
<h1 id="logo"><a id="logolink" href="index.php" ><sub id="logo_bug">bug</sub>Todo</a><span class="ver_num"><?= VER ?></span></h1>

<hr>
<?php
if(!empty($_POST)):
  if($_POST['priority_arrows']=="show"):
    $config['priority_arrows']=true;
    notify('updated config !');
  else:
    $config['priority_arrows']=false;                        
    notify('updated config !');
  endif;
endif;


?>
<h2>Configuration</h2>
<form id="config_form" method="post">
<ul>
<li>
<label for="priority_arrows">Display arrows next to bugs based on priority</label>
<select name="priority_arrows">
    <option>show</option>
    <option>hide</option>
</select>
<li>
<label for="priority_arrows">...</label>
<select name="priority_arrows">
    <option>show</option>
    <option>hide</option>
</select>
<li>
</ul>
<button>Submit</button>
</form>

</body>
</html>

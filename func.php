<?php
include_once("class.php");
// Below : constants
define("CONFIGLOC","./db/config.db");
define("DBLOC","./db/todo.db");
define("VER","v0.05");
define("UDBLOC","./db/users.db"); #For later
define("PDBLOC","./db/projx.db"); #For later
// Constants end ---------  -----------Begin  Helper Funcs ------------- 
function notify($ns){
  echo '<small class="notify">'.$ns.'</small>';
  return null;
}

function mktag($tag,$content,$atlist = null){
  if($atlist == null):
     return "<".$tag.">".$content."</".$tag.">";
   else:
     $attr_string="";
     foreach($atlist as $atr=>$val):
       $attr_string = $attr_string.$atr.'="'.$val.'" ';
     endforeach;
   return "<".$tag.$attr_string.">".$content."</".$tag.">";
  endif;
}

function get_from_uid($inuid){
  global $db;
  foreach($db as $k=>$obj){
    if($inuid == $obj->uid)
        return $obj; 
  }
  return false;
}

// ────   End of helper funcs ────────────

function resetdb(){
  global $db;
  $db = [];
  $dbtxt=serialize($db);
  file_put_contents(DBLOC,$dbtxt);
  savedb();
}

function initdb(){
  global $db;
  global $config;
  if (file_exists(DBLOC)){
    $dbtxt=file_get_contents(DBLOC);
    $db=unserialize($dbtxt);
    return true;
  }else{
    print("DB File not found, making one...");
   $db = [];
   $dbtxt=serialize($db);
    file_put_contents(DBLOC,$dbtxt);
  } 
 
  if (file_exists(CONFIGLOC)){
    $configtxt=file_get_contents(CONFIGLOC);
    $config=unserialize($configtxt);
  }else{
    print("Config File not found, making one...");
    $config = ["expanded_view" => true];
    $configtxt=serialize($config);
    file_put_contents(CONFIGLOC,$configtxt);
  }

  global $udb;
  if (file_exists(UDBLOC)){
    $udbtxt=file_get_contents(UDBLOC);
    $udb=unserialize($udbtxt);
  }else{
    print("users DB File not found, making one...");
   $udb = [];
   $udbtxt=serialize($udb);
   file_put_contents(UDBLOC,$udbtxt);
  } 
  global $prjdb;
  if (file_exists(PDBLOC)){
    $pdbtxt=file_get_contents(PDBLOC);
    $prjdb=unserialize($pdbtxt);
  }else{
    print("Projects DB File not found, making one...");
   $prjdb = [];
   $pdbtxt=serialize($prjdb);
   file_put_contents(PDBLOC,$pdbtxt);
  } 
  savedb();
}


function savedb(){
  global $db;
  file_put_contents(DBLOC,serialize($db));
  global $config;
  file_put_contents(CONFIGLOC,serialize($config));
  return true;          
}

// -------------- Indocument functions ----------------- 

function intro_viewall_bugs(){
  global $db;
  global $config;
  echo '<ul class="buglist">';
  foreach($db as $k=>$obj): 
    $htmclass = $obj->state == "closed" ? "Closed" : 'Open';
    print('<li class="'.$htmclass.'"><a href="view.php?id='.$k.'">'.$obj."</a></li>");
  endforeach;
  print('</ul>');
}

function indoc_new_bug($ttl){
  global $db;
  if($ttl==""){ 
    notify("Error - Empty string or non-string submitted");
    return false;
  }
  else{
  array_push($db,new BugObject($ttl));
  notify('Created new Bug'.$ttl);
  savedb();
  }
}

function indoc_view_bug($bugid){
// task id is the order of db array
  global $config;
  global $db;
  if(array_key_exists($bugid, $db)):
      $tobj=$db[$bugid];
      echo '<h2>'.$tobj->title.'</h2>';
      echo'<hr>';
      print mktag('em',$tobj->desc??"No Description");
     echo '<ul class="detail_list">';
       // Show details and form to upd it
     $diff=date_diff($tobj->timestamp,date_create('now'));
      print mktag('li',mktag('date','created '.$diff->format('%a days, %h hour(s), %i minute(s) ago')));
      print mktag('li',mktag('span','state: '.$tobj->state));
      print mktag('li','priority: '.$tobj->priority);
      print mktag('small','uid: '.$tobj->uid);
    
      //Buttons etc <--------
      echo '<form action="index.php?id='.$bugid.'" method="post"><button name="action" value="del_bug">Delete</button></form>';
      echo '</ul>';
   else:
    notify("error - id does not exist"); 
     return false;
  endif;  
      
}

function indoc_update_bug($id){
// ndarr -> array of new details (use pack funcs)
// 			donot
  global $db;
  $db[$id]->priority=$_POST['new_priority'] ?? $db[$id]->priority; 
  $db[$id]->state=$_POST['new_state'] ?? $db[$id]->state;
  if($_POST['new_desc'] != "")
      $db[$id]->desc =  $_POST['new_desc'] ?? $db[$id]->desc;
  savedb();
}


function indoc_delete_bug($bugid){
  global $db;
  unset($db[$bugid]);
  unset($_GET['id']); 
  savedb();
  //notify('Deleted task #'.$bugid);
}

function checksec(){
  if $_COOKIE['pass']


}
// ──────────────── End of indoc funcs -------------


// ───────────── MAIN STUFF ────────────-------------------------------------------------------------

initdb();


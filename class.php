<?php
// ─────────────────── class defs

class BugObject{
  public $title;
  public $priority;
  public $timestamp;
  public $state;
  public $uid;
  public $desc;

  public function __construct($ttl,$pri = 'None',$desc = null)
  {
    $this->uid = uniqid(); //no use curr. (v.0.05)
    $this->timestamp=date_create('now');
    $this->title = $ttl;
    $this->state = "No State";
    $this->priority = $pri;
    $this->desc = $desc;
  }
  
  public function __toString()
  {
    return $this->title;
  }
  
  public function __callable()
  {
    return serialise($this);
  }
public function get_details_array(){
	# Returns an array w/ obj's details as strings
	  $proparray=[];
    foreach($this as $pname=>$pval):
      $proparray[$pname]=$pval;
		endforeach;
		return $proparray;
  }
}

class User{
  private $name;
  public $pwd;
  public function __construct($name){
    $this->name=$name;
 
  }
}

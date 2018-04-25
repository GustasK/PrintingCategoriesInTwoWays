<?php

class Category
{
  private $id;
  private $parent_id;
  private $name;

  function __construct($id, $parent_id, $name)
  {
      $this->id = $id;
      $this->parent_id = $parent_id;
      $this->name = $name;
  }

  public function getID(){
    return $this->id;
  }

  public function getParentID() {
    return $this->parent_id;
  }

  public function getName() {
    return $this->name;
  }
}

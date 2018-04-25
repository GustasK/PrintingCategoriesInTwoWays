<?php
  session_start();

  require_once "../Classes/Category.php";

  if(isset($_POST['submit'])) {
    if(isset($_POST['categoryName'])) {
      if(strlen($_POST['categoryName']) > 0) {
        if($_SESSION['object_id'] == NULL)
          $_SESSION['object_id'] = 1;

        $category = new Category($_SESSION['object_id'], (int)$_POST['parentName'], $_POST['categoryName']);

        $_SESSION['categories'][] = [
          "id" => $category->getID(),
          "parent_id" => $category->getParentID(),
          "name" => $category->getName()
        ];

        $_SESSION['object_id'] ++;
      }
    }
  }

  header("Location: ../index.php");

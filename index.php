<?php session_start();?>

<form action="Actions/AddCategory.php" method="post">
  <input type="text" name="categoryName" />
  <select name="parentName">
    <?php
      echo "<option value=" . 0 . ">Root Category</option>";
      if(isset($_SESSION['categories'])) {
        foreach ($_SESSION['categories'] as $category) {
          echo "<option value=" . $category['id'] .">" . $category['name'] . "</option>";
        }
      }
    ?>
  </select>
  <input type="submit" name="submit" value="Submit">
</form>

<form action="Actions/DestroySession.php" method="post">
  <input type="submit" value="Clear everything">
</form>

<?php
    include_once "functions.php";

    if(isset($_SESSION['categories'])) {
      echo "<h3>Recursive method</h3>";
      printCategoryTree(recursiveCategoryTree($_SESSION['categories']));

      echo "<h3>Iterative method</h3>";
      iterativeMethod($_SESSION['categories']);
    }

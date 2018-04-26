<?php

  function recursiveCategoryTree(array $elements, $parent_id = 0) {
    $branch = [];

    foreach($elements as $element) {

      if($element['parent_id'] == $parent_id) {
        $children = recursiveCategoryTree($elements, $element['id']);
        if($children) {
          $element['children'] = $children;
        }
        $branch[] = $element;
      }
    }
    return $branch;
  }

  function iterativeMethod(array $elements) {
      $sort = array();
      foreach($elements as $key => $element) {
          $sort['name'][$key] = $element['name'];
          $sort['parent_id'][$key] = $element['parent_id'];
      }

      array_multisort($sort['parent_id'], SORT_ASC, $sort['name'], SORT_ASC, $elements);

      for($i = 0; $i < count($elements); $i++) {
          $node = $elements[$i];
          $children = array_filter($elements, function($v) use ($node) {
              return $v['parent_id'] == $node['id'];
          });
          foreach ($children as $key => $child) {
              array_splice($elements, $i + 1, 0, [$child]);
              unset($elements[$key + 1]);
          }
          $elements = array_values($elements);
      }

      $previousNode = null;
      echo "<ul>";
      for($i = 0; $i < count($elements); $i++) {
          $nextNode = isset($elements[$i + 1]) ? $elements[$i + 1] : null;

          $node = $elements[$i];

          if($previousNode && $previousNode['id'] == $node['parent_id']) {
              echo "<ul>";
          }

          if(!$node['parent_id']) {
              echo "</ul><ul>";
          }
          echo "<li>";
          echo $node['name'];

          if($nextNode && $nextNode['parent_id'] != $node['id'] && $nextNode['parent_id'] != $node['parent_id']) {
              echo "</ul></ul>";
          }

          $previousNode = $node;
      }
      echo "</ul>";
  }

  function printCategoryTree(array $branch) {
    echo "<ul>";
    foreach($branch as $element) {
      echo "<li>" . $element['name'] . "</li>";
      if(!empty($element['children'])) {
          printCategoryTree($element['children']);
      }
    }
    echo "</ul>";
  }

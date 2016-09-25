<?php

function get_categories($parent){
  global $db;
  $parent = (int) $parent;
  $req = $db->prepare('SELECT * FROM categories WHERE parent = :parent');
  $req->bindParam(':parent', $parent, PDO::PARAM_INT);
  $req->execute();
  $categories = $req->fetchAll();
  return $categories;
}
function getCategorieById($id){
  global $db;
  $id = (int) $id;
  $req = $db->prepare('SELECT * FROM categories WHERE id = :id');
  $req->bindParam(':id', $id, PDO::PARAM_INT);
  $req->execute();
  $categorie = $req->fetch();
  return $categorie;
}
function category_exist($parent, $category){
  global $db;
  $req = $db->prepare('SELECT  * FROM categories WHERE category = :category AND parent = :parent');
  $req->bindParam(':category', $category, PDO::PARAM_STR);
  $req->bindParam(':parent', $parent, PDO::PARAM_STR);
  $req->execute();
  if($req->rowCount() > 0){
    return true;
  }
  else {
    return false;
  }
}
function add_categories($parent, $category){
  global $db;
  $parent = (int) $parent;

  $req = $db->prepare("INSERT INTO categories(parent, category) VALUES (:parent, :category)");
  $req->execute(array(
    "parent" => $parent,
    "category" => $category
  ));
  header('Location: categories.php');
}

function delete_categories($id){
  global $db;
  $id = (int) $id;
  $req = $db->prepare('DELETE FROM categories WHERE id = :id ');
  $req->bindParam(':id', $id, PDO::PARAM_INT);
  $req->execute();
  header('Location: categories.php');
}
function delete_categories_parent($id){
  global $db;
  $id = (int) $id;
  $req1 = $db->prepare("SELECT * FROM categories WHERE id = :id");
  $req1->bindParam(':id', $id, PDO::PARAM_INT);
  $req1->execute();
  $categorie = $req1->fetchAll();
  $req2 = $db->prepare('DELETE FROM categories WHERE parent = :id ');
  $req2->bindParam(':id', $id, PDO::PARAM_INT);
  $req2->execute();
  header('Location: categories.php');
}

function edit_categorie($edit_id, $categorieid, $parentid){
  global $db;
  $edit_id = (int)$edit_id;
  $parentid = (int) $parentid;
  $req = $db->prepare("UPDATE categories SET category = :category, parent = :parent WHERE  id = :id");
  $req->bindParam(':id', $edit_id, PDO::PARAM_INT);
  $req->bindParam(':category', $categorieid, PDO::PARAM_STR);
  $req->bindParam(':parent', $parentid, PDO::PARAM_INT);
  $req->execute();
  header('Location: categories.php');
}

<?php
	session_start();
	require_once "../classes/PdoConnect.php";
	
	$pdoConnect = PdoConnect::getInstance();
	$pdo = $pdoConnect->PDO;


	if(isset($_POST['delete_id'])) {
		$delete_id = $_POST['delete_id'];
		$sql_delete = $pdo->prepare("DELETE FROM goods WHERE id = :delete_id");
		$sql_delete->bindParam(':delete_id', $delete_id);
		$sql_delete->execute();
	}


	if(isset($_POST['edit_id'])) {
		$edit_id = $_POST['edit_id'];
		$new_name = $_POST['new_name'];
		$new_price = $_POST['new_price'];
		$new_image = $_POST['new_image'];
		$sql_edit = $pdo->prepare("UPDATE goods SET name = :new_name, price = :new_price, image = :new_image WHERE id = :edit_id");
		$sql_edit->bindParam(':edit_id', $edit_id);
		$sql_edit->bindParam(':new_name', $new_name);
		$sql_edit->bindParam(':new_price', $new_price);
		$sql_edit->bindParam(':new_image', $new_image);
		$sql_edit->execute();

		header("Location: ".$_SERVER['PHP_SELF']);
		exit();
	}


	if(isset($_POST['new_name']) && isset($_POST['new_price']) && isset($_POST['new_image'])) {
		$new_name = $_POST['new_name'];
		$new_price = $_POST['new_price'];
		$new_image = $_POST['new_image'];
		$sql_add = $pdo->prepare("INSERT INTO goods (name, price, image) VALUES (:new_name, :new_price, :new_image)");
		$sql_add->bindParam(':new_name', $new_name);
		$sql_add->bindParam(':new_price', $new_price);
		$sql_add->bindParam(':new_image', $new_image);
		$sql_add->execute();

		header("Location: ".$_SERVER['PHP_SELF']);
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Админ панель</title>
	<link href="static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="text-align:center">
<h1> Редактирование товаров </h1>

<?php if(!empty($_SESSION['login'])) :?>


<br>


<form action="" method="post">
	<input type="text" placeholder="ID товара" name="delete_id">
	<input type="submit" value="Удалить товар">
</form>
<br>

<form action="" method="post">
	<input type="text" placeholder="ID товара" name="edit_id">
	<input type="text" placeholder="Новое название" name="new_name">
	<input type="text" placeholder="Новая цена" name="new_price">
	<input type="text" placeholder="Новое изображение" name="new_image">
	<input type="submit" value="Изменить данные">
</form>
<br>

<form action="" method="post">
	<input type="text" placeholder="Название товара" name="new_name">
	<input type="text" placeholder="Цена" name="new_price">
	<input type="text" placeholder="Ссылка на изображение" name="new_image">
	<input type="submit" value="Добавить товар">
</form>
<br>
<br>
<a href="/logout.php">Выйти</a>

<?php else:
	echo '<h2>Неудача</h2>';
	echo '<a href="/">Выйти</a>';
?>

<?php endif ?>
</div>

</body>
</html>
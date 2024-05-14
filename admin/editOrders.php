<?php
	session_start();
	require_once "../classes/PdoConnect.php";
	
	$pdoConnect = PdoConnect::getInstance();
	$pdo = $pdoConnect->PDO;


	if(isset($_POST['delete_id'])) {
		$delete_id = $_POST['delete_id'];
		$sql_delete = $pdo->prepare("DELETE FROM orders WHERE id = :delete_id");
		$sql_delete->bindParam(':delete_id', $delete_id);
		$sql_delete->execute();
	}


	if(isset($_POST['edit_id'])) {
		$edit_id = $_POST['edit_id'];
		$new_fio = $_POST['new_fio'];
		$new_phone = $_POST['new_phone'];
		$new_email = $_POST['new_email'];
		$new_comment = $_POST['new_comment'];
		$new_product_id = $_POST['new_product_id'];
		$sql_edit = $pdo->prepare("UPDATE orders SET fio = :new_fio, phone = :new_phone, email = :new_email, comment = :new_comment, product_id = :new_product_id WHERE id = :edit_id");
		$sql_edit->bindParam(':edit_id', $edit_id);
		$sql_edit->bindParam(':new_fio', $new_fio);
		$sql_edit->bindParam(':new_phone', $new_phone);
		$sql_edit->bindParam(':new_email', $new_email);
		$sql_edit->bindParam(':new_comment', $new_comment);
		$sql_edit->bindParam(':new_product_id', $new_product_id);
		$sql_edit->execute();

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
<h1> Редактирование заказов </h1>

<?php if(!empty($_SESSION['login'])) :?>


<br>


<form action="" method="post">
	<input type="text" placeholder="ID заказа" name="delete_id">
	<input type="submit" value="Удалить заказ">
</form>
<br>

<form action="" method="post">
	<input type="text" placeholder="ID заказа" name="edit_id">
	<input type="text" placeholder="Новое ФИО" name="new_fio">
	<input type="text" placeholder="Новый телефон" name="new_phone">
	<input type="text" placeholder="Новая почта" name="new_email">
	<input type="text" placeholder="Новый комментарий" name="new_comment">
	<input type="text" placeholder="Новый id товара" name="new_product_id">
	<input type="submit" value="Изменить данные">
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
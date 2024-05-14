<?php
	session_start();
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


<?php if(!empty($_SESSION['login'])) :?>

<?php echo "Вы в админке,".$_SESSION['login']; ?>
<br>
<a href="/admin/editGoods.php">Редактировать товары</a>
<br>
<a href="/admin/editOrders.php">Редактировать заказы</a>
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
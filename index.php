<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" version="XHTML+RDFa 1.0" dir="ltr">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
		<?php if ($_SESSION['admin'] != "admin") { 
			echo '<link rel="stylesheet" href="admin-style.css">';
		}?>
		<title>Тестовое задание</title>
	</head>
	<body class="container-fluid">
		<div id="main-wrapper" class="container">
			<?php include "task.php"; ?>
			<?php if ($lastPageNum > 1) {?>
				<ul id="page-navigator">
					<?php if($pageNum > 1) { ?>
						<li><a href="<?=$separatorpaginator;?>page=1">&lt;&lt;</a></li>
						<li><a href="<?=$separatorpaginator;?>page=<?=$pageNum-1;?>">&lt;</a></li>
					<?php } ?>
         
					<?php for($i = 1; $i<=$lastPageNum; $i++) { ?>
						<li <?=($i == $pageNum) ? 'class="current"' : '';?>> <a href="<?=$separatorpaginator;?>page=<?=$i;?>"><?=$i;?></a> </li>
					<?php } ?>
         
					<?php if($pageNum < $lastPageNum) { ?>
						<li><a href="<?=$separatorpaginator;?>page=<?=$pageNum+1;?>">&gt;</a></li>
						<li><a href="<?=$separatorpaginator;?>page=<?=$lastPageNum;?>">&gt;&gt;</a></li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
		<div id="main-footer" class="container">
			<div id="add-task"><div>Добавить задачу</div></div>
			<?php if ($_SESSION['admin'] != "admin") {
				echo '<div id="autorization"><div>Войти</div></div>';
			 } else {
				echo '<div id="logout"><div><a href="/?do=logout">Выйти</a></div></div>';
			 } ?>
		</div>
		
		<div id="modal-form-login" class="modal-form">
			<div class="close-modal-form"></div>
			<div class="modal-form-body">
				<div id="autorization-body">
					<form method="post" id="autorization-form" action="">
						<div class="form-textfield form-login-textfield">
							<input id="login" type="text" name="login" placeholder="Логин" />
						</div>
						<div class="form-textfield form-pass-textfield">
							<input id="pass" type="text" name="pass" placeholder="Пароль" />
						</div>
						<div class="form-submit">
							<input type="button" id="autorization-btn" value="Войти" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="modal-form-add-task" class="modal-form">
			<div class="close-modal-form"></div>
			<div class="modal-form-body">
				<div id="add-task-body">
					<form method="post" id="add-task-form" action="">
						<div class="form-textfield form-name-textfield">
							<input id="name" type="text" name="name" required placeholder="Имя пользователя" />
						</div>
						<div class="form-textfield form-email-textfield">
							<input id="email" type="text" name="email" required placeholder="E-mail" />
						</div>
						<div class="form-textarea form-task-text-textarea">
							<textarea rows="5" cols="40" id="task-text" type="text" name="task-text" required placeholder="Сообщение" /></textarea>
						</div>
						<div class="form-submit">
							<input type="button" id="add-task-btn" value="Отправить" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php if ($_SESSION['admin'] == "admin") { ?>
			<div id="modal-form-edit-task" class="modal-form">
				<div class="close-modal-form"></div>
				<div class="modal-form-body">
					<form method="post" id="add-task-form" action="">
						<input id="taskid" type="hidden" name="taskid" required/>
						<div class="form-textfield form-name-textfield">
							<input id="name-edit" type="text" name="name-edit" required/>
						</div>
						<div class="form-textfield form-email-textfield">
							<input id="email-edit" type="text" name="email-edit" required/>
						</div>
						<div class="form-textarea form-task-text-textarea">
							<textarea rows="5" cols="40" id="task-text-edit" type="text" name="task-text-edit" required/></textarea>
						</div>
						<div class="form-checkbox form-status-checkbox">
							<input id="status-edit" type="checkbox" name="status-edit"/> <label for="status-edit">Выполнено</label>
						</div>
						<div class="form-submit">
							<input type="button" id="edit-task-btn" value="Изменить" />
						</div>
					</form>
				</div>
			</div>
		<?php } ?>
		<div id="overlay">
		<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		<script src="script.js"></script>
	</body>
</html>
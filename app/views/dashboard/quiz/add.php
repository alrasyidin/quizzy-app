<h3>Add new quiz</h3>
<?php include VIEWS . 'dashboard/partials/alertMessages.php'; ?>
<form class="form" action="<?= BASEPATH ?>dashboard/postAddQuiz" method="post">
	<div class="content-group">
		<label for="name">Enter the quiz name</label>
		<input type="text" name="name" placeholder="Quiz name"/>
	</div>
	<input class="active-btn" type="submit" name="addQuiz" value="Add quiz">
</form>

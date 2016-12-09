<h3>Add question</h3>
<?php include VIEWS . 'dashboard/partials/alertMessages.php'; ?>

<form class="form" action="<?= BASEPATH ?>dashboard/postAddQuestion" method="post">
	<div class="content-group">
		<label for="quiz">For quiz</label>
		<select name="quiz-id">
				<option value="0">Choose the quiz</option>
			<?php  foreach ($content as $quiz): ?>
				<option value="<?= $quiz['quizId'] ?>"><?= $quiz['quizName'] ?></option>
			<?php  endforeach; ?>
		</select>
	</div>
	<div class="content-group">
		<label for="question">Question</label>
		<input type="text" name="question" />
	</div>
	<input class="active-btn" type="submit" name="addQuestion" value="Add Question">
</form>

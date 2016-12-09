<?php foreach ($content['reportData'] as $quiz => $questions): ?>

	<div class="shaded-box push-down">
			<?= $quiz ?> quiz / final results
	</div>

	<?php foreach ($questions as $question => $answers): ?>
		<div class="shaded-box push-down">
		 	<b>Question: </b> <?= $question ?> <br>

			<?php foreach ($answers as $answer): ?>

	      <b>The right answer: </b> <?= $answer['rightAnswer'] ?> <br>
		  <b>Your answer: </b> <?= $answer['userAnswer'] ?> <br>
	      <b>Points: </b> <?= $answer['point'] ?> <br>

			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>

<?php endforeach; ?>



<div class="label-link">
	Final Score <?= $content['userScore'] . ' / ' . $content['totalQuestions']?>
</div>

<a href="<?= BASEPATH ?>quiz/index" class="label-link">Take another quiz</a>

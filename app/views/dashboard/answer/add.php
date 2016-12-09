<h3>Add answer</h3>
<?php include VIEWS . 'dashboard/partials/alertMessages.php'; ?>
<form class="form" action="<?= BASEPATH ?>dashboard/postAddAnswer" method="post">
	<div class="content-group">
		<label for="quiz">Quiz: </label>
		<select name="quizId" id="quiz">
				<option value="0">Select quiz first</option>
			<?php  foreach ($content['quizes'] as $quiz): ?>
				<option value="<?= $quiz['quizId'] ?>"><?= $quiz['quizName'] ?></option>
			<?php  endforeach; ?>
		</select>
	</div>
	<div class="content-group">
		<label for="question">Question</label>
		<select name="questionId" id="questions"></select>
	</div>
	<div class="content-group">
		<label for="rightAnswer">Enter the right answer</label>
		<input type="text" name="rightAnswer">
	</div>
	<div class="content-group">
		<label for="wrongAnswer1">Wrong answer 1</label>
		<input type="text" name="wrongAnswers[]">
	</div>
	<div class="content-group">
		<label for="wrongAnswer2">Wrong answer 2</label>
		<input type="text" name="wrongAnswers[]">
	</div>
	<div class="content-group">
		<label for="wrongAnswer3">Wrong answer 3</label>
		<input type="text" name="wrongAnswers[]">
	</div>
	<input class="active-btn" type="submit" name="submitAnswer" value="Add answers">
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
var quiz = $('#quiz'),
	questionsWrapper = $('#questions');

quiz.on('change', function(){
	var quizId = quiz.find(':selected').attr('value');
	$.ajax({
		url: "/quiz system/dashboard/getQuestionsForQuiz/"+quizId,
		method: "GET",
		dataType:"json"
	})
	.done(function( data ) {
		questionsWrapper.html("");
		for(var i = 0 ; i < data.length ; i++){
			$(
				"<option value=" + data[i]['questionId'] + " > " + data[i]['question'] + "</option>"
			).appendTo(questionsWrapper);
		}
    });
});
</script>

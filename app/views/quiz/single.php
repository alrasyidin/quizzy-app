<?php foreach($content as $quizId => $quizes): ?>
<form method="post" action="<?= BASEPATH . 'quiz/postanswers/'. $quizId ?>">
    <?php foreach ($quizes as $quizName => $questions): ?>

        <div class="push-down shaded-box">
          <?= $quizName ?> quiz
        </div>

        <?php foreach ($questions as $questionName => $answers): ?>

            <div class="push-down shaded-box">

              <div class="question-title">
                <?= $questionName ?>
              </div>
			  <?php shuffle($answers); foreach ($answers as $answer): ?>

                <input name = "<?= $answer['questionId'] ?>" type="radio" value="<?= $answer['answerId'] ?>"/>
                <input name = "<?= $answer['answerId'] . 'UAnsText' ?>" type="hidden" value="<?= $answer['answerText'] ?>"/>

                <?= $answer['answerText'] ?> <br>

              <?php endforeach; ?>

            </div>

        <?php endforeach; ?>

    <?php endforeach; ?>
<br>
<button type="submit" class="active-btn">Submit answers</button>
</form>
<?php endforeach; ?>

<h3>Available Quizes</h3>

    <?php
        if (count($content) == 0)

            echo '<div class="shaded-box">No available quizes</div>';
    ?>

    <?php foreach ($content as $quiz): ?>
        <div class="shaded-box">

              <a href=" <?= BASEPATH . 'quiz/getquiz/' . $quiz['quizId'] ?>">
                  <?= $quiz['quizName']; ?>
              </a>

        </div>

    <?php endforeach; ?>

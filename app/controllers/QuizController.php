<?php

class QuizController extends Controller {

    private $quizModel;

    public function __construct() {
        // inject the models
        $this->quizModel = $this->callModel('Quiz');
    }

    // show all tha available quizes
    public function index() {
        $quizes = $this->quizModel->getAllQuizes();
        echo $this->callView('quiz/index', 'templates/master', $quizes);
    }

    // get single quiz
    public function getquiz($quizId) {
        $quizData = $this->quizModel->getSingleQuiz($quizId);
        echo $this->callView('quiz/single', 'templates/master', $quizData);
    }

    public function postanswers($quizId) {
        $pointsCounter = 0;
        $questions = $this->quizModel->getQuestionsData($quizId);
        $questionsNum = count($questions);
        $finalResults = [];
				$finalResultsGrouped = [];

        foreach ($questions as $value) {

            // if the user give an answer
            if( isset($_POST[$value['questionId']])){
               // push the user answer
               $value['userAnswer'] = $_POST[ $_POST[$value['questionId']] . 'UAnsText' ];
               // check the user answer and give a point to the user
                 if ( $_POST[$value['questionId']] == $value['rightAnswerId'] ){
                   $pointsCounter++;
                   $value['point'] = 1;
                 } else {
                   $value['point'] = 0;
                 }
            } else {
                 $value['userAnswer'] = 'answer not provided';
                 $value['point'] = 0;
            }

            $finalResults[] = $value;

        }

				// group the information

				foreach ($finalResults as $value) {
					$finalResultsGrouped[$value['quizName']][$value['question']][] = ['rightAnswer' => $value['rightAnswer'] , 'userAnswer' => $value['userAnswer'] , 'point' => $value['point']];
				}

				$data = [
					'reportData' => $finalResultsGrouped,
					'userScore' => $pointsCounter,
					'totalQuestions' => $questionsNum,
				];

				echo $this->callView('quiz/report', 'templates/master', $data);
    }
}

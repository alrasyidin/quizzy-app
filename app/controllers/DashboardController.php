<?php
class DashboardController extends Controller{

	private $quizModel;
	private $questionModel;
	private $answerModel;

	public function __construct(){
		$this->quizModel = $this->callModel('Quiz');
		$this->questionModel = $this->callModel('Question');
		$this->answerModel = $this->callModel('Answer');
	}

	public function index(){
		echo $this->callView('dashboard/index', 'templates/master');
	}

	public function addQuiz(){
		Session::start();
		echo $this->callView('dashboard/quiz/add', 'templates/master');
		Session::end();
	}

	public function postAddQuiz(){
		// get the data
		$quizInfo = [];
		$quizInfo['name'] = Input::get('name');;

		// validate the data
		$rules = [
			'Quiz name' => [$quizInfo['name'],'isempty']
		];

		// response messages
		$messages = Validator::validate($rules);

		if(count($messages) == 0){
			$this->quizModel->addQuiz($quizInfo);
			Session::start()->create('messages', 'Quiz added successfully, start add some questions');
			Redirect::to(BASEPATH . "dashboard/addQuestion");
		} else {
			Session::start()->create('messages', $messages);
			Redirect::to(BASEPATH . "dashboard/addQuiz");
		}


	}

	public function addQuestion(){
		Session::start();
		$quizes = $this->quizModel->getAllQuizes();
		echo $this->callView('dashboard/question/add', 'templates/master', $quizes);
		Session::end();
	}

	public function postAddQuestion(){

		// get the inputs
		$questionInfo = [];
		$questionInfo['question'] = Input::get('question');
		$questionInfo['quizId']   = Input::get('quiz-id');

		// validate the inputs
		$rules = [
			'Quiz' => [$questionInfo['quizId'], 'isempty'],
			'Question' => [$questionInfo['question'], 'isempty']
		];

		$messages = Validator::validate($rules);

		if(count($messages) == 0){
			$this->questionModel->addQuestion($questionInfo);
			Session::start()->create('messages', 'Question added successfully, add the answers below');
			Redirect::to(BASEPATH . "dashboard/addAnswer");
		} else {
			Session::start()->create('messages', $messages);
			Redirect::to(BASEPATH . "dashboard/addQuestion");
		}
	}

	public function addAnswer(){
		Session::start();
		$quizes = $this->quizModel->getAllQuizes();
		$questions = $this->questionModel->getAllQuestions();
		$data = [
			'quizes' => $quizes,
			'questions' => $questions
		];
		echo $this->callView('dashboard/answer/add', 'templates/master', $data);
		Session::end();
	}

	public function postAddAnswer(){

		// get the inputs
		$quizId = Input::get('quizId');
		$questionId = Input::get('questionId');
		$rightAnswer = Input::get('rightAnswer');
		$wrongAnswers = Input::get('wrongAnswers');

		// validate the inputs
		$rules = [
			'Quiz' => [$quizId, 'isempty'],
			'Question' => [$questionId, 'isempty'],
			'Right answer' => [$rightAnswer, 'isempty'],
			'Wrong answer 1' => [$wrongAnswers[0], 'isempty'],
			'Wrong answer 2' => [$wrongAnswers[1], 'isempty'],
			'Wrong answer 3' => [$wrongAnswers[2], 'isempty'],
		];

		$messages = Validator::validate($rules);

		if(count($messages) == 0){
			$this->answerModel->addAnswer($rightAnswer, $questionId, 1);

			foreach ($wrongAnswers as $wrongAnswer) {
				$this->answerModel->addAnswer($wrongAnswer, $questionId, 0);
			}
			Redirect::to(BASEPATH . "quiz/index");
		} else {
			Session::start()->create('messages', $messages);
			Redirect::to(BASEPATH . "dashboard/addAnswer");
		}

	}

	public function getQuestionsForQuiz($quizId){
		$questions = $this->questionModel->getQuestionByQuizId($quizId);
		echo json_encode($questions);
	}

}

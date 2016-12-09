<?php

class Question extends DataBase {

    public function __construct() {
        // inject the connection
        $this->connect();
    }

	public function getAllQuestions(){
		$stmt = $this->dbconn->prepare("SELECT question, id questionId FROM questions");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getQuestionByQuizId($quizId){
		$stmt = $this->dbconn->prepare("SELECT question, id questionId FROM questions WHERE quiz_id = :quizid");
		$stmt->bindParam('quizid', $quizId);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function addQuestion($data){
		$stmt = $this->dbconn->prepare("INSERT INTO questions (question, quiz_id) VALUES (:question, :quizId)");
		$stmt->bindParam(':question', $data['question']);
		$stmt->bindParam(':quizId', $data['quizId']);
		$stmt->execute();
	}

}

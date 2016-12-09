<?php

class Answer extends DataBase {

    public function __construct() {
        // inject the connection
        $this->connect();
    }

	public function addAnswer($answer, $questionId, $state) {
		$stmt = $this->dbconn->prepare("INSERT INTO answers (name, question_id, state) VALUES (:answer, :questionId, :state)");
		$stmt->bindParam(':answer', $answer);
		$stmt->bindParam(':questionId', $questionId);
		$stmt->bindParam(':state', $state);
		$stmt->execute();
	}

}

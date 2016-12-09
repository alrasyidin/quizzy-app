<?php

class Quiz extends DataBase {

    public function __construct() {
        // inject the connection
        $this->connect();
    }

    public function getAllQuizes() {
      $stmt = $this->dbconn->prepare("SELECT id quizId, name quizName FROM quiz");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSingleQuiz( $quizId ) {
        $rows = [];
        $stmt = $this->dbconn->prepare(
                "
                    SELECT  quiz.id quizId, quiz.name quizName,
                            questions.id questionId, questions.question,
                            answers.id answerId, answers.name answerName
                    FROM quiz
                    INNER JOIN questions
                    ON quiz.id = questions.quiz_id
                    INNER JOIN answers
                    ON questions.id = answers.question_id
                    WHERE quiz.id = :id
                "
            );

        $stmt->bindParam(':id', $quizId);
        $stmt->execute();

        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $rows[$row['quizId']][$row['quizName']][$row['question']][] = ['answerId' => $row['answerId'], 'answerText' => $row['answerName'], 'questionId' => $row['questionId']];
        }

        return $rows;
    }

    public function getQuestionsData( $quizId ) {
        $rows = [];
        $stmt = $this->dbconn->prepare(
                "
                    SELECT  quiz.name quizName,
                            questions.question, questions.id questionId,
                            answers.id rightAnswerId, answers.name rightAnswer
                    FROM quiz
                    INNER JOIN questions
                    ON quiz.id = questions.quiz_id
                    INNER JOIN answers
                    ON questions.id = answers.question_id
                    WHERE quiz.id = :id
                    AND answers.state = 1
                "
            );

        $stmt->bindParam(':id', $quizId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function addQuiz($quizInfo){
		$stmt = $this->dbconn->prepare("INSERT INTO quiz (name, level_id, entry_date) VALUES (:name, '1', NOW())");
		$stmt->bindParam(':name', $quizInfo['name']);
		$stmt->execute();
	}


}

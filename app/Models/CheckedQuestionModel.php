<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckedQuestionModel extends Model
{
    protected $table = 'checked_question';
    protected $primaryKey = 'id';
    protected $allowedFields = ['test_id', 'user_id', 'question_id', 'test_date']; // Sesuaikan dengan kolom yang ada di tabel checked_question

    public function getSelectedQuestions($userId, $testDate)
    {
        return $this->where('user_id', $userId)
            ->where('test_date', $testDate)
            ->findAll();
    }
}

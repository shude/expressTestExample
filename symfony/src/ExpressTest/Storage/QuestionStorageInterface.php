<?php

namespace App\ExpressTest\Storage;

use App\ExpressTest\Entity\Question;

interface QuestionStorageInterface
{
    /**
     * Возвращает индексный массив, ключами которого являются идентификаторы
     * вопросов.
     * @return Question[]
     */
    public function getQuestionsByTestId(int $testId): array;
}
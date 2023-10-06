<?php

namespace App\ExpressTest\Storage;

use App\ExpressTest\Entity\Answer;

interface AnswerStorageInterface
{
    /**
     * Возвращает индексный массив, ключами которого являются идентификаторы
     * ответов.
     * @return Answer[]
     */
    public function getAnswersByQuestionID(int $questionId): array;
}
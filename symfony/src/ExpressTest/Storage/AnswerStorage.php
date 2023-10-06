<?php

namespace App\ExpressTest\Storage;

use App\ExpressTest\Entity\Answer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AnswerStorage extends ServiceEntityRepository implements AnswerStorageInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    public function getAnswersByQuestionID(int $questionId): array
    {
        return $this->createQueryBuilder('a', 'a.id')
            ->andWhere('a.question = :quid')
            ->setParameter('quid', $questionId)
            ->getQuery()
            ->getResult();
    }
}
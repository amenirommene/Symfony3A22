<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

     /**
      * @return Student[] Returns an array of Student objects
      */

    public function getStudentsByEmails($value)
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.email', $value)
           // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getStudentsByEmailsDQL($value)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery("Select s from App\Entity\Student s ORDER BY s.email $value");

          return  $query->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

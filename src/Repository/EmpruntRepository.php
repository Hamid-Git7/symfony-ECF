<?php

namespace App\Repository;

use App\Entity\Emprunt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emprunt>
 *
 * @method Emprunt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emprunt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emprunt[]    findAll()
 * @method Emprunt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpruntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emprunt::class);
    }

    /**
     * @return Emprunt[] Returns an array of Emprunt objects
     */
    public function findLastEmprunt($value): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.dateEmprunt', 'DESC')
            ->setMaxResults($value)
            ->getQuery()
            ->getResult();
    }

    public function findEmprunt2(): array
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.emprunteur = 2')
            ->orderBy('e.dateEmprunt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findEmprunt3(): array
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.livre = 3')
            ->orderBy('e.dateEmprunt', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findLastEmprunt10($value1): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.dateRetour IS NOT NULL')
            ->orderBy('e.dateRetour', 'DESC')
            ->setMaxResults($value1)
            ->getQuery()
            ->getResult();
    }

    public function findEmpruntNotReturn(): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.dateRetour IS NULL')
            ->orderBy('e.dateEmprunt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findEmpruntId3($value3): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.livre = :value')
            ->setParameter('value', $value3)
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?Emprunt
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

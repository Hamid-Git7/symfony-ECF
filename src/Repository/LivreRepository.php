<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 *
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    /**
     * @return Livre[] Returns an array of Livre objects
     */
    public function findAllLivre(): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.titre IS NOT null')
            ->orderBy('l.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findTitreLorem(string $keyword): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.titre LIKE :keyword')
            ->setParameter('keyword', "%$keyword%")
            ->orderBy('l.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findBooksByGenre(string $genres): array
    {
        return $this->createQueryBuilder('l')
            ->innerJoin('l.genres', 'genres')
            ->andWhere('genres.nom LIKE :genres')
            ->setParameter('genres', "%$genres%")
            ->orderBy('l.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Livre
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

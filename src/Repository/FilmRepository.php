<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
 
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    // /**
    //  * @return Film[] Returns an array of Film objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	
	public function findAllBetweenDate($min, $max)//recherche tout les films dont la date de sortie est compris entre les dates min et max
	{
		return $this->createQueryBuilder('f')
			->where('f.dateSortie >= :min')
			->setParameter('min', $min)
			->andWhere('f.dateSortie <= :max')
			->setParameter('max',$max)
			->orderBy('f.dateSortie', 'asc')
			->getQuery()
			->getResult()
		;	
	}
	
	
	public function findAllInfDate($date)//recherche tout les films dont la date de sortie est < à date
	{
		return $this->createQueryBuilder('f')
			->where('f.dateSortie < :date')
			->setParameter('date',$date)
			->orderBy('f.dateSortie', 'asc')
			->getQuery()
			->getResult()
		;	
    }
    public function augmeter($note) {
        $query = $this->getEntityManager()
        ->createQuery("UPDATE App\Entity\Film s
        SET s.note = s.note + '1'");
        $result = $query->execute();
        }
        public function diminuer($note) {
            $query = $this->getEntityManager()
            ->createQuery("UPDATE App\Entity\Film s
            SET s.note = s.note - '1'");
            $result = $query->execute();
            }
 
	
	
}

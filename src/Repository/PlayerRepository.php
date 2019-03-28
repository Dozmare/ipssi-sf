<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Player::class);
    }

    /** @return Player[] */
    public function getTop5Amount(): array
    {
        $querybuilder = $this->createQueryBuilder('player')
            ->orderBy('player.amount', 'DESC')
            ->setMaxResults(5);

        return $querybuilder->getQuery()->getResult();
    }

    /** @return Player[] */
    public function getTopRatio(): array
    {
        $sql = '
        SELECT
               name,
               (victories/fails) as ratio
        FROM player
        order by ratio IS NULL DESC,ratio DESC, victories DESC
        LIMIT 5
        ';

        $connection = $this->getEntityManager()->getConnection();

        $result = $connection->executeQuery($sql);

        dump($result->fetchAll()); die();
        $querybuilder = $this->createQueryBuilder('player')
            ->select('player.name, (player.victories/player.fails) as ratio')
            ->orderBy('ratio, player.name', 'DESC')
            ->setMaxResults(5);

        return $querybuilder->getQuery()->getResult();
    }

    // /**
    //  * @return Player[] Returns an array of Player objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Player
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

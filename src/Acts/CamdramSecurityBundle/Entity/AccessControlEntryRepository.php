<?php
namespace Acts\CamdramSecurityBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

use Acts\CamdramBundle\Entity\Organisation,
    Acts\CamdramBundle\Entity\Show;
use Acts\CamdramSecurityBundle\Security\OwnableInterface;
use Acts\CamdramSecurityBundle\Security\User\CamdramUserInterface;

class AccessControlEntryRepository extends EntityRepository
{
    public function aceExists(User $user, OwnableInterface $entity)
    {
        $qb = $this->createQueryBuilder('e');
        $query =$qb->select('COUNT(e.id) AS c')
                ->where('e.userId = :uid')
                ->andWhere('e.entityId = :entityId')
                ->andWhere('e.revokedBy IS NULL')
                ->andWhere('e.type = :type')
                ->setParameter('entityId', $entity->getId())
                ->setParameter('type', $entity->getAceType())
                ->setParameter('uid', $user->getId())
        ;

        $res = $query->getQuery()->getOneOrNullResult();
        return $res['c'] > 0;
    }

    /**
     * find an ACE for this User accessing the specified resource.
     */
    public function findAce(User $user, OwnableInterface $entity)
    {
        $qb = $this->createQueryBuilder('e');
        $query = $qb->where('e.user = :user')
                ->andWhere('e.entityId = :entityId')
                ->andWhere('e.type = :type')
                ->setParameter('user', $user)
                ->setParameter('entityId', $entity->getId())
                ->setParameter('type', $entity->getAceType())
        ;

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * Get an ACE request request made by a user for the show.
     */
    public function findAceRequest(User $user, Show $show)
    {
        $qb = $this->createQueryBuilder('e');
        $query = $qb->where('e.user = :user')
            ->andWhere('e.entityId = :entityId')
            ->andWhere("e.type = 'request-show'")
            ->setParameter('user', $user)
            ->setParameter('entityId', $show->getId())
        ;
        return $query->getQuery()->getOneOrNullResult();
    }

    public function findByUserAndType(User $user, $type)
    {
        $qb = $this->createQueryBuilder('e');
        $query = $qb->where('e.user = :user')
            ->andWhere('e.revokedBy IS NULL')
            ->andWhere('e.type = :type')
            ->setParameter('type', $type)
            ->setParameter('user', $user)
        ;
        return $query->getQuery()->getResult();
    }
}


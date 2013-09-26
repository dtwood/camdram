<?php

namespace Acts\CamdramBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TimePeriodRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TimePeriodRepository extends EntityRepository
{

    public function getTimePeriodsAt(\DateTime $date, $limit)
    {
        $qb = $this->createQueryBuilder('p');
        $query = $qb->where($qb->expr()->andX('p.start_at <= :now', 'p.end_at > :now'))
            ->orWhere('p.start_at >= :now')
            ->setParameter('now', $date)
            ->orderBy('p.start_at', 'ASC')
            ->setMaxResults($limit)
            ->getQuery();
        return $query->getResult();
    }

    public function getTimePeriodsAfter($date, $limit)
    {
        $qb = $this->createQueryBuilder('p');
        $query = $qb->where('p.start_at >= :date')
            ->setParameter('date', $date)
            ->orderBy('p.start_at', 'ASC')
            ->setMaxResults($limit)
            ->getQuery();
        return $query->getResult();
    }

    public function getTimePeriodsBefore(\DateTime $date, $limit)
    {
        $qb = $this->createQueryBuilder('p');
        $query = $qb->where('p.end_at <= :date')
            ->setParameter('date', $date)
            ->orderBy('p.start_at', 'DESC')
            ->setMaxResults($limit)
            ->getQuery();
        return array_reverse($query->getResult());
    }

    public function getTimePeriodAt(\DateTime $date)
    {
        return current($this->getTimePeriodsAt($date, 1));
    }

    public function getTimePeriods(\DateTime $start, \DateTime $end)
    {

        $qb = $this->createQueryBuilder('p');

        $query = $qb
            ->where($qb->expr()->andX('p.start_at < :start', 'p.end_at >= :start'))
            ->orWhere($qb->expr()->andX('p.start_at < :end', 'p.end_at >= :end'))
            ->orWhere($qb->expr()->andX('p.start_at > :start', 'p.end_at <= :end'))
            ->setParameter('start', $start)->setParameter('end', $end)
            ->getQuery();

        return $query->getResult();
    }

}
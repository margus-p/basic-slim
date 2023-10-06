<?php

declare(strict_types=1);

namespace App\Repositories\Implementation\Doctrine\Site;

use App\Model\SiteVisit;
use App\Repositories\Contracts\Site\SiteVisitRepositoryInterface;
use App\Repositories\Implementation\Doctrine\BaseDoctrineRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;

class SiteVisitRepository extends BaseDoctrineRepository implements SiteVisitRepositoryInterface
{

    /**
     * @throws NotSupported
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em, $em->getRepository(SiteVisit::class));
    }

}

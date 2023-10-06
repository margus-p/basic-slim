<?php

declare(strict_types=1);

namespace App\Repositories\Implementation\Doctrine;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\DbException;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ObjectRepository;
use Psr\Log\LoggerInterface;

class BaseDoctrineRepository implements RepositoryInterface
{
    protected EntityManager $entityManager;
    protected ObjectRepository $genericRepository;
    private bool $isTransactionActive = false;
    protected static ?LoggerInterface $logger;

    public function __construct(EntityManager $em, ObjectRepository $or)
    {
        $this->entityManager = $em;
        $this->genericRepository = $or;

    }

    public function findAll(): array
    {
        return $this->genericRepository->findAll();
    }

    public function find($id)
    {
        return $this->genericRepository->findOneBy(["id" => $id]);
    }

    public function exists($id): bool
    {
        $query_builder = $this->entityManager->createQueryBuilder()
            ->select("t.id")
            ->from($this->genericRepository->getClassName(), "t")
            ->where("t.id=:entity_id")
            ->setParameter(":entity_id", $id)
            ->setMaxResults(1);

        return (bool) $query_builder->getQuery()->getResult();

    }

    public function persist($object): bool
    {
        try {
            $this->entityManager->persist($object);
            return true;

        } catch (ORMException|\Exception $e) {
            $this->getLogger()?->error("EntityManager persist failed. Reason: ".$e->getMessage(), ["trace" => $e->getTraceAsString()]);
            return false;

        }

    }

    public function isPersisted($object): bool
    {
        return $this->entityManager->contains($object);
    }

    public function hardDelete($object): bool
    {
        try {
            $this->entityManager->remove($object);
            return true;

        } catch (ORMException|\Exception $e) {
            $this->getLogger()?->error("EntityManager hardDelete failed. Reason: ".$e->getMessage(), ["trace" => $e->getTraceAsString()]);
            return false;

        }

    }

    public function saveChanges(): bool
    {
        try {
            $this->entityManager->flush();
            return true;

        } catch (OptimisticLockException|ORMException|\Exception $e) {
            $this->getLogger()?->error("EntityManager flush failed. Reason: ".$e->getMessage(), ["trace" => $e->getTraceAsString()]);
            return false;

        }

    }

    public function saveSingle($object): bool
    {
        try {
            $this->entityManager->flush($object);
            return true;

        } catch (OptimisticLockException|ORMException|\Exception $e) {
            $this->getLogger()?->error("EntityManager flush (single) failed. Reason: ".$e->getMessage(), ["trace" => $e->getTraceAsString()]);
            return false;

        }

    }

    public function beginTransaction(): void
    {
        if(!$this->isTransactionActive()) {
            try {
                $this->isTransactionActive = $this->entityManager->getConnection()->beginTransaction();

            } catch (Exception $e) {
                $this->getLogger()?->error("EntityManager beginTransaction failed. Reason: ".$e->getMessage(), ["trace" => $e->getTraceAsString()]);
                throw new DBException("Cannot initiate transaction", previous: $e);

            }

        }

    }

    public function rollback(): void
    {
        if($this->isTransactionActive()) {
            try {
                $this->entityManager->getConnection()->rollBack();
                $this->isTransactionActive = false;

            } catch (Exception $e) {
                $this->getLogger()?->error("EntityManager rollback failed. Reason: ".$e->getMessage(), ["trace" => $e->getTraceAsString()]);
                throw new DBException("Cannot rollback transaction", previous: $e);

            }

        }

    }

    public function commit(): void
    {
        if($this->isTransactionActive()) {
            try {
                $this->entityManager->getConnection()->commit();
                $this->isTransactionActive = false;

            } catch (Exception $e) {
                $this->getLogger()?->error("EntityManager commit failed. Reason: ".$e->getMessage(), ["trace" => $e->getTraceAsString()]);
                throw new DBException("Cannot commit transaction", previous: $e);

            }

        }
    }

    public function isTransactionActive(): bool
    {
        return $this->isTransactionActive;
    }

    protected function getLogger(): ?LoggerInterface
    {
        return self::$logger;
    }

    public static function setLogger(?LoggerInterface $logger): void
    {
        self::$logger = $logger;
    }

}

<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Repositories\Exceptions\DbException;

interface RepositoryInterface
{
    public function findAll(): array;

    public function find($id);

    public function exists($id): bool;

    public function persist($object): bool;

    public function isPersisted($object): bool;

    public function hardDelete($object): bool;

    public function saveChanges(): bool;

    public function saveSingle($object): bool;

    /**
     * @throws DBException
     */
    public function beginTransaction(): void;

    /**
     * @throws DBException
     */
    public function rollback(): void;

    /**
     * @throws DBException
     */
    public function commit(): void;

    /**
     * @throws DBException
     */
    public function isTransactionActive(): bool;

}

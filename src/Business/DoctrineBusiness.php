<?php

namespace App\Business;

use Doctrine\Migrations\Finder\GlobFinder;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineBusiness
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly string                 $migrationDirectory,
    )
    {
    }

    public function isUpdate(): bool
    {
        $executedMigrations = $this->entityManager->getConnection()->executeQuery('SELECT version FROM doctrine_migration_versions')->fetchAllNumeric();
        $executedMigrations = array_map(function($columns) {
            return $columns[0];
        }, $executedMigrations);
        $finder = new GlobFinder();
        $createdMigrations = $finder->findMigrations($this->migrationDirectory);
        sort($executedMigrations);
        sort($createdMigrations);

        return $executedMigrations === $createdMigrations;
    }
}

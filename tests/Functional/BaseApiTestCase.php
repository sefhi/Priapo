<?php

declare(strict_types=1);

namespace Tests\Functional;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\Utils\Factory\DoctrinePersistence;
use Tests\Utils\Factory\PersistenceInterface;

class BaseApiTestCase extends WebTestCase
{
    private ?KernelBrowser $client;
    private EntityManagerInterface $entityManager;
    private PersistenceInterface $factoryPersistence;

    protected function setUp(): void
    {
        self::ensureKernelShutdown();

        $this->client             = self::createClient();
        $this->entityManager      = self::getContainer()->get('doctrine.orm.entity_manager');
        $this->factoryPersistence = new DoctrinePersistence($this->entityManager);

        $this->entityManager->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollback();
    }

    public function client(): KernelBrowser
    {
        return $this->client;
    }

    public function factoryPersistence(): PersistenceInterface
    {
        return $this->factoryPersistence;
    }
}

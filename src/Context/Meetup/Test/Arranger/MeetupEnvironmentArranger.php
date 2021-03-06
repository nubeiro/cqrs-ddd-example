<?php

namespace CodelyTv\Context\Meetup\Test\Arranger;

use CodelyTv\Infrastructure\Doctrine\DatabaseCleaner;
use CodelyTv\Test\Arranger\EnvironmentArranger;
use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;

final class MeetupEnvironmentArranger implements EnvironmentArranger
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function arrange()
    {
        apply(new DatabaseCleaner(), [$this->entityManager]);
    }

    public function close()
    {
    }
}

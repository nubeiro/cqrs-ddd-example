<?php

namespace CodelyTv\Tests\Infrastructure\Bus\Event;

use CodelyTv\Infrastructure\Bus\Event\DomainEvent;
use CodelyTv\Infrastructure\Bus\Event\DomainEventPublisherSync;
use CodelyTv\Test\PhpUnit\TestCase\UnitTestCase;
use Mockery\MockInterface;

final class DomainEventPublisherSyncTest extends UnitTestCase
{
    /** @var DomainEventPublisherSync */
    private $publisher;
    private $domainEvent;
    private $anotherDomainEvent;

    protected function setUp()
    {
        parent::setUp();

        $this->publisher = new DomainEventPublisherSync();
    }

    /** @test */
    public function it_should_publish_and_handle_one_event()
    {
        $this->publisher->register(get_class($this->domainEvent()), $this->subscriber());

        $this->subscriberShouldBeCalled();

        $this->publisher->publish([$this->domainEvent()]);
    }

    /** @test */
    public function it_should_be_able_to_handle_more_than_one_domain_event()
    {
        $this->publisher->register(get_class($this->domainEvent()), $this->subscriber());
        $this->publisher->register(get_class($this->anotherDomainEvent()), $this->subscriber());

        $this->subscriberShouldBeCalled();
        $this->subscriberShouldBeCalledWithTheOtherEvent();

        $this->publisher->publish([$this->domainEvent(), $this->anotherDomainEvent()]);
    }

    /** @return DomainEvent|MockInterface */
    private function domainEvent()
    {
        return $this->domainEvent = $this->domainEvent ?: $this->namedMock('CoolDomainEvent', DomainEvent::class);
    }

    /** @return DomainEvent|MockInterface */
    private function anotherDomainEvent()
    {
        return $this->anotherDomainEvent = $this->anotherDomainEvent ?: $this->namedMock('Another', DomainEvent::class);
    }

    private function subscriber()
    {
        return function ($domainEvent) {
            $domainEvent->someAttribute();
        };
    }

    private function subscriberShouldBeCalled()
    {
        $this->domainEvent()
            ->shouldReceive('someAttribute')
            ->once()
            ->withNoArgs();
    }

    private function subscriberShouldBeCalledWithTheOtherEvent()
    {
        $this->anotherDomainEvent()
            ->shouldReceive('someAttribute')
            ->once()
            ->withNoArgs();
    }
}

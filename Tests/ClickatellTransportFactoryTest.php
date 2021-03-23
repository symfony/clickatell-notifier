<?php

namespace Symfony\Component\Notifier\Bridge\Clickatell\Tests;

use Symfony\Component\Notifier\Bridge\Clickatell\ClickatellTransportFactory;
use Symfony\Component\Notifier\Test\TransportFactoryTestCase;
use Symfony\Component\Notifier\Transport\TransportFactoryInterface;

class ClickatellTransportFactoryTest extends TransportFactoryTestCase
{
    /**
     * @return ClickatellTransportFactory
     */
    public function createFactory(): TransportFactoryInterface
    {
        return new ClickatellTransportFactory();
    }

    public function createProvider(): iterable
    {
        yield [
            'clickatell://host.test?from=0611223344',
            'clickatell://authtoken@host.test?from=0611223344',
        ];
    }

    public function supportsProvider(): iterable
    {
        yield [true, 'clickatell://authtoken@default?from=0611223344'];
        yield [false, 'somethingElse://authtoken@default?from=0611223344'];
    }

    public function incompleteDsnProvider(): iterable
    {
        yield 'missing auth token' => ['clickatell://host?from=FROM'];
    }

    public function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://authtoken@default?from=FROM'];
        yield ['somethingElse://authtoken@default']; // missing "from" option
    }
}

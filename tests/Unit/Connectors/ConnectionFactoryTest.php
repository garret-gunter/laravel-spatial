<?php

namespace Tests\Unit\Connectors;

use Illuminate\Container\Container;
use Illuminate\Database\SQLiteConnection;
use LaravelSpatial\Connectors\ConnectionFactory;
use LaravelSpatial\MysqlConnection;
use LaravelSpatial\PostgresConnection;
use Mockery;
use Tests\Unit\BaseTestCase;
use Tests\Unit\Stubs\PDOStub;

/**
 * Class ConnectionFactoryBaseTest
 *
 * @package Tests\Unit\Connectors
 */
class ConnectionFactoryTest extends BaseTestCase
{
    public function testMysqlMakeCallsCreateConnection(): void
    {
        $pdo = new PDOStub();

        /** @var \Mockery\MockInterface|ConnectionFactory $factory */
        $factory = Mockery::mock(ConnectionFactory::class, [new Container()])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn = $factory->createConnection('mysql', $pdo, 'database');

        $this->assertInstanceOf(MysqlConnection::class, $conn);
    }

    public function testPostgresMakeCallsCreateConnection(): void
    {
        $pdo = new PDOStub();

        /** @var \Mockery\MockInterface|ConnectionFactory $factory */
        $factory = Mockery::mock(ConnectionFactory::class, [new Container()])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn = $factory->createConnection('pgsql', $pdo, 'database');

        $this->assertInstanceOf(PostgresConnection::class, $conn);
    }

    public function testCreateConnectionDifferentDriver(): void
    {
        $pdo = new PDOStub();

        /** @var \Mockery\MockInterface|ConnectionFactory $factory */
        $factory = Mockery::mock(ConnectionFactory::class, [new Container()])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn = $factory->createConnection('sqlite', $pdo, 'database');

        $this->assertInstanceOf(SQLiteConnection::class, $conn);
    }
}

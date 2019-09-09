<?php

namespace UnitTesting;

require_once "Session.php";

use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{

    public function testPut()
    {
        $testKey='testkey';
        $session = Session::getInstance();
        $this->assertEmpty($session->get($testKey));
        $session->put($testKey, 'value');
        $this->assertEquals('value', $session->get($testKey));
    }

    public function testGet()
    {

    }
}

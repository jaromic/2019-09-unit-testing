<?php

require_once "../Buchung.php";

use PHPUnit\Framework\TestCase;

class BuchungTest extends TestCase
{

    public function test__construct()
    {
        $buchung = new Buchung(20.0, "Briefmarken", false);
        $this->assertNotNull($buchung);
        $this->assertInstanceOf('Buchung', $buchung);
        $this->assertEquals(1, $buchung->getId());

    }
}

<?php

class Test extends PHPUnit_Framework_TestCase
{
    public function testPlugin()
    {
        $obj = new MemberCard();
    }

    public function testSpecial()
    {
        CoreLocal::set('memberUpcPrefix', '00412345');
        $p = new MemberBarcode();
        $this->assertEquals(true, $p->isSpecial('0041234500001'));
        $this->assertEquals(false, $p->isSpecial('0041999990001'));

        $this->assertInternalType('array', $p->handle('0041234500001', array()));
        SQLManager::clear();
        SQLManager::addResult(array('card_no'=>1, 0=>1));
        $this->assertInternalType('array', $p->handle('0041234500001', array()));
    }

    public function testLookup()
    {
        $l = new LookupByCard();
        $this->assertEquals(true, $l->handle_numbers());
        $this->assertEquals(false, $l->handle_text());
        $this->assertInternalType('array', $l->lookup_by_number('0041234500001'));
    }
}


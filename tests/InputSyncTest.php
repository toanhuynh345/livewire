<?php

use Livewire\Livewire;
use Livewire\LivewireComponent;
use PHPUnit\Framework\TestCase;
use Livewire\LivewireManager;

class InputSyncTest extends TestCase
{
    /** @test */
    function can_sync_data()
    {
        $this->instance->sync('modelnumber', '123abc');
        $this->assertequals('123abc', $this->instance->modelnumber);
    }

    /** @test */
    function synced_data_shows_up_as_dirty_if_changed_from_something_other_than_sync()
    {
        $this->instance->onRequest();
        $this->instance->sync('modelnumber', '123abc');
        $this->assertEmpty($this->instance->dirtySyncs());

        $this->instance->onRequest();
        $this->instance->changeModelNumber('456def');
        $this->assertContains('modelNumber', $this->instance->dirtySyncs());
    }

    public function setUp()
    {
        $this->instance = new Faucet('faucet', new \StdClass);
    }
}

class Faucet extends LivewireComponent {
    public $modelNumber;

    public function changeModelNumber($number)
    {
        $this->modelNumber = $number;
    }

    public function render()
    {
        // return View::make()
    }
}
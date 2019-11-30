<?php

namespace Tests\Unit;

use App\Type_Activity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TypeActivityTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $TypeActivity = new Type_Activity(([
            'Name_Type_Activity' => 'Перевозка'
        ]));

        $TypeActivity->save();

        $this->assertDatabaseHas($TypeActivity->getTable(), $TypeActivity->toArray());
    }
}

<?php

namespace Tests\Unit;

use App\tour;
use Tests\TestCase;
use DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $db_tours = DB::select('select * from tours where id = 1');
        $db_tour_id = ucfirst($db_tours[0]->id);
        $model_tour = tour::find(1);
        $model_tour_id = $model_tour->id;
        $this->assertEquals($db_tour_id, $model_tour_id);
    }
}

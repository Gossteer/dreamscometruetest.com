<?php

namespace Tests\Unit;

use App\Job;
use DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $job = Job::create(['Job_Title' => "Test",
            'Salary' => 100]);
        $this->assertEquals($job->Job_Title, "Test");
    }

    public function testUpdate()
    {
        Job::find(22)->update(['Job_Title' => "tseT",
            'Salary' => 1000]);
        $this->assertEquals(Job::find(22)->Job_Title, "tseT");
    }

    public function testDelete()
    {
        Job::find(22)->delete();
        $this->assertNull(Job::find(22));
    }

    public function testRoute()
    {
        $response = $this->call('GET','/');
        $response->assertStatus(200);
    }

}

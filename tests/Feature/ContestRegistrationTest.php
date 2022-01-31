<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContestRegistrationTest extends TestCase
{
    /**
     * @test
     * 
     * Test an email can be entered into the database
     *
     * @return void
     */
    public function an_email_can_be_entered_into_the_database()
    {
        $this->post('/contest', [
            'email' => 'abc@abc.com',
        ]);

        $this->assertDatabaseCount('contest_entries', 1);
    }
}

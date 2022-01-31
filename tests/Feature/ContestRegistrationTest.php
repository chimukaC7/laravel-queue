<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use App\Events\NewEntryReceivedEvent;
use Tests\TestCase;

class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();

        Event::fake([
            NewEntryReceivedEvent::class,
        ]);
    }

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

    /**
     * @test
     * 
     * Test an email is required
     *
     * @return void
     */
    public function an_email_is_required()
    {
        $this->post('/contest', [
            'email' => '',
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }

    /**
     * @test
     * 
     * Test the email address has a valid format
     *
     * @return void
     */
    public function the_email_has_a_valid_format()
    {
        $this->post('/contest', [
            'email' => 'Hello, I am not an email address!',
        ]);

        $this->assertDatabaseCount('contest_entries', 0);
    }

    /**
     * @test
     * 
     * Test an event is fired when user registers
     *
     * @return void
     */
    public function an_event_is_fired_when_user_registers()
    {
        $this->post('/contest', [
            'email' => 'abc@abc.com',
        ]);

        Event::assertDispatched(NewEntryReceivedEvent::class);
    }
}

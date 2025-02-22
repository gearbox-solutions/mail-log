<?php

namespace GearboxSolutions\MailLog\Tests\Commands;

use Carbon\Carbon;
use GearboxSolutions\MailLog\Models\MailLog;
use GearboxSolutions\MailLog\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteMailLogsCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_all_mail_logs_command()
    {
        // Create some test mail logs
        MailLog::factory()->count(5)->create();

        $this->artisan('mail-log:delete-all')
            ->expectsQuestion('Are you sure you want to delete all 5 mail logs?', 'yes')
            ->expectsOutput('5 mail log records have been deleted.')
            ->assertSuccessful();

        $this->assertDatabaseCount('mail_logs', 0);
    }

    public function test_delete_all_mail_logs_command_when_empty()
    {
        $this->artisan('mail-log:delete-all')
            ->expectsOutput('No mail logs found to delete.')
            ->assertSuccessful();
    }

    public function test_delete_all_mail_logs_command_cancellation()
    {
        $recordCount = 5;
        MailLog::factory()->count($recordCount)->create();

        $this->assertDatabaseCount('mail_logs', $recordCount);

        $this->artisan('mail-log:delete-all')
            ->expectsConfirmation("Are you sure you want to delete all {$recordCount} mail logs?", 'no')
            ->assertExitCode(0);

        $this->assertDatabaseCount('mail_logs', $recordCount);
    }

    public function test_delete_old_mail_logs_command()
    {
        // Create some old and new mail logs
        MailLog::factory()->count(3)->create([
            'sent_at' => Carbon::now()->subDays(10),
        ]);
        MailLog::factory()->count(2)->create([
            'sent_at' => Carbon::now(),
        ]);

        $this->artisan('mail-log:delete-old', ['days' => 5])
            ->expectsConfirmation('Are you sure you want to delete 3 mail logs older than 5 days?', 'yes')
            ->expectsOutput('3 mail logs have been deleted.')
            ->assertSuccessful();

        $this->assertDatabaseCount('mail_logs', 2);
    }

    public function test_delete_old_mail_logs_command_when_no_old_logs()
    {
        MailLog::factory()->count(2)->create([
            'sent_at' => Carbon::now(),
        ]);

        $this->artisan('mail-log:delete-old', ['days' => 5])
            ->expectsOutput('No mail logs found older than 5 days.')
            ->assertSuccessful();

        $this->assertDatabaseCount('mail_logs', 2);
    }

    public function test_delete_old_mail_logs_command_cancellation()
    {
        // Create some old and new mail logs
        MailLog::factory()->count(3)->create([
            'sent_at' => Carbon::now()->subDays(10),
        ]);
        MailLog::factory()->count(2)->create([
            'sent_at' => Carbon::now(),
        ]);

        $this->artisan('mail-log:delete-old', ['days' => 5])
            ->expectsQuestion('Are you sure you want to delete 3 mail logs older than 5 days?', '')
            ->expectsOutput('Operation cancelled.')
            ->assertSuccessful();

        $this->assertDatabaseCount('mail_logs', 5);
    }

    public function test_delete_old_mail_logs_with_specific_date()
    {
        // Create logs with different dates
        MailLog::factory()->count(2)->create([
            'sent_at' => Carbon::now()->subDays(15),
        ]);
        MailLog::factory()->count(3)->create([
            'sent_at' => Carbon::now()->subDays(7),
        ]);
        MailLog::factory()->count(1)->create([
            'sent_at' => Carbon::now()->subDays(1),
        ]);

        $this->artisan('mail-log:delete-old', ['days' => 10])
            ->expectsQuestion('Are you sure you want to delete 2 mail logs older than 10 days?', 'yes')
            ->expectsOutput('2 mail logs have been deleted.')
            ->assertSuccessful();

        $this->assertDatabaseCount('mail_logs', 4);
    }

    public function test_delete_old_mail_logs_with_specific_date_and_yes_flag()
    {
        // Create logs with different dates
        MailLog::factory()->count(2)->create([
            'sent_at' => Carbon::now()->subDays(15),
        ]);
        MailLog::factory()->count(3)->create([
            'sent_at' => Carbon::now()->subDays(7),
        ]);
        MailLog::factory()->count(1)->create([
            'sent_at' => Carbon::now()->subDays(1),
        ]);

        $this->artisan('mail-log:delete-old', [
            'days' => 10,
            '--yes' => true,
        ])
            ->expectsOutput('2 mail logs have been deleted.')
            ->assertSuccessful();

        $this->assertDatabaseCount('mail_logs', 4);
    }
}

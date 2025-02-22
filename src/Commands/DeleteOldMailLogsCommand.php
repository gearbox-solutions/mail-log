<?php

namespace GearboxSolutions\MailLog\Commands;

use Carbon\Carbon;
use GearboxSolutions\MailLog\Models\MailLog;
use Illuminate\Console\Command;

class DeleteOldMailLogsCommand extends Command
{
    protected $signature = 'mail-log:delete-old {days : Number of days to keep} {--yes : Skip confirmation prompt}';

    protected $description = 'Delete mail logs older than specified number of days';

    public function handle()
    {

        try {
            $skipConfirmation = $this->option('yes');
        } catch (\Throwable $th) {
            $skipConfirmation = false;
        }

        $days = (int) $this->argument('days');
        $cutoffDate = Carbon::now()->subDays($days);

        $count = MailLog::where('sent_at', '<', $cutoffDate)->count();

        if ($count === 0) {
            $this->info('No mail logs found older than '.$days.' days.');

            return;
        }

        if ($skipConfirmation || $this->confirm("Are you sure you want to delete {$count} mail logs older than {$days} days?")) {
            $deleted = MailLog::where('sent_at', '<', $cutoffDate)->delete();
            $this->info("{$deleted} mail logs have been deleted.");
        } else {
            $this->info('Operation cancelled.');
        }
    }
}

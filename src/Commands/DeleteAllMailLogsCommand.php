<?php

namespace GearboxSolutions\MailLog\Commands;

use GearboxSolutions\MailLog\Models\MailLog;
use Illuminate\Console\Command;

class DeleteAllMailLogsCommand extends Command
{
    protected $signature = 'mail-log:delete-all';

    protected $description = 'Delete all mail logs from the database';

    public function handle()
    {
        $count = MailLog::count();

        if ($count === 0) {
            $this->info('No mail logs found to delete.');

            return;
        }

        if ($this->confirm("Are you sure you want to delete all {$count} mail logs?")) {
            MailLog::truncate();
            $this->info("{$count} mail log records have been deleted.");
        } else {
            $this->info('Operation cancelled.');
        }
    }
}

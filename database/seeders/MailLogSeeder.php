<?php

namespace GearboxSolutions\MailLog\Database\Seeders;

use GearboxSolutions\MailLog\Models\MailLog;
use Illuminate\Database\Seeder;

class MailLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MailLog::factory()
            ->count(50)
            ->create();
    }
}

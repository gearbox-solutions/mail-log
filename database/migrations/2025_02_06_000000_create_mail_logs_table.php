<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mail_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('message_id')->unique()->index();
            $table->timestamp('sent_at'); // desc index below
            $table->string('from_email');
            $table->string('from_name')->nullable();
            $table->string('to_email')->index();
            $table->string('to_email_domain')->index();
            $table->string('to_name')->index()->nullable();
            $table->string('subject')->index();
            $table->text('content_html')->nullable();
            $table->text('content_text')->nullable();
            $table->text('headers')->nullable();

            $table->string('mailer')->nullable();
            $table->string('status'); // success, failed, etc
            $table->text('error_message')->nullable();

            $table->json('attachments')->nullable()->comment('Array of attachments, each with filename, mime type, and size');
        });

        // create a descending index on sent_at so we can quickly display the newest email first
        DB::statement('CREATE INDEX mail_logs_sent_at_index_desc ON mail_logs (sent_at desc)');

    }

    public function down()
    {
        Schema::dropIfExists('mail_logs');
    }
};

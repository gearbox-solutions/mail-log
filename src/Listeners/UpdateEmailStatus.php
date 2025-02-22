<?php

namespace GearboxSolutions\MailLog\Listeners;

use GearboxSolutions\MailLog\Models\MailLog;
use Illuminate\Mail\Events\MessageSent;

class UpdateEmailStatus
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $message = $event->message;
        $headers = $message->getHeaders();

        // Get Message-ID
        $messageId = $headers->get('Message-ID')?->getBodyAsString();
        if (! $messageId) {
            $messageId = $headers->get('Message-Id')?->getBodyAsString();
        }

        if (! $messageId) {
            $messageId = $headers->get('X-Mail-Log-Message-ID')->getBodyAsString();
        }

        // Remove angle brackets if present
        $messageId = trim($messageId, '<>');

        // Find the email by message_id
        $mailLog = MailLog::where('message_id', $messageId)
            ->where('status', 'pending')
            ->first();

        if ($mailLog) {
            $mailLog->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        }
    }
}

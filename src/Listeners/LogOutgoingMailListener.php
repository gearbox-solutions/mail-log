<?php

namespace GearboxSolutions\MailLog\Listeners;

use GearboxSolutions\MailLog\Models\MailLog;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Str;

class LogOutgoingMailListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(MessageSending $event)
    {
        $message = $event->message;
        $headers = $message->getHeaders();

        // Get or generate Message-ID
        $messageId = $headers->get('Message-ID')?->getBodyAsString();
        if (! $messageId) {
            $messageId = $headers->get('Message-Id')?->getBodyAsString();
        }

        // generate a new message id if none is found
        if (! $messageId) {
            $messageId = Str::uuid();

            // Store the messageId in the message instance
            $headers->addTextHeader('X-Mail-Log-Message-ID', $messageId);
        }

        // Remove angle brackets if present
        $messageId = trim($messageId, '<>');

        $from_email = $this->formatAddresses($message->getFrom());
        $to_email = $this->formatAddresses($message->getTo());
        $to_email_domain = Str::after($to_email, '@');
        $cc_email = $this->formatAddresses($message->getCc());
        $bcc_email = $this->formatAddresses($message->getBcc());
        $subject = $message->getSubject();
        $contentHtml = $message->getHtmlBody();
        $contentBody = $message->getTextBody();
        $attachments = $message->getAttachments();

        MailLog::create([
            'message_id' => $messageId,
            'from_email' => $from_email,
            'to_email' => $to_email,
            'to_email_domain' => $to_email_domain,
            'cc_email' => $cc_email,
            'bcc_email' => $bcc_email,
            'subject' => $subject,
            'content_html' => $contentHtml,
            'content_text' => $contentBody,
            'status' => 'pending',
            'sent_at' => now(),
            'attachments' => $attachments,
        ]);
    }

    /**
     * Format email addresses array into string
     */
    private function formatAddresses(?array $addresses): ?string
    {
        if (! $addresses) {
            return null;
        }

        return collect($addresses)
            ->map(function ($eachAddress, $index) {
                /** @var \Symfony\Component\Mime\Address $eachAddress */
                $name = $eachAddress->getName();
                $address = $eachAddress->getAddress();

                return $name !== '' ? "$name <$address>" : $address;
            })
            ->implode(', ');
    }
}

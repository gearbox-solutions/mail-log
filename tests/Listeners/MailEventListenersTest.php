<?php

namespace GearboxSolutions\MailLog\Tests\Listeners;

use GearboxSolutions\MailLog\Listeners\LogOutgoingMailListener;
use GearboxSolutions\MailLog\Listeners\UpdateEmailStatus;
use GearboxSolutions\MailLog\Models\MailLog;
use GearboxSolutions\MailLog\Tests\TestCase;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\SentMessage as SymfonySentMessage;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class MailEventListenersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    /** @test */
    public function it_logs_outgoing_email()
    {
        // Create a mock email message
        $email = $this->createEmail();

        $messageId = $email->getHeaders()->get('Message-ID')->getBodyAsString();
        if (! $messageId) {
            $messageId = $email->getHeaders()->get('X-Mail-Log-Message-ID')?->getBodyAsString();
        }

        $messageId = trim($messageId, '<>');
        $from_email = $email->getFrom()[0]->getAddress();
        $to_email = $email->getTo()[0]->getAddress();
        $subject = $email->getSubject();
        $body = $email->getHtmlBody();
        $text = $email->getTextBody();
        // Create MessageSending event
        $event = new MessageSending($email);

        // Create and call the listener
        $listener = new LogOutgoingMailListener;
        $listener->handle($event);

        // Assert the email was logged
        $this->assertDatabaseHas('mail_logs', [
            'message_id' => $messageId,
            'from_email' => $from_email,
            'to_email' => $to_email,
            'subject' => $subject,
            'content_html' => $body,
            'content_text' => $text,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_updates_email_status_when_sent()
    {
        $email = $this->createEmail();

        // Create a mail log entry
        $handler = new LogOutgoingMailListener;
        $handler->handle(new MessageSending($email));

        $messageId = $email->getHeaders()->get('Message-ID')->getBodyAsString();
        $messageId = trim($messageId, '<>');

        $envelope = new Envelope(new Address('sender@example.com'), [new Address('recipient@example.com')]);

        $message = new SentMessage(new SymfonySentMessage($email, $envelope));
        // Create MessageSent event with SentMessage
        $event = new MessageSent($message);

        // Create and call the listener
        $listener = new UpdateEmailStatus;
        $listener->handle($event);

        // Assert the email status was updated
        $this->assertDatabaseHas('mail_logs', [
            'message_id' => $messageId,
            'status' => 'sent',
        ]);

        // Assert sent_at was set
        $updatedMailLog = MailLog::where('message_id', $messageId)->first();
        $this->assertNotNull($updatedMailLog->sent_at);
    }

    /** @test */
    public function it_handles_missing_message_id()
    {
        // Create a mock email message without Message-ID
        $email = $this->createEmail();
        $email->getHeaders()->remove('Message-ID');
        // Create MessageSending event
        $event = new MessageSending($email);

        // Create and call the listener
        $listener = new LogOutgoingMailListener;
        $listener->handle($event);

        // get the Mail Log Message ID from the email
        $messageId = $email->getHeaders()->get('X-Mail-Log-Message-ID')->getBodyAsString();
        $messageId = trim($messageId, '<>');

        // Assert the email was logged even without message_id
        $this->assertDatabaseHas('mail_logs', [
            'message_id' => $messageId,
            'status' => 'pending',
        ]);
    }

    protected function createEmail()
    {
        $email = new Email;
        $email->from('sender@example.com')
            ->to('recipient@example.com')
            ->subject('Test Subject')
            ->text('Test Body');

        $email->getHeaders()->addHeader('Message-ID', 'test-message-id@example.com');

        return $email;
    }
}

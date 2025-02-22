<?php

namespace GearboxSolutions\MailLog\Database\Factories;

use GearboxSolutions\MailLog\Models\MailLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MailLogFactory extends Factory
{
    protected $model = MailLog::class;

    public function definition()
    {

        $attachments = [];
        for ($i = 0; $i < $this->faker->numberBetween(0, 5); $i++) {
            $attachments[] = [
                'name' => $this->faker->word.'.'.$this->faker->fileExtension(),
                'mime' => $this->faker->randomElement(['application/pdf', 'image/jpeg', 'image/png']),
                'size' => $this->faker->numberBetween(1000, 10000),
            ];
        }

        $to_email = $this->faker->email;
        $to_email_domain = Str::after($to_email, '@');

        return [
            'message_id' => $this->faker->uuid,
            'from_email' => $this->faker->email,
            'from_name' => $this->faker->name,
            'to_email' => $to_email,
            'to_email_domain' => $to_email_domain,
            'to_name' => $this->faker->name,
            'subject' => $this->faker->sentence,
            'content_html' => $this->faker->paragraph,
            'content_text' => $this->faker->paragraph,
            'headers' => $this->faker->randomElement([null, $this->faker->word]),
            'mailer' => $this->faker->randomElement([null, $this->faker->word]),
            'sent_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement(['success', 'failed']),
            'error_message' => $this->faker->randomElement([null, $this->faker->sentence]),
            'attachments' => $attachments,
        ];
    }
}

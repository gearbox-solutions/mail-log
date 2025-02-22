<?php

namespace GearboxSolutions\MailLog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $config = config('database');
        $default = $config['default'];
        $database = config('mail-log.database', $default);
        $this->setConnection($database);
    }

    protected static function newFactory()
    {
        return \GearboxSolutions\MailLog\Database\Factories\MailLogFactory::new();
    }

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'headers' => 'array',
        'body' => 'array',
        'error_message' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'attachments' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Ticket extends Model
{
    use HasFactory;

    public const PROCESSED = 1;
    public const UNPROCESSED = 0;

    public function scopeUnprocessed($query)
    {
        $query->where('status', self::UNPROCESSED);
    }

    public function scopeProcessed($query)
    {
        $query->where('status', self::PROCESSED);
    }
}

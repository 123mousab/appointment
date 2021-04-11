<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $dates = [
        'start_time',
        'finish_time',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'price',
        'comments',
        'user_id',
        'person_number',
        'transaction_number',
        'start_time',
        'finish_time',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function getStatusTextAttribute($value)
    {
        $arr = [0 => 'حجز قادم', 1 => 'حجز جاري', 2 => 'حجز منتهي'];
        return $arr[$this->status];
    }
}

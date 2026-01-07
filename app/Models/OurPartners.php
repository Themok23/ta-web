<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurPartners extends Model
{
    use HasFactory;
    protected $table = 'our_partners';

    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];
}

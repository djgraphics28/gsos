<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'workflow_id',
        'ticket_number',
        'form_data',
        'status'
    ];

    protected $casts = [
        'form_data' => 'array', // Automatically cast JSON data to array
    ];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id', 'label', 'placeholder', 'helper_text', 'type',
        'options', 'order', 'required'
    ];

    protected $casts = [
        'options' => 'array', // to handle JSON data for select/radio options
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

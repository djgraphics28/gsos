<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workflow extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the forms for the Workflow
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function forms(): HasOne
    {
        return $this->hasOne(Form::class, 'workflow_id', 'id');
    }
}

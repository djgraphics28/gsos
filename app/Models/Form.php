<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the workflow that owns the Form
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class, 'workflow_id', 'id');
    }
}

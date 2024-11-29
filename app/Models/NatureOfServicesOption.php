<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NatureOfServicesOption extends Model
{
    use HasFactory;

    protected $guared = [];

    /**
     * Get the nature_of_service that owns the NatureOfServicesOption
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceRequest()
    {
        return $this->belongsTo(NatureOfServiceRequest::class, 'nature_of_service_id');
    }

    public function serviceRequestForms()
    {
        return $this->morphTo();
    }
}

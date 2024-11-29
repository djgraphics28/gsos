<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NatureOfServiceRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the options for the NatureOfServiceRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(NatureOfServicesOption::class, 'nature_of_service_id', 'id');
    }
}

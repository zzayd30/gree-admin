<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTypeOfBusiness
 */
class TypeOfBusiness extends Model
{
    protected $table = 'type_of_business';

    public $timestamps = false; // IMPORTANT

    protected $fillable = [
        'name',
        'slug',
        'created_by',
        'created_ip',
        'created_date',
        'updated_by',
        'updated_ip',
        'updated_date',
        'deleted',
    ];
}

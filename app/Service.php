<?php

namespace App;

use App\Traits\RelationshipsTrait;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use RelationshipsTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'ip', 'port', 'is_active', 'is_main'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_main' => 'boolean'
    ];
}

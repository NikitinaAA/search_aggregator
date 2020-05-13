<?php

namespace App;

use App\Traits\RelationshipsTrait;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use RelationshipsTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'token', 'available_requests_number'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function searchRequests()
    {
        return $this->hasMany(SearchRequest::class);
    }
}

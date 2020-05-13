<?php

namespace App;

use App\Traits\RelationshipsTrait;
use Illuminate\Database\Eloquent\Model;

class SearchRequest extends Model
{
    use RelationshipsTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'search_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['is_success'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_success' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

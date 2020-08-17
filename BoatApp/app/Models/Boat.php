<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    protected $table = 'boats';

    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    public static $storeRules = [
        'name' => ['required', 'string', 'max:127'],
        'description' => ['required', 'string', 'max:511'],
    ];

    public static $updateRules = [
        'name' => ['string', 'max:127'],
        'description' => ['string', 'max:511'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

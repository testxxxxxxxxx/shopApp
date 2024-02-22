<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalDataUser extends Model
{
    use HasFactory;

    protected $table = 'personal_data_users';

    protected $fillable = [

        'name',
        'lastname',
        'street_name',
        'hause_number',
        'zip_code',
        'city',
        'country',
        'user_id',

    ];

    public function userId(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }

}

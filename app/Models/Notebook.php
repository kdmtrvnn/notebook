<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'campaign',
        'phone',
        'email',
        'date_of_birth',
        'image',
    ];
}

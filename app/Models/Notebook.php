<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notebook
 *
 * @package App\Models
 * @property $id
 * @property $surname
 * @property $name
 * @property $patronymic
 * @property $campaign
 * @property $phone
 * @property $email
 * @property $date_of_birth
 * @property $image
 */
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

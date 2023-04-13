<?php

namespace App\Http\Transformers;

use App\Models\Notebook;
use League\Fractal\TransformerAbstract;

class NotebookTransformer extends TransformerAbstract
{
    public function transform(Notebook $notebook): array
    {
        return [
            'id' => $notebook->id,
            'surname' => $notebook->surname,
            'name' => $notebook->name,
            'patronymic' => $notebook->patronymic,
            'campaign' => $notebook->campaign,
            'phone' => $notebook->phone,
            'email' => $notebook->email,
            'date_of_birth' => $notebook->date_of_birth,
            'image' => $notebook->image,
        ];
    }
}

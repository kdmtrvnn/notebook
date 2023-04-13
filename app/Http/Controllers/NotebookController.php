<?php

namespace App\Http\Controllers;

use App\Http\Transformers\NotebookTransformer;
use App\Models\Notebook;
use League\Fractal\Serializer\JsonApiSerializer;

/**
 * @OA\Info(
 *    title="Notebook Api",
 *    version="1.0.0",
 * )
 */
class NotebookController extends Controller
{
    /**
     * @OA\Get(
     *    path="/api/v1/notebooks",
     *    tags={"Notebooks"},
     *    summary="Get list of notebooks",
     *    description="Get list of notebooks",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="data",
     *                type="array",
     *                example={{
     *                  "type": "notebooks",
     *                  "id": "1",
     *                  "attributes": {
     *                      "surname": "Иванов",
     *                      "name": "Иван",
     *                      "patronymic": "Иванович",
     *                      "campaign": "Газпром",
     *                      "phone": "89600710772",
     *                      "email": "qwe@mail.ru",
     *                      "date_of_birth": "29.11.1996",
     *                      "image": "/public/images",},
     *                }, {
     *                  "type": "notebooks",
     *                  "id": "2",
     *                  "attributes": {
     *                      "surname": "Петров",
     *                      "name": "Петр",
     *                      "patronymic": "Петрович",
     *                      "campaign": "Лукойл",
     *                      "phone": "89600710772",
     *                      "email": "asd@mail.ru",
     *                      "date_of_birth": "29.11.2000",
     *                      "image": "/public/images",},
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="surname",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="patronymic",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="campaign",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="phone",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="date_of_birth",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="image",
     *                         type="string",
     *                      ),
     *          )))
     *       )
     *  )
     */

    public function get()
    {
        $notebooks = fractal()
            ->collection(Notebook::get())
            ->transformWith(new NotebookTransformer())
            ->serializeWith(new JsonApiSerializer())
            ->withResourceName('notebooks')
            ->respond()
            ->getData();

//        dd($notebooks);
        return view('notebooks.index', compact('notebooks'));
    }
}

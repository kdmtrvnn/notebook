<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Transformers\NotebookTransformer;
use App\Models\Notebook;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

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
        $notebooks = Notebook::paginate(5);
        $notebooks = fractal()
            ->collection($notebooks)
            ->transformWith(new NotebookTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($notebooks))
            ->serializeWith(new JsonApiSerializer())
            ->withResourceName('notebooks')
            ->respond()
            ->getData();

        return view('notebooks.index', compact('notebooks'));
    }

    /**
     * @OA\Get(
     *    path="/api/v1/notebooks/{id}",
     *    tags={"Notebook"},
     *    summary="Show notebook",
     *    description="Show notebook",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="data",
     *                type="object",
     *                example={
     *                  "type": "notebook",
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
     *                },
     *          )))
     *       )
     *  )
     */
    public function show($id)
    {
        $notebook = Notebook::findOrFail($id);
        $notebook = fractal()
            ->item($notebook)
            ->transformWith(new NotebookTransformer())
            ->serializeWith(new JsonApiSerializer())
            ->withResourceName('notebook')
            ->respond()
            ->getData();

        return view('notebooks.show', compact('notebook'));
    }

    public function showViewStore()
    {
        return view('notebooks.store');
    }

    /**
     * @OA\Post(
     *      path="/api/v1/notebooks",
     *      operationId="store",
     *      tags={"Notebooks/store"},
     *      summary="Store notebooks in DB",
     *      description="Store notebooks in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"surname", "name", "patronymic", "phone", "email"},
     *            @OA\Property(property="surname", type="string", format="string", example="Иванов"),
     *            @OA\Property(property="name", type="string", format="string", example="Иван"),
     *            @OA\Property(property="patronymic", type="string", format="string", example="Иванович"),
     *            @OA\Property(property="campaign", type="string", format="string", example="Лукойл"),
     *            @OA\Property(property="phone", type="string", format="string", example="89600710772"),
     *            @OA\Property(property="email", type="string", format="string", example="qwe@mail.ru"),
     *            @OA\Property(property="date_of_birth", type="string", format="string", example="29.11.1996"),
     *            @OA\Property(property="image", type="file", format="file"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=302, description="Success",
     *       )
     *  )
     */
    public function store(StoreRequest $request)
    {
        Notebook::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'image' => $request->file('image')
                ? $request->file('image')->store('image', 'public')
                : null,
            'campaign' => $request->campaign ? $request->campaign : null,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth ? $request->date_of_birth : null,
        ]);

        return redirect(route('notebooks.get'));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/notebooks/{id}",
     *     operationId="update",
     *     tags={"Notebooks/update"},
     *     summary="Update notebook in DB",
     *     description="Update notebook in DB",
     *     @OA\Parameter(name="id", in="path", description="Id of Notebook", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           required={"surname", "name", "patronymic", "phone", "email"},
     *           @OA\Property(property="surname", type="string", format="string", example="Иванов"),
     *           @OA\Property(property="name", type="string", format="string", example="Иван"),
     *           @OA\Property(property="patronymic", type="string", format="string", example="Иванович"),
     *           @OA\Property(property="campaign", type="string", format="string", example="Лукойл"),
     *           @OA\Property(property="phone", type="string", format="string", example="89600710772"),
     *           @OA\Property(property="email", type="string", format="string", example="qwe@mail.ru"),
     *           @OA\Property(property="date_of_birth", type="string", format="string", example="29.11.1996"),
     *           @OA\Property(property="image", type="file", format="file"),
     *     ),
     *     ),
     *     @OA\Response(
     *          response=302, description="Success",
     *       )
     *  )
     */
    public function update(StoreRequest $request, $id)
    {
        Notebook::where('id', $id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'image' => $request->file('image')
                ? $request->file('image')->store('image', 'public')
                : null,
            'campaign' => $request->campaign ? $request->campaign : null,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth ? $request->date_of_birth : null,
            ]);

        return redirect()->back();
    }

    /**
     * @OA\Delete(
     *    path="api/v1/notebooks/{id}",
     *    operationId="destroy",
     *    tags={"Notebooks/delete"},
     *    summary="Delete Notebook",
     *    description="Delete Notebook",
     *    @OA\Parameter(name="id", in="path", description="Id of Notebook", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=302,
     *         description="Success",
     *       )
     *      )
     *  )
     */
    public function delete($id)
    {
        $notebook = Notebook::findOrFail($id);
        $notebook->delete();

        return redirect()->back();
    }
}

<?php

namespace Tests\Feature;

use App\Models\Notebook;
use Tests\TestCase;

class UpdateNotebookTest extends TestCase
{
    protected $notebook;

    public function dataProviderSuccess() : array
    {
        return [
            'request_1' => [
                [
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
//                    'image' => 'test_name',
                ]
            ],
            'request_2' => [
                [
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ]
            ],
            'request_3' => [
                [
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                ]
            ],
        ];
    }

    /**
     * @dataProvider dataProviderSuccess
     * @param $request
     */
    public function testSuccess($request)
    {
        $this->notebook = Notebook::factory()->create();
        $notebookBeforeUpdate = Notebook::find($this->notebook->id);

        $response = $this->postJson('/api/v1/notebooks/' . $this->notebook->id, $request);
        $response->assertRedirect(session()->previousUrl());

        $notebookAfterUpdate = Notebook::find($this->notebook->id);
        self::assertNotEquals($notebookBeforeUpdate, $notebookAfterUpdate);

        foreach ($request as $key => $value) {
            self::assertEquals($notebookAfterUpdate->$key, $value);
        }
    }
}

<?php

namespace Tests\Feature;

use App\Models\Notebook;
use Tests\TestCase;

class GetNotebooksTest extends TestCase
{
    protected $notebook1;
    protected $notebook2;
    public function testSuccess()
    {
        $this->notebook1 = Notebook::factory()->create();
        $this->notebook2 = Notebook::factory()->create();

        $response = $this->getJson('/api/v1/notebooks');
        $response->assertStatus(200);

        $response->assertViewIs('notebooks.index');
        $expectedResponse = (object)[
            'data' => [
                (object)[
                    'type' => 'notebooks',
                    'id' => (string)$this->notebook1->id,
                    'attributes' => (object)[
                        'surname' => $this->notebook1->surname,
                        'name' => $this->notebook1->name,
                        'patronymic' => $this->notebook1->patronymic,
                        'campaign' => $this->notebook1->campaign,
                        'phone' => $this->notebook1->phone,
                        'email' => $this->notebook1->email,
                        'date_of_birth' => $this->notebook1->date_of_birth,
                        'image' => $this->notebook1->image,
                    ]
                ],
                (object)[
                    'type' => 'notebooks',
                    'id' => (string)$this->notebook2->id,
                    'attributes' => (object)[
                        'surname' => $this->notebook2->surname,
                        'name' => $this->notebook2->name,
                        'patronymic' => $this->notebook2->patronymic,
                        'campaign' => $this->notebook2->campaign,
                        'phone' => $this->notebook2->phone,
                        'email' => $this->notebook2->email,
                        'date_of_birth' => $this->notebook2->date_of_birth,
                        'image' => $this->notebook2->image,
                    ],
                ]
            ]
        ];
        $response->assertViewHas('notebooks', $expectedResponse);
    }
}

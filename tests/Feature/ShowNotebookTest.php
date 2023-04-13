<?php

namespace Tests\Feature;

use App\Models\Notebook;
use Tests\TestCase;

class ShowNotebookTest extends TestCase
{
    protected $notebook1;
    protected $notebook2;
    public function testSuccess()
    {
        $this->notebook1 = Notebook::factory()->create();
        $this->notebook2 = Notebook::factory()->create();

        $response = $this->getJson('/api/v1/notebooks/' . $this->notebook2->id);
        $response->assertStatus(200);

        $response->assertViewIs('notebooks.show');
        $expectedResponse = (object)[
            'data' =>
                (object)[
                    'type' => 'notebook',
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
                    ]
                ]
        ];
        $response->assertViewHas('notebook', $expectedResponse);
    }

    public function testError()
    {
        $this->notebook1 = Notebook::factory()->create();
        $this->notebook2 = Notebook::factory()->create();

        $response = $this->getJson('/api/v1/notebooks/' . 12345678);
        $response->assertStatus(404);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Notebook;
use Tests\TestCase;

class DeleteNotebookTest extends TestCase
{
    protected $notebook1;
    protected $notebook2;
    public function testSuccess()
    {
        $this->notebook1 = Notebook::factory()->create();
        $this->notebook2 = Notebook::factory()->create();
        self::assertTrue(Notebook::where('id', $this->notebook2->id)->exists());
        self::assertTrue(Notebook::where('id', $this->notebook2->id)->exists());

        $response = $this->deleteJson('/api/v1/notebooks/' . $this->notebook2->id);

        $response->assertRedirect(session()->previousUrl());
        self::assertTrue(Notebook::where('id', $this->notebook1->id)->exists());
        self::assertFalse(Notebook::where('id', $this->notebook2->id)->exists());
    }

    public function testError()
    {
        $this->notebook1 = Notebook::factory()->create();
        $this->notebook2 = Notebook::factory()->create();

        $response = $this->deleteJson('/api/v1/notebooks/' . 12345678);
        $response->assertStatus(404);
    }
}

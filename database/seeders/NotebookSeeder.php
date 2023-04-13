<?php

namespace Database\Seeders;

use App\Models\Notebook;
use Illuminate\Database\Seeder;

class NotebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notebooks = Notebook::exists();
        if (!$notebooks) {
            Notebook::factory(3)->create();
          }
    }
}

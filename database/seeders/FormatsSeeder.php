<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Seeder;

class FormatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Format::factory()->createMany([
            ['format' => 'WAV'], 
            ['format' => 'MP3 (320kbps)'],
            ['format' => 'CD']
        ]);         
    }
}

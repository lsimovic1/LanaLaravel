<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Art;
use App\Models\Artist;
use App\Models\Form;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Art::truncate();
        Artist::truncate();
        Form::truncate();

        User::factory(2)->create();

        $artist1 = Artist::factory()->create();
        $artist2 = Artist::factory()->create();
        $artist3 = Artist::factory()->create();
        $artist4 = Artist::factory()->create();
        $artist5 = Artist::factory()->create();

        $form1 = Form::factory()->create();
        $form2 = Form::factory()->create();
        $form3 = Form::factory()->create();

        Art::factory(5)->create([
            'artist_id' => $artist1->id,
            'form_id' => $form1->id,
        ]);
        Art::factory(4)->create([
            'artist_id' => $artist2->id,
            'form_id' => $form1->id,
        ]);
        Art::factory(7)->create([
            'artist_id' => $artist3->id,
            'form_id' => $form2->id,
        ]);
        Art::factory(2)->create([
            'artist_id' => $artist4->id,
            'form_id' => $form3->id,
        ]);
        Art::factory(1)->create([
            'artist_id' => $artist5->id,
            'form_id' => $form3->id,
        ]);
    }
}

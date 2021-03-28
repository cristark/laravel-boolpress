<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $newTag = new Tag;
            $newTag->name = $faker->words(3, true);
            $slug = Str::slug($newTag->name);
            $slugBase = $slug;

            $tagPresente = Tag::where('slug', $slug)->first();
            $contatore = 1;

            while ($tagPresente) {
                $slug = $slugBase . '-' . $contatore;
                $contatore++;
                $tagPresente = Tag::where('slug', $slug)->first();
            }

            $newTag->slug = $slug;
            $newTag->save();
        }
    }
}

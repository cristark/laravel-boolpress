<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Post;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++){
            $newPost = new Post();
            $newPost->title = $faker->sentence(4);
            $newPost->content = $faker->text(500);

            $userCount = Count(User::all()->toArray());
            $newPost->user_id = rand(1, $userCount);
            
            // salvo lo slug in una variabile
            $slug = Str::slug($newPost->title);

            // Conservo slug iniziale in una var così da non farlo cambiare in caso di ripetizioni
            $slugIniziale = $slug;

            // controllo se lo slug è presente
            $postPresente = Post::where('slug', $slug)->first();

            // Contatore per aggiunta numero a slug ripetuto
            $contatore = 1;

            // Ciclo per aggiungere num e incrementare contatore per eventuali ripetizioni successive
            while ($postPresente) {
                $slug = $slugIniziale . '-' .$contatore;
                $postPresente = Post::where('slug', $slug)->first();
                $contatore++;
            }

            // Aggiungo slug creato nel ciclo sopra in tabella 
            $newPost->slug = $slug;
            
            $newPost->save();
        }
    }
}

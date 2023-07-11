<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //sets dummy rows for users, 
        //posts and follows
        $this->loremUsers();
        $this->loremPosts();
        $this->loremFollows();
    }
    private function loremFollows(): void
    {
        DB::table('follows')->insert([
            'user_id' => 2,
            'followeduser' => 7
        ]);
        DB::table('follows')->insert([
            'user_id' => 3,
            'followeduser' => 7
        ]);
        DB::table('follows')->insert([
            'user_id' => 3,
            'followeduser' => 2
        ]);
        DB::table('follows')->insert([
            'user_id' => 5,
            'followeduser' => 2
        ]);
        DB::table('follows')->insert([
            'user_id' => 4,
            'followeduser' => 3
        ]);
        DB::table('follows')->insert([
            'user_id' => 5,
            'followeduser' => 3
        ]);
        DB::table('follows')->insert([
            'user_id' => 5,
            'followeduser' => 4
        ]);
        DB::table('follows')->insert([
            'user_id' => 6,
            'followeduser' => 4
        ]);
        DB::table('follows')->insert([
            'user_id' => 6,
            'followeduser' => 5
        ]);
        DB::table('follows')->insert([
            'user_id' => 7,
            'followeduser' => 6
        ]);
        DB::table('follows')->insert([
            'user_id' => 1,
            'followeduser' => 2
        ]);
        DB::table('follows')->insert([
            'user_id' => 1,
            'followeduser' => 3
        ]);
        DB::table('follows')->insert([
            'user_id' => 1,
            'followeduser' => 4
        ]);
        DB::table('follows')->insert([
            'user_id' => 1,
            'followeduser' => 5
        ]);
        DB::table('follows')->insert([
            'user_id' => 1,
            'followeduser' => 6
        ]);
        DB::table('follows')->insert([
            'user_id' => 1,
            'followeduser' => 7
        ]);
    }
    private function loremPosts(): void 
    {

        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Thrilling Suspense: A Must-Watch Movie!',
            'body' => 'Just watched an amazing thriller movie! The suspense had me at the edge of my seat. #MovieReview',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Feel-Good Delight: Rom-Coms Forever!',
            'body' => 'Can\'t get enough of rom-coms! They always put a smile on my face. #FeelGoodMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Mind-Blowing Action: An Epic Adventure!',
            'body' => 'Finally caught up on the latest action flick. The special effects were mind-blowing! #ActionMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Laugh Out Loud: Comedy Movie Marathon!',
            'body' => 'Movie night with friends! We laughed so hard during the comedy film. #MovieMarathon',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Captivating Era: Journey into the Past',
            'body' => 'I\'m a huge fan of period dramas. The costumes and set designs are so beautiful. #PeriodFilms',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Intriguing Mystery: A Twisty Tale',
            'body' => 'Intriguing mystery movie! The plot twists kept me guessing till the very end. #MysteryMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'title' => 'Sci-Fi Spectacle: A Galactic Adventure',
            'body' => 'Sci-fi movies are my jam! Can\'t wait for the next installment of my favorite franchise. #SciFiFan',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'title' => '',
            'body' => '',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'title' => 'Knowledge Unveiled: Eye-Opening Documentaries',
            'body' => 'Documentaries are a great way to learn about different cultures and important topics. #KnowledgeIsPower',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'title' => 'Heartfelt Drama: Reflections on Life',
            'body' => 'Caught a heartfelt drama last night. It left me reflecting on life and relationships. #ThoughtProvoking',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'title' => 'Classic Charm: Timeless Movie Magic',
            'body' => 'Old classics never get old! Rewatched a black and white film that still holds its charm. #ClassicMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'title' => 'Mind-Bending Thrills: A Psychological Rollercoaster',
            'body' => 'Just saw a mind-bending psychological thriller. My mind is still reeling from the plot twists. #MindBlown',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 4,
            'title' => 'Romantic Escapades: Love and Laughter',
            'body' => 'Romantic movies are my guilty pleasure. Sometimes you just need a good love story. #RomanceMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 4,
            'title' => 'Cozy Nights: Movie Magic at Home',
            'body' => 'Movie night at home with a cozy blanket and a bowl of popcorn. Perfect way to unwind. #MovieNight',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 4,
            'title' => 'Hilarious Laughter: Comedy Gold',
            'body' => 'Hilarious comedy movie! Laughed so hard, my cheeks still hurt. #ComedyMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 5,
            'title' => 'Courtroom Drama: Legal Battles Unfold',
            'body' => 'Movie recommendation: A gripping courtroom drama that will keep you on the edge of your seat. #CourtroomDrama',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 6,
            'title' => 'War Drama: Courage and Sacrifice',
            'body' => 'Caught an intense war drama. It showcased the bravery and sacrifices of soldiers. #WarMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 6,
            'title' => 'Nostalgic Vibes: Revisiting Childhood Favorites',
            'body' => 'Movie night with friends! We decided to revisit our favorite childhood movies. #Nostalgia',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 6,
            'title' => 'Inspiring Lives: Biographical Brilliance',
            'body' => 'Just saw an inspiring biographical film. It\'s amazing to witness true stories come to life. #BiographyMovies',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 6,
            'title' => 'Cheesy Romance: Love and Laughter',
            'body' => 'Indulged in a guilty pleasure: a cheesy romantic comedy. Sometimes you need a bit of cheese. #RomCom',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 7,
            'title' => 'Marvel Mania: Superhero Extravaganza',
            'body' => 'Marvel movies are my obsession! Can\'t wait for the next installment in the MCU. #MarvelFan',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 7,
            'title' => 'Sci-Fi Addiction: Exploring New Worlds',
            'body' => 'Caught an eye-opening documentary. It shed light on an important environmental issue. #Awareness',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 7,
            'title' => 'Movie Date Night: Love and Cinema',
            'body' => 'Movie marathon night with my significant other. Cuddles, snacks, and great films! #DateNight',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 7,
            'title' => 'Thrilling Sci-Fi: Mind-Bending Adventures',
            'body' => 'Sci-fi thrillers are my favorite genre. They combine the best of both worlds. #SciFiThriller',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 7,
            'title' => 'Time Travel Wonders: Temporal Twists',
            'body' => 'Just watched a mind-bending time travel movie. It had me questioning the concept of reality. #TimeTravel',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('posts')->insert([
            'user_id' => 7,
            'title' => 'Legal Intrigue: Justice Unraveled',
            'body' => 'Movie recommendation: A mind-bending science fiction film that will make you question reality. #SciFi',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        
    }
    private function loremUsers(): void 
    {
        
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'Santiago Morales',
            'email' => 'santiago.morales@example.com',
            'password' => Hash::make('kronoskronos'),
            'isAdmin' => 1
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'James Anderson',
            'email' => 'james.anderson@example.com',
            'password' => Hash::make('kronoskronos')
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'username' => 'Sarah Thompson',
            'email' => 'sarah.thompson@example.com',
            'password' => Hash::make('kronoskronos')
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'username' => 'Benjamin Mitchell',
            'email' => 'benjamin.mitchell@example.com',
            'password' => Hash::make('kronoskronos')
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'username' => 'Olivia Davis',
            'email' => 'olivia.davis@example.com',
            'password' => Hash::make('kronoskronos')
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'username' => 'Ethan Wilson',
            'email' => 'ethan.wilson@example.com',
            'password' => Hash::make('kronoskronos')
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'username' => 'Emily Johnson',
            'email' => 'emily.johnson@example.com',
            'password' => Hash::make('kronoskronos')
        ]);
    }
}

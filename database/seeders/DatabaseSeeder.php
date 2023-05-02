<?php


namespace Database\Seeders;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        
        Author::truncate();
        Genre::truncate();
        Book::truncate();
        
        /*$g1 = Genre::create(['name'=>'fantasy']);
        $g2 = Genre::create(['name'=>'thriller']);
        $g3 = Genre::create(['name'=>'romance']);*/

        $g1 = Genre::create(['genrename'=>'fantasy']);
        $g2 = Genre::create(['genrename'=>'thriller']);
        $g3 = Genre::create(['genrename'=>'romance']);
       
        $a1 = Author::create(['name'=>'J.K.Rowling']);
        $a2 = Author::create(['name'=>'Agatha Christie']);
        $a3 = Author::create(['name'=>'Jane Austen']);
        $a4 = Author::create(['name'=>'F Scott Fitzgerald']);
        
        $b1 = Book::create([
            'name'=>'Harry Potter and the Prisoner of Azkaban',
            'author_id'=>$a1->id,
            'genre_id'=>$g1->id,
            'description'=>'Its Harrys third school year Hogwarts where he and his friends Ron and Hermione investigate the case od Serius Black.',
            'user_id'=>1,
            'year'=>'1999'
        ]);
        $b2 = Book::create([
            'name'=>'Harry Potter and the Order od Phoenix',
            'author_id'=>$a1->id,
            'genre_id'=>$g1->id,
            'description'=>'Harry struggles through his fifth year at Hogwarts,including the return of Voldemort and new character Umbrige.',
            'user_id'=>1,
            'year'=>'2003'
        ]);
        $b3 = Book::create([
            'name'=>'Murder on the Orient Express',
            'author_id'=>$a2->id,
            'genre_id'=>$g2->id,
            'description'=>'An American tycoon lies dead in his compartment, stabbed a dozen times, his door locked from the inside.',
            'user_id'=>1,
            'year'=>'1934'
        ]);
        $b4 = Book::create([
            'name'=>'Pride and Prejudice',
            'author_id'=>$a3->id,
            'genre_id'=>$g3->id,
            'description'=>'Turbulent relationship between Elizabeth Bennet, the daughter of a country gentleman, and Fitzwilliam Darcy, a rich aristocratic landowner.',
            'user_id'=>1,
            'year'=>'2017'
        ]);
        
    }
}

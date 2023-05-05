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
        User::factory(3)->create();
        
        Author::truncate();
        Genre::truncate();
        Book::truncate();
        
        /*$g1 = Genre::create(['name'=>'fantasy']);
        $g2 = Genre::create(['name'=>'thriller']);
        $g3 = Genre::create(['name'=>'romance']);*/

        $g1 = Genre::create(['genrename'=>'fantasy','user_id'=>2]);
        $g2 = Genre::create(['genrename'=>'thriller','user_id'=>3]);
        $g3 = Genre::create(['genrename'=>'romance','user_id'=>1]);
       
        $a1 = Author::create(['authorname'=>'J.K.Rowling','user_id'=>1]);
        $a2 = Author::create(['authorname'=>'Agatha Christie','user_id'=>1]);
        $a3 = Author::create(['authorname'=>'Jane Austen','user_id'=>3]);
        $a4 = Author::create(['authorname'=>'F Scott Fitzgerald','user_id'=>2]);
        
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
            'user_id'=>2,
            'year'=>'1934'
        ]);
        $b4 = Book::create([
            'name'=>'Pride and Prejudice',
            'author_id'=>$a3->id,
            'genre_id'=>$g3->id,
            'description'=>'Turbulent relationship between Elizabeth Bennet, the daughter of a country gentleman, and Fitzwilliam Darcy, a rich aristocratic landowner.',
            'user_id'=>3,
            'year'=>'2017'
        ]);
        $b5 = Book::create([
            'name'=>'The Great Gatsby',
            'author_id'=>$a4->id,
            'genre_id'=>$g3->id,
            'description'=>'Set in Jazz Age New York, the novel tells the tragic story of Jay Gatsby, a self-made millionaire, and his pursuit of Daisy Buchanan.',
            'user_id'=>2,
            'year'=>'1925'
        ]);
        $b6 = Book::create([
            'name'=>'Death on the Nile',
            'author_id'=>$a2->id,
            'genre_id'=>$g2->id,
            'description'=>'In World War I, the young Hercule Poirot devises a strategy to help the Allied forces reclaim land against the Central Powers.',
            'user_id'=>3,
            'year'=>'2017'
        ]);
        $b7 = Book::create([
            'name'=>'Harry Potter and the Philosophers Stone',
            'author_id'=>$a1->id,
            'genre_id'=>$g1->id,
            'description'=>'It is a story about Harry Potter, an orphan brought up by his aunt and uncle because his parents were killed when he was a baby.',
            'user_id'=>3,
            'year'=>'2017'
        ]);
        
    }
}

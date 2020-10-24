<?php

use App\Address;
use App\Category;
use App\Image;
use App\Product;
use App\Review;
use App\Role;
use App\User;
use App\Tag;
use App\Ticket;
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
        // $this->call(UsersTableSeeder::class);
       // factory(Address::class,1000)->create();
       // factory(User::class,500)->create();
        //factory(Product::class,1500)->create();
        //factory(Image::class,1000)->create();
       factory(Review::class,3500)->create();
        //factory(Category::class,50)->create();
        //factory(Tag::class,150)->create();
         //factory(Role::class,5)->create();
         //factory(Ticket::class,7)->create();
    }
}

<?php

use App\Tag;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user1 = User::create([
            'name' => 'muhammed mohsen',
            'email' => 'muhammed@mohsen.com',
            'password' => Hash::make('muhammed'),
        ]);

        $user2 = User::create([
            'name' => 'muhammed mohsen 2',
            'email' => 'muhammed 2@mohsen.com',
            'password' => Hash::make('muhammed2'),
            ]);

        $user3 = User::create([
            'name' => 'muhammed mohsen 3',
            'email' => 'muhammed 3@mohsen.com',
            'password' => Hash::make('muhammed 3'),
        ]);

       $category1 = Category::create([
           'name'=>'partrnisheip',
       ]);
        $category2 = Category::create([
            'name' => 'markiting',
        ]);
        $category3 = Category::create([
            'name' => 'salle ala alhabeeb',
        ]);

        $post1 = Post::create([

            'title'=>'hello every body',
            'description'=>'loremProident laborum laboris sunt minim sit dolore adipisicing anim veniam non id sunt.',
            'content'=>'Cupidatat adipisicing pariatur ipsum laborum minim reprehenderit voluptate nostrud magna aliqua cillum id irure. Adipisicing ea dolore laborum culpa aliqua laborum nulla enim nulla veniam officia ea. Elit voluptate dolor incididunt veniam officia officia ex sit veniam id ad voluptate. Deserunt aliquip minim commodo consequat aliquip do aute aliquip magna ad sint. Ut id sint sint cupidatat ut quis et in consectetur officia exercitation do. Proident deserunt ea sit veniam duis dolore laborum occaecat consectetur aute esse qui fugiat.',
            'category_id'=>$category1->id ,
            'image'=>'posts/1.jpg',
            'user_id'=>$user1->id,
        ]);
        $post2 =$user2->posts()->create([

            'title'=>'hello every body',
            'description'=>'loremProident laborum laboris sunt minim sit dolore adipisicing anim veniam non id sunt.',
            'content'=>'Cupidatat adipisicing pariatur ipsum laborum minim reprehenderit voluptate nostrud magna aliqua cillum id irure. Adipisicing ea dolore laborum culpa aliqua laborum nulla enim nulla veniam officia ea. Elit voluptate dolor incididunt veniam officia officia ex sit veniam id ad voluptate. Deserunt aliquip minim commodo consequat aliquip do aute aliquip magna ad sint. Ut id sint sint cupidatat ut quis et in consectetur officia exercitation do. Proident deserunt ea sit veniam duis dolore laborum occaecat consectetur aute esse qui fugiat.',
            'category_id'=>$category2->id ,
            'image' => 'posts/2.jpg',
            ]);
        $post3 =$user3->posts()->create([

            'title'=>'hello every body',
            'description'=>'loremProident laborum laboris sunt minim sit dolore adipisicing anim veniam non id sunt.',
            'content'=>'Cupidatat adipisicing pariatur ipsum laborum minim reprehenderit voluptate nostrud magna aliqua cillum id irure. Adipisicing ea dolore laborum culpa aliqua laborum nulla enim nulla veniam officia ea. Elit voluptate dolor incididunt veniam officia officia ex sit veniam id ad voluptate. Deserunt aliquip minim commodo consequat aliquip do aute aliquip magna ad sint. Ut id sint sint cupidatat ut quis et in consectetur officia exercitation do. Proident deserunt ea sit veniam duis dolore laborum occaecat consectetur aute esse qui fugiat.',
            'category_id'=>$category2->id ,
            'image' => 'posts/3.jpg',
            ]);
        $tag1 = Tag::create([
            'name' => 'job',
        ]);
        $tag2 = Tag::create([
            'name' => 'customer ',
        ]);
        $tag3 = Tag::create([
            'name' => 'record ',
        ]);
        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag1->id,$tag3->id]);
        $post2->tags()->attach([$tag3->id,$tag2->id]);
    }
}

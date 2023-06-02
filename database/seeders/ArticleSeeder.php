<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = \Faker\Factory::create();
        
        Article::create(['name' => 'bestido_babies','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 3]);
        Article::create(['name' => 'boots_babies','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 3]);
        Article::create(['name' => 'coat_babies','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 3]);
        
        Article::create(['name' => 'bermuda_boys','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 2]);
        Article::create(['name' => 'coat_boys','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 2]);
        Article::create(['name' => 'gloved_boys','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 2]);
        
        Article::create(['name' => 'bermuda_girls','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 1]);
        Article::create(['name' => 'bestido_girls','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 1]);
        Article::create(['name' => 'blouse_girls','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 1]);
                
        Article::create(['name' => 'baby_basket','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 4]);
        Article::create(['name' => 'baby_pillow','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 4]);
        Article::create(['name' => 'baby_rate','price' =>  mt_rand(1,100).'.'.mt_rand(1,99),'availability' => mt_rand(1,100),'description' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,255),'tags' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'add_information' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),0,50),'star_rating' => mt_rand(1,5),'sku' => (integer)Str::random(10).(string)date('YmdHis'),'categorie_id' => 4]);
                


        //'name','price','availability','description','tags','add_information','sku','categorie_id'

        
    }
}

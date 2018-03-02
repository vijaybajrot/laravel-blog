<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\DB::table('pages')->truncate();
    	$faker = \Faker\Factory::create();
         for ($i=0; $i < 10; $i++) { 
        	$page =  new \App\Page;
        	$page->title = $faker->sentence(rand(5,10),true);
        	$page->slug = $faker->slug();
        	$page->content = $faker->paragraphs(rand(15,25),true);
        	$page->save();
         }
    }
}

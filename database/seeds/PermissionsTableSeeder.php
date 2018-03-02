<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("permissions")->truncate();
        $premissions = [
    	//posts
    	["name" => "add-post","lable"=> "Add Post","group"=>"posts"],
    	["name"=>"edit-post","lable"=>"Edit Post","group"=>"posts"],
    	["name"=>"view-post","lable"=>"View Post","group"=>"posts"],
    	["name"=>"delete-post","lable"=>"Delete Post","group"=>"posts"],
    	//pages
    	["name"=>"add-page","lable"=>"Add Page","group"=>"pages"],
    	["name"=>"edit-page","lable"=>"Edit Page","group"=>"pages"],
    	["name"=>"view-page","lable"=>"View Page","group"=>"pages"],
    	["name"=>"delete-page","lable"=>"Delete Page","group"=>"pages"],
    	//categories
    	["name"=>"add-category","lable"=>"Add Category","group"=>"categories"],
    	["name"=>"edit-category","lable"=>"Edit Category","group"=>"categories"],
    	["name"=>"view-category","lable"=>"View Category","group"=>"categories"],
    	["name"=>"delete-category","lable"=>"Delete Category","group"=>"categories"],

        ];

        (new \App\Permission)->insert($premissions);
    }
}

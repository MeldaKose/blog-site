<?php

namespace Database\Seeders;

use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'image'=>'https://access2eic.eu/wp-content/uploads/2020/09/ma4rket.jpg',
                'content'=>Lorem::paragraph(9),
                'slug'=>str::slug($page),
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
    }

    }
}

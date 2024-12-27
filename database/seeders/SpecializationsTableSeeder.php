<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'Arabic Language', 'ar'=> 'اللغة العربية'],
            ['en'=> 'English Language', 'ar'=> 'اللغة الإنجليزية'],
            ['en'=> 'Science', 'ar'=> 'علوم'],
            ['en'=> 'Computer Science', 'ar'=> 'الحاسوب'],
            ['en'=> 'Mathematics', 'ar'=> 'رياضيات'],
            ['en'=> 'Physics', 'ar'=> 'فيزياء'],
            ['en'=> 'Chemistry', 'ar'=> 'كيمياء'],
            ['en'=> 'Biology', 'ar'=> 'أحياء'],
            ['en'=> 'Social Studies', 'ar'=> 'الدراسات الاجتماعية'],
            ['en'=> 'Geography', 'ar'=> 'جغرافيا'],
            ['en'=> 'History', 'ar'=> 'تاريخ'],
            ['en'=> 'Islamic Studies', 'ar'=> 'التربية الإسلامية'],
            ['en'=> 'Art', 'ar'=> 'الفنون'],
            ['en'=> 'Physical Education', 'ar'=> 'التربية البدنية'],
            ['en'=> 'Art', 'ar'=> 'الفنون'],
            ['en'=> 'Music', 'ar'=> 'الموسيقى'],
            ['en'=> 'French Language', 'ar'=> 'اللغة الفرنسية'],
            ['en'=> 'German Language', 'ar'=> 'اللغة الألمانية'],
            ['en'=> 'Home Economics', 'ar'=> 'الاقتصاد المنزلي'],
            ['en'=> 'Design and Technology', 'ar'=> 'التصميم والتكنولوجيا'],

        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }
}
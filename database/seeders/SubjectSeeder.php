<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public $subjects    = array('Science', 'Math', 'English', 'Social', 'Nepali', 'Health and Population', 'Computer', 'Account');

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->subjects as $subject)
        {
            Subject::create([
                'name' => $subject,
                'code'  => mt_rand(1,20)
            ]);
        }
    }
}

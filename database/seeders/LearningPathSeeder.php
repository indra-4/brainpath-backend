<?php

namespace Database\Seeders;

use App\Models\LearningPath;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LearningPathSeeder extends Seeder
{
    public function run(): void
    {
        $paths = [
            [
                'name'        => 'Web Development',
                'slug'        => 'web-development',
                'description' => 'Master front-end and back-end web technologies including HTML, CSS, JavaScript, Laravel, and Vue.js to build modern web applications.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Data Science',
                'slug'        => 'data-science',
                'description' => 'Learn data analysis, machine learning, and AI concepts using Python, Pandas, Scikit-Learn, and TensorFlow.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Cybersecurity',
                'slug'        => 'cybersecurity',
                'description' => 'Understand the fundamentals of network security, ethical hacking, penetration testing, and secure software development.',
                'is_active'   => true,
            ],
        ];

        foreach ($paths as $path) {
            LearningPath::updateOrCreate(['slug' => $path['slug']], $path);
        }
    }
}

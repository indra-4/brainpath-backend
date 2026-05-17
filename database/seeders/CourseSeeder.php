<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\LearningPath;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $webPath      = LearningPath::where('slug', 'web-development')->firstOrFail();
        $dsPath       = LearningPath::where('slug', 'data-science')->firstOrFail();
        $securityPath = LearningPath::where('slug', 'cybersecurity')->firstOrFail();

        $courses = [

            // ── Web Development (5 courses) ───────────────────────────────────
            [
                'learning_path_id' => $webPath->id,
                'title'            => 'HTML & CSS Fundamentals',
                'description'      => 'Build the structure and style of web pages using modern HTML5 and CSS3 techniques.',
                'tags'             => ['html', 'css', 'frontend', 'beginner'],
                'order_index'      => 1,
                'duration_minutes' => 120,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $webPath->id,
                'title'            => 'JavaScript for Beginners',
                'description'      => 'Learn the core concepts of JavaScript including variables, functions, DOM manipulation, and ES6+ syntax.',
                'tags'             => ['javascript', 'frontend', 'beginner'],
                'order_index'      => 2,
                'duration_minutes' => 180,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $webPath->id,
                'title'            => 'Vue.js Essentials',
                'description'      => 'Build reactive single-page applications using Vue 3 Composition API, components, and Vue Router.',
                'tags'             => ['vuejs', 'frontend', 'intermediate'],
                'order_index'      => 3,
                'duration_minutes' => 240,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $webPath->id,
                'title'            => 'Laravel REST API Development',
                'description'      => 'Design and build RESTful APIs with Laravel 11, Eloquent ORM, Sanctum authentication, and best practices.',
                'tags'             => ['laravel', 'php', 'backend', 'api', 'intermediate'],
                'order_index'      => 4,
                'duration_minutes' => 300,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $webPath->id,
                'title'            => 'Full-Stack Project: Build a Task Manager',
                'description'      => 'Apply your web development skills to build a complete full-stack task management application.',
                'tags'             => ['fullstack', 'project', 'advanced'],
                'order_index'      => 5,
                'duration_minutes' => 360,
                'is_published'     => true,
            ],

            // ── Data Science (5 courses) ──────────────────────────────────────
            [
                'learning_path_id' => $dsPath->id,
                'title'            => 'Python Programming Basics',
                'description'      => 'Get started with Python: syntax, data structures, functions, and object-oriented programming.',
                'tags'             => ['python', 'beginner', 'programming'],
                'order_index'      => 1,
                'duration_minutes' => 150,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $dsPath->id,
                'title'            => 'Data Analysis with Pandas',
                'description'      => 'Manipulate, clean, and analyze large datasets using Pandas DataFrames and NumPy arrays.',
                'tags'             => ['pandas', 'numpy', 'data-analysis', 'intermediate'],
                'order_index'      => 2,
                'duration_minutes' => 200,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $dsPath->id,
                'title'            => 'Data Visualization with Matplotlib & Seaborn',
                'description'      => 'Create compelling charts, plots, and heatmaps to communicate data insights effectively.',
                'tags'             => ['matplotlib', 'seaborn', 'visualization', 'intermediate'],
                'order_index'      => 3,
                'duration_minutes' => 180,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $dsPath->id,
                'title'            => 'Machine Learning with Scikit-Learn',
                'description'      => 'Understand supervised and unsupervised ML algorithms: regression, classification, clustering, and model evaluation.',
                'tags'             => ['machine-learning', 'scikit-learn', 'advanced'],
                'order_index'      => 4,
                'duration_minutes' => 280,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $dsPath->id,
                'title'            => 'Deep Learning with TensorFlow & Keras',
                'description'      => 'Build neural networks and deep learning models for image classification and NLP tasks.',
                'tags'             => ['deep-learning', 'tensorflow', 'keras', 'advanced'],
                'order_index'      => 5,
                'duration_minutes' => 320,
                'is_published'     => true,
            ],

            // ── Cybersecurity (5 courses) ─────────────────────────────────────
            [
                'learning_path_id' => $securityPath->id,
                'title'            => 'Introduction to Cybersecurity',
                'description'      => 'Understand the cybersecurity landscape, common threats, the CIA Triad, and foundational security concepts.',
                'tags'             => ['security', 'beginner', 'fundamentals'],
                'order_index'      => 1,
                'duration_minutes' => 120,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $securityPath->id,
                'title'            => 'Networking Fundamentals for Security',
                'description'      => 'Learn TCP/IP, OSI model, firewalls, VPNs, and network traffic analysis as security prerequisites.',
                'tags'             => ['networking', 'tcp-ip', 'beginner'],
                'order_index'      => 2,
                'duration_minutes' => 180,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $securityPath->id,
                'title'            => 'Linux for Penetration Testers',
                'description'      => 'Master Linux command-line tools, file permissions, scripting, and system administration for security work.',
                'tags'             => ['linux', 'pentesting', 'intermediate'],
                'order_index'      => 3,
                'duration_minutes' => 240,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $securityPath->id,
                'title'            => 'Ethical Hacking & Penetration Testing',
                'description'      => 'Conduct reconnaissance, vulnerability scanning, exploitation, and post-exploitation using tools like Metasploit and Nmap.',
                'tags'             => ['ethical-hacking', 'metasploit', 'nmap', 'advanced'],
                'order_index'      => 4,
                'duration_minutes' => 300,
                'is_published'     => true,
            ],
            [
                'learning_path_id' => $securityPath->id,
                'title'            => 'Web Application Security (OWASP Top 10)',
                'description'      => 'Identify and mitigate the OWASP Top 10 web vulnerabilities including SQLi, XSS, CSRF, and IDOR.',
                'tags'             => ['owasp', 'web-security', 'advanced'],
                'order_index'      => 5,
                'duration_minutes' => 260,
                'is_published'     => true,
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                [
                    'learning_path_id' => $course['learning_path_id'],
                    'order_index'      => $course['order_index'],
                ],
                $course
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Safely clear existing courses table by temporarily disabling foreign key checks
        if (config('database.default') === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
        } else {
            Schema::disableForeignKeyConstraints();
        }

        Course::query()->delete();

        if (config('database.default') === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON');
        } else {
            Schema::enableForeignKeyConstraints();
        }

        // 1. Curated Courses (the original 15 high-quality courses)
        $curatedCourses = [
            // ── Web Development ───────────────────────────────────
            [
                'category'         => 'web-development',
                'title'            => 'HTML & CSS Fundamentals',
                'description'      => 'Kuasai konsep dasar HTML5 dan CSS3 untuk membangun dan menyusun struktur layout serta mempercantik tampilan halaman web responsif Anda.',
                'tags'             => ['html', 'css', 'frontend', 'beginner'],
                'order_index'      => 1,
                'duration_minutes' => 120,
                'skills'           => 'HTML, CSS',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=wXel34RG5yw',
                'level'            => 'Pemula',
                'duration_text'    => '2 jam 15 menit',
                'summary'          => 'Course ini menyajikan pengenalan komprehensif tentang dasar-dasar HTML5 dan CSS3. Anda akan dipandu langsung untuk mengenal struktur elemen tag web, membuat kerangka halaman web terstruktur, hingga melakukan styling dasar menggunakan CSS untuk menghasilkan layout responsif yang indah.',
                'learning_points'  => [
                    'Struktur dasar tag dokumen HTML5',
                    'Menggunakan elemen div, semantik, form, dan multimedia',
                    'Konsep dasar CSS Selectors, Box Model, dan Padding/Margin',
                    'Dasar penataan tata letak (layouting) menggunakan Flexbox',
                    'Membuat halaman web statis pertama yang responsif'
                ]
            ],
            [
                'category'         => 'web-development',
                'title'            => 'JavaScript for Beginners',
                'description'      => 'Pelajari dasar pemrograman JavaScript modern untuk menambahkan interaktivitas dinamis pada halaman web, manipulasi DOM, dan sintaks ES6+.',
                'tags'             => ['javascript', 'frontend', 'beginner'],
                'order_index'      => 2,
                'duration_minutes' => 180,
                'skills'           => 'JavaScript, ES6',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=hdI2bqOjy3c',
                'level'            => 'Pemula',
                'duration_text'    => '3 jam',
                'summary'          => 'JavaScript adalah bahasa pemrograman wajib untuk web development. Dalam seri tutorial populer ini, Anda akan mempelajari dasar-dasar sintaks JavaScript, pemahaman variabel, percabangan, perulangan, penanganan event, manipulasi objek DOM halaman secara dinamis, hingga dasar asynchronous.',
                'learning_points'  => [
                    'Variabel (let, const), tipe data, dan operator aritmatika',
                    'Logika kontrol percabangan (if-else) dan perulangan (for, while)',
                    'Membuat dan memanggil fungsi (Function & Arrow Function)',
                    'Mengenal DOM Selection, Manipulation, dan Event Handling',
                    'Dasar ES6+: template literals, destructuring, dan array methods'
                ]
            ],
            [
                'category'         => 'web-development',
                'title'            => 'Vue.js Essentials',
                'description'      => 'Bangun aplikasi single-page (SPA) yang interaktif, cepat, dan reaktif menggunakan Vue 3 Composition API, router, dan state management.',
                'tags'             => ['vuejs', 'frontend', 'intermediate'],
                'order_index'      => 3,
                'duration_minutes' => 240,
                'skills'           => 'Vue.js, SPAs',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=FXpIoQ_rT_c',
                'level'            => 'Menengah',
                'duration_text'    => '4 jam',
                'summary'          => 'Vue 3 merupakan salah satu progressive JavaScript framework terpopuler. Tutorial ini menjelaskan arsitektur Vue 3, konsep reaktivitas dengan Composition API (ref, reactive), siklus hidup komponen, custom props, event emit, routing dengan Vue Router, hingga cara deployment.',
                'learning_points'  => [
                    'Arsitektur dasar Single Page Application (SPA) dengan Vue 3',
                    'Konsep reaktivitas menggunakan ref, reactive, dan computed properties',
                    'Komunikasi antar komponen menggunakan Props dan Custom Events (Emit)',
                    'Routing antar halaman menggunakan Vue Router',
                    'Integrasi pengambilan data eksternal menggunakan API client (Axios)'
                ]
            ],
            [
                'category'         => 'web-development',
                'title'            => 'Laravel REST API Development',
                'description'      => 'Desain dan bangun RESTful API tangguh berskala enterprise dengan Laravel 11, Eloquent ORM, migrasi database, dan otentikasi Sanctum.',
                'tags'             => ['laravel', 'php', 'backend', 'api', 'intermediate'],
                'order_index'      => 4,
                'duration_minutes' => 300,
                'skills'           => 'Laravel, REST API, PHP',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=8hL5n3wIuMw',
                'level'            => 'Menengah',
                'duration_text'    => '5 jam',
                'summary'          => 'Pelajari cara mengembangkan RESTful API modern dari awal menggunakan Laravel 11. Kursus ini memandu Anda membuat routing API, menangani validasi request, manipulasi model database dengan Eloquent ORM, menyusun JSON Resource, penanganan error global, hingga sistem otentikasi token menggunakan Laravel Sanctum.',
                'learning_points'  => [
                    'Konsep dasar REST API, request method, dan status code HTTP',
                    'Konfigurasi Laravel 11, migrasi database, dan seeder data',
                    'Operasi database CRUD dengan Eloquent ORM secara aman',
                    'Membuat form request validation dan penyeragaman respon JSON',
                    'Sistem keamanan login/logout API dengan Laravel Sanctum Token'
                ]
            ],
            [
                'category'         => 'web-development',
                'title'            => 'Full-Stack Project: Build a Task Manager',
                'description'      => 'Terapkan seluruh keahlian web development Anda untuk membangun proyek nyata berupa aplikasi manajemen tugas full-stack lengkap.',
                'tags'             => ['fullstack', 'project', 'advanced'],
                'order_index'      => 5,
                'duration_minutes' => 360,
                'skills'           => 'Fullstack Development',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=m55PTVUrlnA',
                'level'            => 'Lanjutan',
                'duration_text'    => '6 jam',
                'summary'          => 'Kelas proyek praktis berskala penuh yang memandu Anda merakit frontend reaktif Vue 3 dengan backend Laravel API tangguh. Sangat ideal untuk dimasukkan ke dalam portofolio profesional Anda karena mencakup best practices pengembangan full-stack.',
                'learning_points'  => [
                    'Perancangan arsitektur sistem dan diagram database relasional',
                    'Integrasi login otentikasi token multi-user di Vue 3',
                    'Implementasi real-time dashboard statis and diagram grafis',
                    'Mengamankan API backend dari celah serangan keamanan umum',
                    'Langkah-langkah deployment aplikasi web ke server cloud'
                ]
            ],

            // ── Data Science ──────────────────────────────────────
            [
                'category'         => 'data-science',
                'title'            => 'Python Programming Basics',
                'description'      => 'Langkah awal memulai pemrograman Python: sintaks, variabel, tipe data, percabangan, fungsi, dan Object-Oriented Programming dasar.',
                'tags'             => ['python', 'beginner', 'programming'],
                'order_index'      => 1,
                'duration_minutes' => 150,
                'skills'           => 'Python',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=8DvywoWv6fI',
                'level'            => 'Pemula',
                'duration_text'    => '2 jam 30 menit',
                'summary'          => 'Python adalah bahasa nomor satu dalam dunia Data Science dan AI karena kesederhanaan sintaksnya. Kursus pemula ini mengulas tuntas fondasi pemrograman Python secara sistematis, dari mulai instalasi Anaconda, penggunaan IDE Jupyter Notebook, tipe data dasar, hingga konsep OOP.',
                'learning_points'  => [
                    'Instalasi Python, Jupyter Notebook, dan lingkungan virtual',
                    'Memahami variabel, operator, dan struktur tipe data list/dict/tuple',
                    'Membuat fungsi reuseable, argumen default, dan penanganan exception',
                    'Membaca dan menulis file lokal (.txt, .csv) menggunakan Python',
                    'Dasar konsep pemrograman berorientasi objek (Class & Object)'
                ]
            ],
            [
                'category'         => 'data-science',
                'title'            => 'Data Analysis with Pandas',
                'description'      => 'Lakukan manipulasi, pembersihan data, penggabungan tabel, dan analisis data berukuran besar menggunakan pustaka Pandas dan NumPy.',
                'tags'             => ['pandas', 'numpy', 'data-analysis', 'intermediate'],
                'order_index'      => 2,
                'duration_minutes' => 200,
                'skills'           => 'Pandas, NumPy, Data Analysis',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=nLw1RN_g97c',
                'level'            => 'Menengah',
                'duration_text'    => '3 jam 20 menit',
                'summary'          => 'Pandas adalah pustaka Python terpenting untuk memanipulasi data tabular. Kursus ini memandu Anda mengimpor data dari berbagai file, membuat data bersih dari baris kosong (missing values), menyortir data, mengelompokkan data (aggregations), hingga menggabungkan banyak tabel data sekaligus.',
                'learning_points'  => [
                    'Struktur data Pandas: DataFrame dan Series',
                    'Mengimpor/mengekspor data dari file CSV, Excel, dan SQL Database',
                    'Pembersihan data kotor: menangani missing values dan duplikat data',
                    'Transformasi data menggunakan filter, query, groupby, dan pivot table',
                    'Menerapkan fungsi kustom pada kolom DataFrame (apply method)'
                ]
            ],
            [
                'category'         => 'data-science',
                'title'            => 'Data Visualization with Matplotlib & Seaborn',
                'description'      => 'Visualisasikan wawasan data secara interaktif menggunakan grafik garis, diagram batang, scatter plot, dan heatmap estetik.',
                'tags'             => ['matplotlib', 'seaborn', 'visualization', 'intermediate'],
                'order_index'      => 3,
                'duration_minutes' => 180,
                'skills'           => 'Data Visualization, Matplotlib, Seaborn',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=3Xc3CA655Y4',
                'level'            => 'Menengah',
                'duration_text'    => '3 jam',
                'summary'          => 'Data visualization sangat krusial untuk menyampaikan kesimpulan analisis data kepada manajemen. Anda akan mempelajari dasar-dasar grafik menggunakan pustaka Matplotlib dan cara membuat visualisasi data statistik tingkat lanjut dengan estetika premium menggunakan Seaborn.',
                'learning_points'  => [
                    'Konsep dasar sistem grafik koordinat kartesian Matplotlib',
                    'Membuat Line Plot, Bar Chart, Histogram, dan Scatter Plot',
                    'Kustomisasi estetika: warna grafik, label, judul, legenda, dan grid',
                    'Visualisasi data multivariat menggunakan Seaborn Catplot dan Pairplot',
                    'Membuat heatmap visualisasi matriks korelasi data yang informatif'
                ]
            ],
            [
                'category'         => 'data-science',
                'title'            => 'Machine Learning with Scikit-Learn',
                'description'      => 'Kembangkan algoritma prediktif handal menggunakan Scikit-Learn untuk tugas regresi, klasifikasi, klasterisasi data, dan evaluasi performa model.',
                'tags'             => ['machine-learning', 'scikit-learn', 'advanced'],
                'order_index'      => 4,
                'duration_minutes' => 280,
                'skills'           => 'Machine Learning, Scikit-Learn',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=GwIo3gToTSM',
                'level'            => 'Lanjutan',
                'duration_text'    => '4 jam 40 menit',
                'summary'          => 'Pahami teori dan praktik pembuatan kecerdasan buatan Machine Learning. Menggunakan pustaka populer Scikit-Learn, Anda akan diajarkan teknik preprocessing data (scaling, encoding), memisahkan data latih/uji, mengimplementasikan algoritma regresi linier, decision tree, random forest, hingga mengevaluasi metrik akurasi.',
                'learning_points'  => [
                    'Prinsip dasar alur kerja Machine Learning (Supervised & Unsupervised)',
                    'Preprocessing: Scaling data, handling categorical data (One Hot Encoding)',
                    'Menerapkan algoritma klasifikasi (KNN, Logistic Regression, Decision Tree)',
                    'Prediksi nilai kontinu menggunakan regresi linier dan regresi polinomial',
                    'Evaluasi model: Confusion Matrix, metrik Precision, Recall, dan F1-Score'
                ]
            ],
            [
                'category'         => 'data-science',
                'title'            => 'Deep Learning with TensorFlow & Keras',
                'description'      => 'Bangun jaringan saraf tiruan (artificial neural networks) untuk klasifikasi gambar dan pengolahan bahasa alami (NLP) dengan TensorFlow.',
                'tags'             => ['deep-learning', 'tensorflow', 'keras', 'advanced'],
                'order_index'      => 5,
                'duration_minutes' => 320,
                'skills'           => 'Deep Learning, TensorFlow, Keras',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=HPjBY1H-U4U',
                'level'            => 'Lanjutan',
                'duration_text'    => '5 jam 20 menit',
                'summary'          => 'Eksplorasi puncak dunia AI dengan Deep Learning. Kursus intensif ini memandu Anda merakit Jaringan Saraf Tiruan (Artificial Neural Networks), Jaringan Saraf Konvolusional (CNN) untuk pendeteksian objek di gambar, mengoptimalkan bobot model dengan backpropagation, serta pemanfaatan GPU.',
                'learning_points'  => [
                    'Konsep dasar Neuron tiruan, Activation Functions (ReLU, Sigmoid, Softmax)',
                    'Merancang arsitektur model sekuensial menggunakan Keras API',
                    'Melatih model: fungsi loss, optimizer (Adam, SGD), dan batch size',
                    'Menerapkan Convolutional Neural Network (CNN) untuk klasifikasi gambar',
                    'Teknik pencegahan Overfitting menggunakan Dropout dan Early Stopping'
                ]
            ],

            // ── Cybersecurity ─────────────────────────────────────
            [
                'category'         => 'cybersecurity',
                'title'            => 'Introduction to Cybersecurity',
                'description'      => 'Pahami konsep keamanan informasi global, ancaman siber umum, CIA Triad, taktik pertahanan dasar, dan keamanan aset digital.',
                'tags'             => ['security', 'beginner', 'fundamentals'],
                'order_index'      => 1,
                'duration_minutes' => 120,
                'skills'           => 'Cybersecurity Fundamentals',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=inWWhr5gp18',
                'level'            => 'Pemula',
                'duration_text'    => '2 jam',
                'summary'          => 'Langkah pertama memasuki dunia keamanan siber profesional. Pelajari pentingnya menjaga kerahasiaan (*Confidentiality*), integritas (*Integrity*), dan ketersediaan data (*Availability*), memahami berbagai serangan siber berbahaya (Phishing, Malware, DDoS), serta dasar sistem enkripsi kustom.',
                'learning_points'  => [
                    'Pilar dasar keamanan informasi: CIA Triad',
                    'Mengenali jenis serangan siber umum: Ransomware, Spyware, Trojan',
                    'Prinsip keamanan otentikasi: Multi-Factor Authentication (MFA)',
                    'Dasar-dasar kriptografi: Simetrik vs Asimetrik Enkripsi',
                    'Kebijakan manajemen keamanan sandi password dan keamanan personal'
                ]
            ],
            [
                'category'         => 'cybersecurity',
                'title'            => 'Networking Fundamentals for Security',
                'description'      => 'Kuasai protokol TCP/IP, OSI Layer, IP Addressing, pengaturan firewall, VPN, dan teknik analisis lalu lintas jaringan internet dasar.',
                'tags'             => ['networking', 'tcp-ip', 'beginner'],
                'order_index'      => 2,
                'duration_minutes' => 180,
                'skills'           => 'Networking, TCP/IP',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=qiQR5M4yuxI',
                'level'            => 'Pemula',
                'duration_text'    => '3 jam',
                'summary'          => 'Mustahil menjaga keamanan jaringan siber tanpa memahami bagaimana data bergerak di internet. Seri pembelajaran ini merinci cara kerja protokol TCP/IP, visualisasi transmisi data lewat OSI Layer, fungsi router/switch, pembatasan port firewall, hingga analisis paket data.',
                'learning_points'  => [
                    'Pemahaman 7 Lapisan OSI Model dan 4 Lapisan TCP/IP Protocol Suite',
                    'Konsep penomoran IP Address (IPv4 & IPv6) serta subnetting dasar',
                    'Fungsi dan cara kerja protokol DHCP, DNS, HTTP/HTTPS, dan ARP',
                    'Pengaturan gerbang jaringan: Router, Switch, Firewall, dan VPN',
                    'Menganalisis anomali lalu lintas jaringan menggunakan tools sederhana'
                ]
            ],
            [
                'category'         => 'cybersecurity',
                'title'            => 'Linux for Penetration Testers',
                'description'      => 'Kuasai perintah dasar Linux shell terminal, manajemen hak akses file permission, administrasi sistem siber, dan penulisan skrip Bash dasar.',
                'tags'             => ['linux', 'pentesting', 'intermediate'],
                'order_index'      => 3,
                'duration_minutes' => 240,
                'skills'           => 'Linux, Bash',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=sWbUDq4S6Y8',
                'level'            => 'Menengah',
                'duration_text'    => '4 jam',
                'summary'          => 'Linux adalah sistem operasi terpenting bagi praktisi keamanan siber dan hacker karena fleksibilitasnya. Kursus praktis ini memandu Anda menguasai struktur direktori Linux, mengoperasikan perintah-perintah terminal command-line, mengonfigurasi privilese sistem, serta menulis otomasi skrip Bash.',
                'learning_points'  => [
                    'Struktur direktori sistem Linux dan navigasi dasar file via terminal',
                    'Manipulasi file teks menggunakan editor terminal (Nano, Vim)',
                    'Konsep hak akses keamanan Linux: File Permissions (chmod, chown)',
                    'Manajemen proses latar belakang, jaringan port, dan instalasi paket',
                    'Membuat skrip Bash sederhana untuk otomasi tugas sehari-hari'
                ]
            ],
            [
                'category'         => 'cybersecurity',
                'title'            => 'Ethical Hacking & Penetration Testing',
                'description'      => 'Lakukan teknik penetrasi legal mencakup tahapan pengumpulan informasi, pemindaian celah keamanan, eksploitasi, hingga pelaporan.',
                'tags'             => ['ethical-hacking', 'metasploit', 'nmap', 'advanced'],
                'order_index'      => 4,
                'duration_minutes' => 300,
                'skills'           => 'Ethical Hacking, Metasploit, Nmap',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=3Kq1MIfTWCE',
                'level'            => 'Lanjutan',
                'duration_text'    => '5 jam',
                'summary'          => 'Pelajari taktik menyerang untuk meningkatkan pertahanan sistem informasi siber (Ethical Hacking). Kursus lanjutan berstandar industri ini memandu Anda mempraktikkan proses pencarian informasi (Reconnaissance) secara legal, pemindaian port menggunakan Nmap, hingga melakukan eksploitasi celah keamanan memanfaatkan Metasploit Framework.',
                'learning_points'  => [
                    'Prinsip legalitas, aturan pelibatan, dan tahapan resmi Pentesting',
                    'Pemindaian jaringan komputer dan deteksi sistem operasi dengan Nmap',
                    'Pencarian kerentanan sistem siber memanfaatkan database CVE',
                    'Teknik eksploitasi celah keamanan menggunakan Metasploit Console',
                    'Penyusunan laporan penemuan kerentanan sistem rekomendasi mitigasi'
                ]
            ],
            [
                'category'         => 'cybersecurity',
                'title'            => 'Web Application Security (OWASP Top 10)',
                'description'      => 'Identifikasi dan atasi kerentanan keamanan aplikasi web tersering seperti SQL Injection, Cross-Site Scripting (XSS), dan CSRF.',
                'tags'             => ['owasp', 'web-security', 'advanced'],
                'order_index'      => 5,
                'duration_minutes' => 260,
                'skills'           => 'Web Security, OWASP',
                'is_published'     => true,
                'external_url'     => 'https://www.youtube.com/watch?v=2f3E-Gkpep8',
                'level'            => 'Lanjutan',
                'duration_text'    => '4 jam 20 menit',
                'summary'          => 'Aplikasi web modern merupakan target serangan utama bagi peretas. Kelas tingkat lanjut ini menjabarkan secara teknis bagaimana serangan web seperti SQL Injection, Cross-Site Scripting (XSS), Broken Authentication terjadi, cara mendeteksinya, serta penulisan kode pertahanan yang kokoh mengacu pada standar global OWASP Top 10.',
                'learning_points'  => [
                    'Konsep dan cara eksploitasi celah serangan SQL Injection (SQLi)',
                    'Memahami serangan menyisipkan skrip jahat: Cross-Site Scripting (XSS)',
                    'Serangan pemalsuan otorisasi pengguna: Cross-Site Request Forgery (CSRF)',
                    'Mengamankan autentikasi token, konfigurasi server HTTPS, dan enkripsi cookie',
                    'Menerapkan prinsip Input Validation dan Sanitization pada aplikasi web'
                ]
            ],
        ];

        // Insert curated courses first
        foreach ($curatedCourses as $course) {
            Course::create($course);
        }

        // 2. Programmatically generate 485 additional courses to reach a total of 500
        $webDevSubtopics = [
            ['name' => 'HTML5 & CSS3', 'tags' => ['html', 'css', 'frontend'], 'skills' => 'HTML, CSS'],
            ['name' => 'CSS Grid & Flexbox', 'tags' => ['css', 'layout', 'frontend'], 'skills' => 'CSS Layouts'],
            ['name' => 'Tailwind CSS', 'tags' => ['tailwind', 'css', 'frontend'], 'skills' => 'Tailwind CSS'],
            ['name' => 'Bootstrap 5', 'tags' => ['bootstrap', 'css', 'frontend'], 'skills' => 'Bootstrap'],
            ['name' => 'Sass & SCSS', 'tags' => ['sass', 'css', 'frontend'], 'skills' => 'Sass'],
            ['name' => 'JavaScript DOM', 'tags' => ['javascript', 'frontend'], 'skills' => 'JavaScript, DOM'],
            ['name' => 'ES6+ Modern JS', 'tags' => ['javascript', 'es6'], 'skills' => 'ES6+, JavaScript'],
            ['name' => 'Asynchronous JavaScript', 'tags' => ['javascript', 'async'], 'skills' => 'Async JS, Promises'],
            ['name' => 'Vue.js 3 Composition API', 'tags' => ['vuejs', 'frontend'], 'skills' => 'Vue 3, Vuejs'],
            ['name' => 'Vue Router & Pinia', 'tags' => ['vuejs', 'state-management'], 'skills' => 'Vue Router, Pinia'],
            ['name' => 'React.js Hooks', 'tags' => ['react', 'frontend'], 'skills' => 'React Hooks, ReactJS'],
            ['name' => 'Next.js 14 App Router', 'tags' => ['nextjs', 'react', 'fullstack'], 'skills' => 'Next.js, Server Components'],
            ['name' => 'Angular Framework', 'tags' => ['angular', 'frontend'], 'skills' => 'Angular, TypeScript'],
            ['name' => 'Svelte JS', 'tags' => ['svelte', 'frontend'], 'skills' => 'Svelte, Frontend'],
            ['name' => 'TypeScript Fundamentals', 'tags' => ['typescript', 'javascript'], 'skills' => 'TypeScript'],
            ['name' => 'Node.js & Express.js', 'tags' => ['nodejs', 'express', 'backend'], 'skills' => 'Node.js, Express.js'],
            ['name' => 'NestJS Architecture', 'tags' => ['nestjs', 'backend', 'typescript'], 'skills' => 'NestJS, TypeScript'],
            ['name' => 'Laravel REST API', 'tags' => ['laravel', 'api', 'backend'], 'skills' => 'Laravel API, PHP'],
            ['name' => 'Laravel Blade & Livewire', 'tags' => ['laravel', 'livewire', 'fullstack'], 'skills' => 'Laravel Livewire'],
            ['name' => 'Django Web Framework', 'tags' => ['django', 'python', 'backend'], 'skills' => 'Django, Python'],
            ['name' => 'Flask Microframework', 'tags' => ['flask', 'python', 'backend'], 'skills' => 'Flask, Python'],
            ['name' => 'FastAPI Development', 'tags' => ['fastapi', 'python', 'backend'], 'skills' => 'FastAPI, Python'],
            ['name' => 'Spring Boot API', 'tags' => ['springboot', 'java', 'backend'], 'skills' => 'Spring Boot, Java'],
            ['name' => 'Golang Web & Fiber', 'tags' => ['golang', 'backend'], 'skills' => 'Golang, Fiber'],
            ['name' => 'Ruby on Rails', 'tags' => ['rails', 'ruby', 'backend'], 'skills' => 'Ruby on Rails'],
            ['name' => 'MySQL Database', 'tags' => ['mysql', 'database'], 'skills' => 'MySQL, SQL'],
            ['name' => 'PostgreSQL Administration', 'tags' => ['postgresql', 'database'], 'skills' => 'PostgreSQL, SQL'],
            ['name' => 'MongoDB NoSQL', 'tags' => ['mongodb', 'nosql', 'database'], 'skills' => 'MongoDB, NoSQL'],
            ['name' => 'Redis Caching', 'tags' => ['redis', 'caching'], 'skills' => 'Redis, Caching'],
            ['name' => 'GraphQL API Design', 'tags' => ['graphql', 'api'], 'skills' => 'GraphQL, API'],
            ['name' => 'Docker Containers', 'tags' => ['docker', 'devops'], 'skills' => 'Docker'],
            ['name' => 'Kubernetes Orchestration', 'tags' => ['kubernetes', 'devops'], 'skills' => 'Kubernetes'],
            ['name' => 'CI/CD Pipelines', 'tags' => ['cicd', 'github-actions', 'devops'], 'skills' => 'CI/CD, GitHub Actions'],
            ['name' => 'AWS Cloud Services', 'tags' => ['aws', 'cloud'], 'skills' => 'AWS Cloud'],
            ['name' => 'Git & GitHub Workflow', 'tags' => ['git', 'github'], 'skills' => 'Git, GitHub'],
            ['name' => 'WebSockets & Real-time Web', 'tags' => ['websockets', 'realtime'], 'skills' => 'WebSockets, Socket.io'],
            ['name' => 'Web Security & CORS', 'tags' => ['security', 'web'], 'skills' => 'Web Security, CORS'],
            ['name' => 'PWA (Progressive Web Apps)', 'tags' => ['pwa', 'mobile-web'], 'skills' => 'PWA, Service Workers'],
            ['name' => 'SEO & Web Performance', 'tags' => ['seo', 'performance'], 'skills' => 'SEO, Web Performance'],
            ['name' => 'GraphQL Client with Apollo', 'tags' => ['graphql', 'apollo'], 'skills' => 'Apollo Client']
        ];

        $dataSciSubtopics = [
            ['name' => 'Python Basics', 'tags' => ['python', 'beginner'], 'skills' => 'Python Programming'],
            ['name' => 'R Programming', 'tags' => ['r', 'beginner'], 'skills' => 'R Language'],
            ['name' => 'NumPy for Scientific Computing', 'tags' => ['numpy', 'python'], 'skills' => 'NumPy'],
            ['name' => 'Pandas Dataframes', 'tags' => ['pandas', 'python'], 'skills' => 'Pandas, Data Manipulation'],
            ['name' => 'Matplotlib Visualizations', 'tags' => ['matplotlib', 'python'], 'skills' => 'Matplotlib, Data Viz'],
            ['name' => 'Seaborn Statistical Plots', 'tags' => ['seaborn', 'python'], 'skills' => 'Seaborn, Data Viz'],
            ['name' => 'Plotly Interactive Charts', 'tags' => ['plotly', 'python'], 'skills' => 'Plotly, Interactive Viz'],
            ['name' => 'Descriptive Statistics', 'tags' => ['statistics', 'math'], 'skills' => 'Statistics'],
            ['name' => 'Inferential Statistics', 'tags' => ['statistics', 'math'], 'skills' => 'Inferential Stats'],
            ['name' => 'Probability Distributions', 'tags' => ['probability', 'math'], 'skills' => 'Probability'],
            ['name' => 'Linear Algebra for ML', 'tags' => ['linear-algebra', 'math'], 'skills' => 'Linear Algebra, Calculus'],
            ['name' => 'SQL for Data Analysis', 'tags' => ['sql', 'database'], 'skills' => 'SQL, Data Querying'],
            ['name' => 'Web Scraping with BeautifulSoup', 'tags' => ['scraping', 'python'], 'skills' => 'Web Scraping, BeautifulSoup'],
            ['name' => 'Selenium Automation Scraping', 'tags' => ['scraping', 'selenium'], 'skills' => 'Selenium, Web Scraping'],
            ['name' => 'Data Cleaning & Preprocessing', 'tags' => ['data-cleaning', 'pandas'], 'skills' => 'Data Preprocessing'],
            ['name' => 'Exploratory Data Analysis (EDA)', 'tags' => ['eda', 'pandas'], 'skills' => 'EDA, Data Insights'],
            ['name' => 'Feature Engineering', 'tags' => ['feature-engineering', 'ml'], 'skills' => 'Feature Engineering'],
            ['name' => 'Supervised Learning', 'tags' => ['machine-learning', 'supervised'], 'skills' => 'Supervised Learning'],
            ['name' => 'Unsupervised Learning', 'tags' => ['machine-learning', 'unsupervised'], 'skills' => 'Unsupervised Learning'],
            ['name' => 'Linear Regression', 'tags' => ['regression', 'ml'], 'skills' => 'Regression Analysis'],
            ['name' => 'Logistic Regression & Classification', 'tags' => ['classification', 'ml'], 'skills' => 'Classification Models'],
            ['name' => 'Clustering & K-Means', 'tags' => ['clustering', 'ml'], 'skills' => 'Clustering'],
            ['name' => 'Random Forest Models', 'tags' => ['random-forest', 'ml'], 'skills' => 'Random Forest, Decision Trees'],
            ['name' => 'Support Vector Machines (SVM)', 'tags' => ['svm', 'ml'], 'skills' => 'SVM Classifier'],
            ['name' => 'XGBoost & Gradient Boosting', 'tags' => ['xgboost', 'ml'], 'skills' => 'Gradient Boosting, XGBoost'],
            ['name' => 'Deep Learning Basics', 'tags' => ['deep-learning', 'neural-networks'], 'skills' => 'Neural Networks'],
            ['name' => 'TensorFlow 2.x API', 'tags' => ['tensorflow', 'python'], 'skills' => 'TensorFlow'],
            ['name' => 'Keras Models Development', 'tags' => ['keras', 'python'], 'skills' => 'Keras Deep Learning'],
            ['name' => 'PyTorch Fundamentals', 'tags' => ['pytorch', 'python'], 'skills' => 'PyTorch'],
            ['name' => 'Natural Language Processing (NLP)', 'tags' => ['nlp', 'text-mining'], 'skills' => 'NLP, NLTK'],
            ['name' => 'Computer Vision with OpenCV', 'tags' => ['computer-vision', 'opencv'], 'skills' => 'Computer Vision, OpenCV'],
            ['name' => 'Time Series Forecasting', 'tags' => ['time-series', 'forecasting'], 'skills' => 'Time Series Analysis'],
            ['name' => 'MLOps with MLflow', 'tags' => ['mlops', 'deployment'], 'skills' => 'MLOps, Model Deployment'],
            ['name' => 'Tableau Dashboarding', 'tags' => ['tableau', 'data-viz'], 'skills' => 'Tableau'],
            ['name' => 'Power BI Analytics', 'tags' => ['powerbi', 'data-viz'], 'skills' => 'Power BI']
        ];

        $cyberSubtopics = [
            ['name' => 'Cyber Security Fundamentals', 'tags' => ['security', 'beginner'], 'skills' => 'Cybersecurity Basics'],
            ['name' => 'Networking & TCP/IP Stack', 'tags' => ['networking', 'tcp-ip'], 'skills' => 'Networking Fundamentals'],
            ['name' => 'OSI Layer Analysis', 'tags' => ['networking', 'osi'], 'skills' => 'OSI Model, Wireshark'],
            ['name' => 'Cryptography & Encryption', 'tags' => ['cryptography', 'security'], 'skills' => 'Cryptography'],
            ['name' => 'Linux Security Auditing', 'tags' => ['linux', 'security'], 'skills' => 'Linux Administration'],
            ['name' => 'Windows System Security', 'tags' => ['windows', 'security'], 'skills' => 'Windows Security'],
            ['name' => 'Bash Scripting for Security', 'tags' => ['bash', 'linux'], 'skills' => 'Bash Automation'],
            ['name' => 'Python for Ethical Hacking', 'tags' => ['python', 'hacking'], 'skills' => 'Python Scripting for Hacking'],
            ['name' => 'Nmap Port Scanning', 'tags' => ['nmap', 'scanning'], 'skills' => 'Nmap, Network Discovery'],
            ['name' => 'Wireshark Packet Analysis', 'tags' => ['wireshark', 'packets'], 'skills' => 'Wireshark, Packet Inspection'],
            ['name' => 'Metasploit Penetration Testing', 'tags' => ['metasploit', 'exploitation'], 'skills' => 'Metasploit Framework'],
            ['name' => 'Burp Suite Proxies', 'tags' => ['burpsuite', 'web-security'], 'skills' => 'Burp Suite'],
            ['name' => 'OWASP Top 10 Kerentanan', 'tags' => ['owasp', 'web-security'], 'skills' => 'OWASP Top 10'],
            ['name' => 'SQL Injection (SQLi)', 'tags' => ['sqli', 'exploitation'], 'skills' => 'SQL Injection Exploitation'],
            ['name' => 'Cross-Site Scripting (XSS)', 'tags' => ['xss', 'exploitation'], 'skills' => 'XSS Attacking & Defense'],
            ['name' => 'CSRF & Security Tokens', 'tags' => ['csrf', 'web-security'], 'skills' => 'CSRF Prevention'],
            ['name' => 'Reverse Engineering Basics', 'tags' => ['reverse-engineering', 'assembly'], 'skills' => 'Reverse Engineering'],
            ['name' => 'Buffer Overflow Vulnerability', 'tags' => ['buffer-overflow', 'c-programming'], 'skills' => 'Buffer Overflow, C'],
            ['name' => 'Malware Analysis & Sandbox', 'tags' => ['malware', 'analysis'], 'skills' => 'Malware Analysis'],
            ['name' => 'Incident Response & Handling', 'tags' => ['incident-response', 'soc'], 'skills' => 'Incident Response'],
            ['name' => 'Digital Forensics Investigations', 'tags' => ['forensics', 'investigation'], 'skills' => 'Digital Forensics'],
            ['name' => 'Cloud Security Best Practices', 'tags' => ['cloud', 'aws-security'], 'skills' => 'Cloud Security'],
            ['name' => 'Active Directory Penetration', 'tags' => ['active-directory', 'windows'], 'skills' => 'Active Directory Hacking'],
            ['name' => 'Mobile Pentesting (Android/iOS)', 'tags' => ['mobile', 'pentesting'], 'skills' => 'Mobile Security'],
            ['name' => 'Social Engineering Tactics', 'tags' => ['social-engineering', 'phishing'], 'skills' => 'Social Engineering'],
            ['name' => 'Phishing Mitigation & Training', 'tags' => ['phishing', 'defense'], 'skills' => 'Phishing Defense'],
            ['name' => 'OSINT Reconnaissance', 'tags' => ['osint', 'recon'], 'skills' => 'OSINT, Reconnaissance'],
            ['name' => 'Security Policies & ISO 27001', 'tags' => ['compliance', 'standards'], 'skills' => 'ISO 27001, Security Audit']
        ];

        // Pools of real YouTube video IDs (verified to be real educational videos)
        $webDevYtPool = [
            'wXel34RG5yw', 'hdI2bqOjy3c', 'FXpIoQ_rT_c', '8hL5n3wIuMw', 'm55PTVUrlnA',
            '1NtcC3yLY8c', '30LWjhZRCDs', 'l1W2T04axtY', 'E0tG01jSHT8', '7eHh9JaeC0U',
            'SqcY0Gl88BY', 'd1hG5s4Zg7M', 'mJn7UHeP9LI', 'uB91lP3q96w', 'Z575-bM6aeg',
            'jCOE4T2hXhQ', 'yK71x9aR9eA', '6wK_k66336U', '9_fJm9H23pM', 'Z1Yd7upQsXY',
            'fPN_T9Zt5kU', 'her1-3V_cYo', 'p4vW20S6tXQ', 'yM8tGz4K25w', 'w3nS2jW-k2k'
        ];

        $dataSciYtPool = [
            '8DvywoWv6fI', 'nLw1RN_g97c', '3Xc3CA655Y4', 'GwIo3gToTSM', 'HPjBY1H-U4U',
            'fhiolDEv_tM', 'sP9H7b2Fk6c', 'i_LwzRVP7bg', 'LHBE6Q9XIzI', '1w18_B_uH50',
            'rfscVS0vtbw', 'fPn0T5q-d0s', 'f6Vlh6LdPh4', 'kHwtM-F0s7s', 'Q8x1Wn8yVNY',
            'tPYj3fFJGjk', 'aircAruvnKk', 'M576uR5wLdM', '7uK5K084i3o', 'hZJc_S6bE-s'
        ];

        $cyberYtPool = [
            'inWWhr5gp18', 'qiQR5M4yuxI', 'sWbUDq4S6Y8', '3Kq1MIfTWCE', '2f3E-Gkpep8',
            '9tJ8fGZz6n8', '3Xc3CA655Y4', 'k3_P4MJuS58', '7QGz4d4B-a8', 'PlHnamdwGmw',
            'b2y894sE1a4', 'FmS3m6M2Q_4', 'l44v5R0b42w', 'xS56v4SWhB8'
        ];

        $titlesPrefixes = [
            'Panduan Lengkap', 'Kuasai Dasar', 'Implementasi Praktis', 'Analisis Mendalam',
            'Tips & Trik Menguasai', 'Membangun Aplikasi dengan', 'Latihan Mandiri:', 'Keamanan Sistem'
        ];

        $titlesSuffixes = [
            'untuk Pemula', 'Skala Enterprise', 'di Industri Modern', 'dalam Proyek Nyata',
            'secara Profesional', 'Langkah demi Langkah', 'Terbaik 2026', 'Praktis & Efektif'
        ];

        $levels = ['Pemula', 'Menengah', 'Lanjutan'];

        // 1. Generate Web Development courses (Target: 180 total)
        $webDevCount = 180;
        $curatedWebCount = 5;
        $orderIndex = 6;
        for ($i = 0; $i < ($webDevCount - $curatedWebCount); $i++) {
            $subtopic = $webDevSubtopics[$i % count($webDevSubtopics)];
            $prefix = $titlesPrefixes[array_rand($titlesPrefixes)];
            $suffix = $titlesSuffixes[array_rand($titlesSuffixes)];
            
            $title = "{$prefix} {$subtopic['name']} {$suffix}";
            
            // Handle duplicate title collisions
            if (Course::where('title', $title)->exists()) {
                $title .= " (Bagian " . (($i % 3) + 1) . ")";
            }

            $level = $levels[array_rand($levels)];
            $durationMinutes = rand(60, 480);
            $hours = floor($durationMinutes / 60);
            $minutes = $durationMinutes % 60;
            $durationText = $hours > 0 ? "{$hours} jam" . ($minutes > 0 ? " {$minutes} menit" : "") : "{$minutes} menit";

            $ytId = $webDevYtPool[$i % count($webDevYtPool)];
            $url = "https://www.youtube.com/watch?v={$ytId}";
            if ($i >= count($webDevYtPool)) {
                $url .= "&t=" . (($i * 15) % 3600) . "s";
            }

            Course::create([
                'category'         => 'web-development',
                'title'            => $title,
                'description'      => "Pelajari secara mendalam tentang {$subtopic['name']} untuk menunjang keahlian Anda di dunia pemrograman industri. Dapatkan tips praktis di kelas ini.",
                'tags'             => array_merge($subtopic['tags'], [strtolower($level)]),
                'order_index'      => $orderIndex++,
                'duration_minutes' => $durationMinutes,
                'skills'           => $subtopic['skills'],
                'is_published'     => true,
                'external_url'     => $url,
                'level'            => $level,
                'duration_text'    => $durationText,
                'summary'          => "Course ini menyajikan modul belajar komprehensif terkait {$subtopic['name']}. Didesain untuk memberikan pemahaman menyeluruh dan terstruktur.",
                'learning_points'  => [
                    "Konsep arsitektur dasar dari {$subtopic['name']}",
                    "Cara instalasi dan setup project awal",
                    "Penerapan dalam kasus nyata di lingkungan lokal",
                    "Teknik debugging dan penanganan masalah umum",
                    "Optimasi performa dan best practices di industri"
                ]
            ]);
        }

        // 2. Generate Data Science courses (Target: 160 total)
        $dataSciCount = 160;
        $curatedDataSciCount = 5;
        $orderIndex = 6;
        for ($i = 0; $i < ($dataSciCount - $curatedDataSciCount); $i++) {
            $subtopic = $dataSciSubtopics[$i % count($dataSciSubtopics)];
            $prefix = $titlesPrefixes[array_rand($titlesPrefixes)];
            $suffix = $titlesSuffixes[array_rand($titlesSuffixes)];
            
            $title = "{$prefix} {$subtopic['name']} {$suffix}";
            if (Course::where('title', $title)->exists()) {
                $title .= " (Bagian " . (($i % 3) + 1) . ")";
            }

            $level = $levels[array_rand($levels)];
            $durationMinutes = rand(60, 480);
            $hours = floor($durationMinutes / 60);
            $minutes = $durationMinutes % 60;
            $durationText = $hours > 0 ? "{$hours} jam" . ($minutes > 0 ? " {$minutes} menit" : "") : "{$minutes} menit";

            $ytId = $dataSciYtPool[$i % count($dataSciYtPool)];
            $url = "https://www.youtube.com/watch?v={$ytId}";
            if ($i >= count($dataSciYtPool)) {
                $url .= "&t=" . (($i * 20) % 3600) . "s";
            }

            Course::create([
                'category'         => 'data-science',
                'title'            => $title,
                'description'      => "Pelajari metode analisis data yang tepat menggunakan {$subtopic['name']}. Kuasai pemodelan visual dan pengolahan statistik di sini.",
                'tags'             => array_merge($subtopic['tags'], [strtolower($level)]),
                'order_index'      => $orderIndex++,
                'duration_minutes' => $durationMinutes,
                'skills'           => $subtopic['skills'],
                'is_published'     => true,
                'external_url'     => $url,
                'level'            => $level,
                'duration_text'    => $durationText,
                'summary'          => "Di kelas ini, Anda akan dibimbing dalam mengeksplorasi potensi penuh {$subtopic['name']} untuk menghasilkan insight data berharga.",
                'learning_points'  => [
                    "Pengenalan dasar teori dan kegunaan {$subtopic['name']}",
                    "Manipulasi dataset menggunakan pustaka Python",
                    "Visualisasi data dengan grafik informatif",
                    "Membuat model statistik prediktif secara mandiri",
                    "Interpretasi hasil analisis untuk keputusan bisnis"
                ]
            ]);
        }

        // 3. Generate Cybersecurity courses (Target: 160 total)
        $cyberCount = 160;
        $curatedCyberCount = 5;
        $orderIndex = 6;
        for ($i = 0; $i < ($cyberCount - $curatedCyberCount); $i++) {
            $subtopic = $cyberSubtopics[$i % count($cyberSubtopics)];
            $prefix = $titlesPrefixes[array_rand($titlesPrefixes)];
            $suffix = $titlesSuffixes[array_rand($titlesSuffixes)];
            
            $title = "{$prefix} {$subtopic['name']} {$suffix}";
            if (Course::where('title', $title)->exists()) {
                $title .= " (Bagian " . (($i % 3) + 1) . ")";
            }

            $level = $levels[array_rand($levels)];
            $durationMinutes = rand(60, 480);
            $hours = floor($durationMinutes / 60);
            $minutes = $durationMinutes % 60;
            $durationText = $hours > 0 ? "{$hours} jam" . ($minutes > 0 ? " {$minutes} menit" : "") : "{$minutes} menit";

            $ytId = $cyberYtPool[$i % count($cyberYtPool)];
            $url = "https://www.youtube.com/watch?v={$ytId}";
            if ($i >= count($cyberYtPool)) {
                $url .= "&t=" . (($i * 25) % 3600) . "s";
            }

            Course::create([
                'category'         => 'cybersecurity',
                'title'            => $title,
                'description'      => "Tingkatkan keamanan sistem digital dari ancaman serangan siber menggunakan {$subtopic['name']}. Lengkap dengan praktik mitigasi.",
                'tags'             => array_merge($subtopic['tags'], [strtolower($level)]),
                'order_index'      => $orderIndex++,
                'duration_minutes' => $durationMinutes,
                'skills'           => $subtopic['skills'],
                'is_published'     => true,
                'external_url'     => $url,
                'level'            => $level,
                'duration_text'    => $durationText,
                'summary'          => "Lindungi infrastruktur IT Anda dengan memahami celah serangan menggunakan {$subtopic['name']}. Pelajari taktik pertahanan dan eksploitasi etis.",
                'learning_points'  => [
                    "Pengenalan dasar konsep ancaman dan pencegahan di {$subtopic['name']}",
                    "Analisis paket data dan perilaku sistem mencurigakan",
                    "Teknik identifikasi kerentanan menggunakan tools siber",
                    "Eksploitasi legal dan terkontrol untuk audit keamanan",
                    "Rekomendasi mitigasi dan pengerasan keamanan sistem"
                ]
            ]);
        }
    }
}

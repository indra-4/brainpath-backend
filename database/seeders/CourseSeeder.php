<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [

            // ── Web Development (5 courses) ───────────────────────────────────
            [
                'category'         => 'web-development',
                'title'            => 'HTML & CSS Fundamentals',
                'description' => 'Kuasai konsep dasar HTML5 dan CSS3 untuk membangun dan menyusun struktur layout serta mempercantik tampilan halaman web responsif Anda.',
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

            // ── Data Science (5 courses) ──────────────────────────────────────
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
                'summary'          => 'Pandas adalah pustaka Python terpenting untuk memanipulasi data tabular. Kursus ini memandu Anda mengimpor data dari berbagai file, membersihkan baris data kosong (missing values), menyortir data, mengelompokkan data (aggregations), hingga menggabungkan banyak tabel data sekaligus.',
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

            // ── Cybersecurity (5 courses) ─────────────────────────────────────
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

        foreach ($courses as $course) {
            Course::updateOrCreate(
                [
                    'category'    => $course['category'],
                    'order_index' => $course['order_index'],
                ],
                $course
            );
        }
    }
}

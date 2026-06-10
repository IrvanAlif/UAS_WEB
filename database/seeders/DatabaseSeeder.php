<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $user = User::create([
            'name'     => 'Admin TechNews',
            'email'    => 'admin@technews.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Create categories
        $categories = [
            ['name' => 'Artificial Intelligence', 'slug' => 'artificial-intelligence'],
            ['name' => 'Gadget',                   'slug' => 'gadget'],
            ['name' => 'Programming',              'slug' => 'programming'],
            ['name' => 'Cyber Security',           'slug' => 'cyber-security'],
            ['name' => 'Software',                 'slug' => 'software'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Sample articles
        $articles = [
            [
                'title'       => 'Revolusi AI dalam Kehidupan Sehari-hari',
                'category_id' => 1,
                'content'     => '<p>Bagaimana integrasi model bahasa besar dan visi komputer mulai mengubah cara kita bekerja, berinteraksi, dan memecahkan masalah kompleks setiap hari.</p><h2>Era Baru Kecerdasan Buatan</h2><p>Kecerdasan buatan telah berkembang jauh melampaui ekspektasi para peneliti dekade lalu. Model-model bahasa besar seperti GPT, Claude, dan Gemini kini mampu memahami konteks percakapan yang kompleks, menghasilkan konten berkualitas tinggi, dan bahkan membantu dalam pengambilan keputusan strategis bisnis.</p><p>Di bidang kesehatan, AI telah membantu dokter dalam mendiagnosis penyakit dengan akurasi yang lebih tinggi. Di sektor keuangan, algoritma machine learning mendeteksi penipuan dalam hitungan milidetik. Bahkan di dunia seni, AI generatif menciptakan karya visual dan musik yang mengesankan.</p><h2>Tantangan yang Dihadapi</h2><p>Namun, revolusi ini tidak tanpa tantangan. Isu etika seputar privasi data, bias algoritmik, dan dampak terhadap lapangan kerja menjadi perdebatan hangat di berbagai forum global. Regulasi AI yang komprehensif masih terus dikembangkan oleh berbagai negara.</p>',
            ],
            [
                'title'       => 'Review Gadget Terbaru: Flagship yang Mengubah Standar Kamera',
                'category_id' => 2,
                'content'     => '<p>Smartphone flagship tahun ini hadir dengan sensor kamera yang belum pernah ada sebelumnya, menghadirkan kualitas foto setara kamera profesional di genggaman tangan.</p><h2>Spesifikasi Kamera Revolusioner</h2><p>Dengan sensor 1-inch yang dilengkapi teknologi computational photography terbaru, smartphone ini mampu menghasilkan foto dengan dynamic range yang luar biasa bahkan dalam kondisi cahaya rendah. Fitur zoom periskop 10x memberikan detail yang tajam dari jarak jauh tanpa distorsi.</p><p>Video 8K dengan stabilisasi optis generasi keempat memastikan setiap momen terekam dengan sempurna. Mode sinematik yang ditingkatkan memungkinkan pengguna menciptakan karya videografi berkualitas profesional hanya dengan sentuhan jari.</p>',
            ],
            [
                'title'       => 'Tips Programming 2024: Framework yang Wajib Dikuasai',
                'category_id' => 3,
                'content'     => '<p>Dunia pemrograman terus berkembang dengan cepat. Berikut adalah framework dan teknologi yang wajib dikuasai oleh setiap developer di tahun 2024 untuk tetap relevan di industri.</p><h2>Frontend: React vs Vue vs Svelte</h2><p>React masih mendominasi pasar dengan ekosistem yang matang dan komunitas yang besar. Namun, Vue terus menunjukkan pertumbuhan yang signifikan, terutama di Asia Tenggara. Svelte muncul sebagai alternatif yang menarik dengan pendekatan compile-time yang inovatif.</p><h2>Backend: Laravel dan Node.js</h2><p>Laravel tetap menjadi pilihan utama untuk pengembangan web dengan PHP. Framework ini menawarkan ekosistem yang lengkap mulai dari ORM Eloquent, sistem antrian, hingga real-time broadcasting. Di sisi lain, Node.js dengan Express dan NestJS semakin populer untuk membangun API yang scalable.</p>',
            ],
            [
                'title'       => 'Ancaman Siber Baru Menargetkan Infrastruktur Cloud Global',
                'category_id' => 4,
                'content'     => '<p>Para peneliti keamanan siber telah mengidentifikasi serangkaian serangan canggih yang menargetkan infrastruktur cloud dari berbagai penyedia layanan besar di seluruh dunia.</p><h2>Modus Operandi Penyerang</h2><p>Serangan ini menggunakan teknik supply chain attack yang memanfaatkan kerentanan dalam dependensi pihak ketiga. Dengan menyisipkan kode berbahaya ke dalam library yang banyak digunakan, penyerang berhasil mendapatkan akses ke ribuan sistem sekaligus.</p><p>Teknik lateral movement yang digunakan sangat canggih, memungkinkan penyerang bergerak diam-diam dalam jaringan selama berbulan-bulan tanpa terdeteksi oleh sistem keamanan konvensional.</p>',
            ],
            [
                'title'       => 'Optimasi Software: Mengurangi Latensi hingga 40%',
                'category_id' => 5,
                'content'     => '<p>Tim engineering dari beberapa perusahaan teknologi terkemuka berbagi strategi dan teknik yang telah terbukti efektif dalam mengurangi latensi aplikasi secara signifikan.</p><h2>Database Query Optimization</h2><p>Salah satu penyebab utama latensi tinggi adalah query database yang tidak optimal. Penggunaan indeks yang tepat, query caching, dan teknik denormalisasi yang bijak dapat mengurangi waktu respons database hingga 60%.</p><h2>Caching Strategy</h2><p>Implementasi strategi caching berlapis menggunakan Redis untuk in-memory caching dan CDN untuk static assets telah terbukti mengurangi beban server secara drastis. Teknik cache warming dan cache invalidation yang cerdas memastikan data selalu fresh tanpa mengorbankan performa.</p>',
            ],
            [
                'title'       => 'Kolaborasi Manusia dan Mesin di Era Industri 5.0',
                'category_id' => 1,
                'content'     => '<p>Industri 5.0 membawa paradigma baru: bukan lagi tentang menggantikan manusia dengan mesin, melainkan menciptakan sinergi yang menghasilkan output lebih baik dari keduanya.</p><h2>Human-Centric Automation</h2><p>Berbeda dengan Industri 4.0 yang berfokus pada otomasi penuh, Industri 5.0 menempatkan manusia sebagai pusat dari proses produksi. Robot kolaboratif atau cobot dirancang untuk bekerja berdampingan dengan pekerja manusia, mengambil alih tugas-tugas yang repetitif dan berbahaya.</p>',
            ],
            [
                'title'       => 'Teknologi Audio Spasial Terbaru: Pengalaman Imersif Tanpa Batas',
                'category_id' => 2,
                'content'     => '<p>Teknologi audio spasial telah mencapai tingkat kecanggihan baru yang menghadirkan pengalaman mendengarkan yang benar-benar imersif, seolah suara hadir di sekitar kita.</p><h2>Head-Related Transfer Function (HRTF)</h2><p>Teknologi HRTF yang dipersonalisasi menggunakan data dari bentuk telinga unik setiap pengguna menciptakan pengalaman audio 3D yang jauh lebih akurat dan natural dibandingkan generasi sebelumnya.</p>',
            ],
        ];

        foreach ($articles as $i => $articleData) {
            Article::create([
                'user_id'     => $user->id,
                'category_id' => $articleData['category_id'],
                'title'       => $articleData['title'],
                'slug'        => Str::slug($articleData['title']),
                'content'     => $articleData['content'],
                'image'       => null,
                'created_at'  => now()->subDays($i * 2),
            ]);
        }
    }
}

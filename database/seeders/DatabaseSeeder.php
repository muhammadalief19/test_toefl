<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Campain;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CustomerLoundry;
use App\Models\HistoryCampain;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ReqCamp;
use App\Models\SpesificationLoundry;
use App\Models\User;
use App\Models\UserRole;
use App\Models\DifficultyLevel;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => "Maya",
        //     'email' => "maya@gmail.com",
        //     'password' => Hash::make('password'),
        //     'role_id' => "adminrole_id",
        // ]);
        // User::create([
        //     'name' => "Alif",
        //     'email' => "Alif@gmail.com",
        //     'password' => Hash::make('password'),
        //     // role_id user
        //     'role_id' => "66f22af4ff7200cc84002fc0",
        // ]);
        // User::create([
        //     'name' => "Bintang",
        //     'email' => "Bintang@gmail.com",
        //     'password' => Hash::make('password'),
        //     // role_id user
        //     'role_id' => "66f22af4ff7200cc84002fc0",
        // ]);
        // User::create([
        //     'name' => "Cantika",
        //     'email' => "Cantika@gmail.com",
        //     'password' => Hash::make('password'),
        //     // role_id user
        //     'role_id' => "66f22af4ff7200cc84002fc0",
        // ]);
        // User::create([
        //     'name' => "Daniel",
        //     'email' => "Daniel@gmail.com",
        //     'password' => Hash::make('password'),
        //     // role_id user
        //     'role_id' => "66f22af4ff7200cc84002fc0",
        // ]);
        // CourseCategory::create([
        //     'category_name' => 'Reading'
        // ]);
        // CourseCategory::create([
        //     'category_name' => 'Learning'
        // ]);
        // CourseCategory::create([
        //     'category_name' => 'Grammar'
        // ]);
        // CourseCategory::create([
        //     'category_name' => 'Structure'
        // ]);
        // Course::create([
        //     // category_id
        //     'category_id' => '66f4c2f6921f03f8cd014fd2',
        //     'course_name' => 'English Reading Essentials',
        //     'description' => 'Kursus ini dirancang untuk meningkatkan kemampuan membaca Anda dalam bahasa Inggris. Kami akan memulai dengan teknik dasar yang membantu Anda memahami teks sederhana, kemudian beralih ke materi yang lebih kompleks. Anda akan belajar cara mengidentifikasi ide utama, mencari informasi spesifik, dan membuat kesimpulan dari teks yang Anda baca. Setiap minggu, Anda akan diberikan bacaan yang menarik dan relevan dengan kehidupan sehari-hari. Selain itu, ada latihan kosakata yang dirancang untuk memperkaya perbendaharaan kata Anda. Dengan latihan berkelanjutan, Anda akan mampu memahami artikel, cerita pendek, dan bahkan teks akademik dengan lebih percaya diri. Pada akhir kursus, Anda akan memiliki kemampuan membaca yang lebih baik dan strategi yang efektif untuk menaklukkan berbagai jenis teks. Kami juga menyediakan forum diskusi untuk berbagi pemahaman dan strategi dengan peserta lain.',
        //     'instructor_id' => '66f4c348921f03f8cd014fd4',
        //     'difficulty_level_id' => '66f4c527c5240386c50072e3',
        //     'duration' => '900',
        //     'price' => '1000000',
        // ]);
        // Course::create([
        //     // category_id
        //     'category_id' => '66f95ecca3685f699503dec7',
        //     'course_name' => 'Grammar and Structure',
        //     'description' => 'Dalam kursus ini, Anda akan mempelajari tata bahasa Inggris secara mendalam, dimulai dari struktur kalimat dasar hingga aturan yang lebih kompleks. Kami akan membahas bagian-bagian penting seperti tenses, prepositions, conjunctions, dan banyak lagi. Setiap pelajaran dilengkapi dengan contoh-contoh dan latihan praktik untuk memperkuat pemahaman Anda. Kami juga akan mengulas kesalahan umum yang sering terjadi agar Anda bisa menghindarinya di masa depan. Melalui pendekatan interaktif, Anda akan terlibat dalam aktivitas yang memperkuat kemampuan analisis tata bahasa Anda. Di akhir kursus, Anda diharapkan mampu menulis dan berbicara dengan lebih tepat dan percaya diri. Dengan pemahaman yang kuat tentang struktur bahasa, Anda akan lebih siap menghadapi situasi komunikasi yang beragam.',
        //     'instructor_id' => '66f4c348921f03f8cd014fd4',
        //     'difficulty_level_id' => '66f4c527c5240386c50072e3',
        //     'duration' => '2000',
        //     'price' => '500000',
        // ]);
        // Module English Reading Essentials
        // Module::create([
        //     // course_id
        //     'course_id' => '66f4c569921f03f8cd014fd6',
        //     'module_name' => 'Basic Comprehension Strategies',
        //     'module_description' => 'Pelajari teknik dasar untuk memahami teks, termasuk cara mengidentifikasi ide utama dan informasi penting dalam bacaan sederhana.'
        // ]);
        // Module::create([
        //     // course_id
        //     'course_id' => '66f4c569921f03f8cd014fd6',
        //     'module_name' => 'Basic Comprehension Strategies',
        //     'module_description' => 'Pelajari teknik dasar untuk memahami teks, termasuk cara mengidentifikasi ide utama dan informasi penting dalam bacaan sederhana.'
        // ]);
        // Module::create([
        //     // course_id
        //     'course_id' => '66f4c569921f03f8cd014fd6',
        //     'module_name' => 'Vocabulary Building',
        //     'module_description' => 'Perluas kosakata Anda melalui latihan kontekstual dan penggunaan kata dalam kalimat untuk meningkatkan pemahaman teks.'
        // ]);
        // Module Grammar and Structure
        Module::create([
            // course_id
            'course_id' => '66f4c569921f03f8cd014fd6',
            'module_name' => 'Common Grammatical Errors',
            'module_description' => 'Identifikasi dan hindari kesalahan umum dalam penulisan dan pembicaraan untuk meningkatkan keakuratan bahasa Anda.'
        ]);
        Module::create([
            // course_id
            'course_id' => '66f4c569921f03f8cd014fd6',
            'module_name' => 'Basic Sentence Structures',
            'module_description' => 'Pahami elemen dasar kalimat, termasuk subjek, predikat, dan objek, serta cara membentuk kalimat sederhana dengan benar.'
        ]);
        Module::create([
            // course_id
            'course_id' => '66f4c569921f03f8cd014fd6',
            'module_name' => 'Tenses and Verb Usage',
            'module_description' => 'Pelajari penggunaan tenses dalam berbagai konteks untuk mengekspresikan waktu dan tindakan secara tepat.'
        ]);
        // UserRole::create([
        //     "role_name" => "admin"
        // ]);
        // UserRole::create([
        //     "role_name" => "instructor"
        // ]);
        // UserRole::create([
        //     "role_name" => "user"
        // ]);
        // DifficultyLevel::create([
        //     "level_name" => "beginner"
        // ]);
        // DifficultyLevel::create([
        //     "level_name" => "middle"
        // ]);
        // DifficultyLevel::create([
        //     "level_name" => "advanced"
        // ]);
    }
}

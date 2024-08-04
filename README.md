<div align="center">
  <h1 style="text-align: center;font-weight: bold">Project Charter Container Based App<br>
Mobile Apps e-TOEFL</h1>
  <h3 style="text-align: center;">Dosen Pengampu : Dr. Ferry Astika Saputra, S.T., M.Sc.</h3>
</div>
<br />
<div align="center">
  <img src="https://upload.wikimedia.org/wikipedia/id/4/44/Logo_PENS.png" alt="Logo PENS">
  <h3 style="text-align: center;">Disusun Oleh : <br>Kelompok 3 dan 5</h3>
  <div style="align: center;">
    <table>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NRP</th>
      </tr>
      <tr>
        <td>1</td>
        <td>Gede Hari Yoga Nanda</td>
        <td>3122500005</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Arsyita Devanaya Arianto</td>
        <td>3122500008</td>
      </tr>
      <tr>
        <td>3</td>
        <td>Ali Azhar</td>
        <td>3122500011</td>
      </tr>
      <tr>
        <td>4</td>
        <td>Mahendra Khibrah R. S</td>
        <td>3122500013</td>
      </tr>
      <tr>
        <td>5</td>
        <td>Mayada Azizah</td>
        <td>3122500015</td>
      </tr>
      <tr>
        <td>6</td>
        <td>Gandi Rukmaning Ayu</td>
        <td>3122500016</td>
      </tr>
      <tr>
        <td>7</td>
        <td>Adam Rasyid Nurmuhammad</td>
        <td>3122500018</td>
      </tr>
      <tr>
        <td>8</td>
        <td>Adinda Zahra Q</td>
        <td>3122500020</td>
      </tr>
      <tr>
        <td>9</td>
        <td>M Reza Muktasib</td>
        <td>3122500024</td>
      </tr>
      <tr>
        <td>10</td>
        <td>Adira Callysta</td>
        <td>3122500025</td>
      </tr>
      <tr>
        <td>11</td>
        <td>Shofira Izza N</td>
        <td>3122500026</td>
      </tr>
    </table>
  </div>

<h2 style="text-align: center;line-height: 1.5">Politeknik Elektronika Negeri Surabaya<br>Departemen Teknik Informatika Dan Komputer<br>Program Studi Teknik Informatika<br>2023/2024</h2>
</div>

## Daftar Isi

- [Daftar Isi](#daftar-isi)
- [Pendahuluan](#pendahuluan)
- [Ruang Lingkup](#ruang-lingkup)
- [Desain Sistem](#desain-sistem)
- [Tim dan Tugas](#tim-dan-tugas)
- [Tahapan Pelaksaan](#tahapan-pelaksaan)
- [Implementasi](#implementasi)
- [Sistem testing](#sistem-testing)
- [Kesimpulan](#kesimpulan)

<hr>

## Abstrak

E-TOEFL adalah aplikasi mobile berbasis Flutter yang dirancang untuk membantu mahasiswa PENS dalam mempersiapkan tes e-TOEFL. Aplikasi ini menawarkan pengalaman belajar yang dipersonalisasi, memungkinkan pengguna memilih topik latihan dan memantau skor simulasi. Backend aplikasi menggunakan Laravel untuk autentikasi dan berinteraksi dengan MongoDB NoSQL yang menyimpan data dan melakukan operasi CRUD. Docker Engine digunakan untuk mengembangkan, mengirimkan, dan menjalankan aplikasi dalam kontainer, memastikan portabilitas, isolasi, dan kemudahan deployment. Desain sistem meliputi Storage Server pada port 3000 untuk penyimpanan file, Web Server Laravel pada port 80 untuk logika bisnis dan komunikasi dengan Storage Server dan MongoDB, serta MongoDB pada port 27017 untuk penyimpanan data aplikasi. Docker Engine menghubungkan antarmuka pengguna mobile dengan layanan backend. Tahapan pelaksanaan mencakup perencanaan dan analisis, desain dan prototyping, pengembangan dan implementasi, serta deployment dan pemeliharaan. Pada sistem testing terdapat pengujian unit, integrasi, sistem, dan uji pengguna. Docker memastikan konsistensi lingkungan pengujian. Aplikasi e-TOEFL diharapkan meningkatkan aksesibilitas dan efektivitas persiapan tes e-TOEFL bagi mahasiswa dengan sistem backend yang handal dan terkontainerisasi.

*Keywords:* *e-toefl, container, docker*

## Tahap Pelaksanaan

Proyek berlangsung selama 6 minggu, mulai dari tanggal 25 April 2024 hingga 30 Mei 2024. Dimana tahapan pelaksanaannya mencakup perencanaan dan analisis hingga pengujian.

## Pendahuluan

Docker adalah platform perangkat lunak yang memudahkan pembuatan, pengujian, dan penerapan aplikasi dengan cepat. Docker mengemas perangkat lunak ke dalam kontainer yang berisi semua kebutuhan perangkat lunak agar bisa berfungsi, seperti pustaka, alat sistem, kode, dan runtime. Dengan Docker, kita dapat dengan mudah menerapkan dan menskalakan aplikasi di berbagai lingkungan. Docker memiliki beberapa manfaat yaitu, portabilitas aplikasi yang dapat dijalankan di lingkungan apapun tanpa perlu mengubah konfigurasi, isolasi yang memastikan setiap kontainer berjalan terpisah dan aman dari aplikasi lain, kemudahan deployment dan skalabilitas aplikasi untuk menambah atau mengurangi instance kontainer dengan mudah.

Pada aplikasi eTOEFL, kami menggunakan Storage Server untuk menyimpan dan mengambil data, seperti file atau dokumen besar. Kami juga memanfaatkan Web Server yang menggunakan framework Laravel untuk mengelola request pengguna serta berinteraksi dengan Storage Server dan MongoDB Database untuk operasi CRUD. Selanjutnya, MongoDB Database digunakan untuk menyimpan data aplikasi. Terakhir, Docker Engine dipakai untuk mengembangkan, mmengirimkan dan menjalankan aplikasi dalam kontainer. Kemudian, Docker akan menghubungkan antarmuka pengguna pada perangkat mobile dengan backend seperti Web Server, MongoDB, dan Storage Server.

## Ruang Lingkup

eTOEFL adalah aplikasi berbasis mobile yang dikembangkan dengan Flutter dan memungkinkan pengguna untuk mengakses berbagai fitur dengan mudah. Kemudian, backend aplikasi menggunakan framework Laravel untuk mengatur autentikasi pengguna dan berinteraksi dengan database untuk penyimpanan dan pengambilan data. Untuk database aplikasi menggunakan MongoDB NoSQL yang berfungsi menyimpan dan mengambil data dari database serta memberikan respons terhadap permintaan pengguna. Terakhir, Server berfungsi sebagai perantara antara aplikasi mobile, backend, dan database. Server juga menerima request dari pengguna, kemudian meneruskannya ke backend dan database yang nantinya akan mengirimkan kembali respons kepada pengguna

## Desain Sistem
![1 (1)](https://github.com/user-attachments/assets/ee8e0f7c-4f41-42f8-b874-338e951e166b)

1. **Storage Server** berjalan pada port 3000 yang bertanggung jawab untuk menyimpan dan mengambil data, khususnya file atau dokumen besar yang diperlukan oleh aplikasi.

2. **Web Server Laravel** berjalan pada port 80, dikembangkan dengan framework laravel dengan peran sebagai pusat logika bisnis aplikasi dan mengelola permintaan dari frontend. Web server laravel bekerja untuk menerima permintaan dari docker engine, berkomunikasi dengan storage server untuk manajemen file, dan menjalankan operasi CRUD ke MongoDB database.

3. **MongoDB Database** berjalan pada port 27017 dan menerima permintaan dari web server larave melalui Docker Engine. MongoDB database bertugas untuk menyimpan data aplikasi dalam format NoSQL dan menjalankan operasi CRUD yang diminta oleh web server Laravel.

4. **Docker Engine** berperan sebagai perantara antara Mobile FE dan layanan backend seperti web server laravel, storage server, dan MongoDB database. Docker Engine berkomunikasi dengan Mobile FE melalui layanan backend yang sesuai, menerima permintaan, dan mengirimkan response.

5. **Mobile FE** berfungsi untuk menyajikan antarmuka pengguna yang dapat diakses melalui perangkat mobile. Mobile FE berinteraksi dengan Docker Engine untuk mengakses layanan backend dan menerima response.

## Tim dan Tugas

**Link Backlog:** https://docs.google.com/spreadsheets/d/1H3uiufmB5BPQeNi5vA3qUKwm-h5uV2LpxK4VTh3sPIg/edit?usp=sharing

<table>
    <tr>
      <th>No</th>
      <th>Bakclog</th>
      <th>ToDo</th>
      <th>Eksekutor</th>
    </tr>
    <tr>
      <td>1</td>
      <td>Mobile HomePage</td>
      <td>Slicing Card Target Score</td>
      <td>Arsyita Devanaya Arianto</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Api Target Score</td>
      <td>Arsyita Devanaya Arianto</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Chart Pie Lingkaran</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Rank User</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Card Navigasi Rank</td>
      <td>Ali Azhar P.B</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume For You List</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing For You Card</td>
      <td>Arsyita Devanaya Arianto</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Simulation Card</td>
      <td>Arsyita Devanaya Arianto</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Learning Path Category Quiz</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Learning Path Card</td>
      <td>Arsyita Devanaya Arianto</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design Card Set Target/td>
      <td>Gandi Rukmaning Ayu, Adinda Zahra Q, Mayada Azizah</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design Chart Pie Lingkaran</td>
      <td>Gandi Rukmaning Ayu</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design For You Card</td>
      <td>Mayada Azizah, Adinda Zahra Q</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design Learning Path Card</td>
      <td>Gandi Rukmaning Ayu, Mayada Azizah, Adinda Zahra Q</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design Simulation Card</td>
      <td>Adinda Zahra Q, Adinda Zahra Q</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Bottom Nav Bar</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Mobile Bookmark</td>
      <td>Slicing Card Bookmark</td>
      <td>Adam Rasyid Nurmuhammad</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Bookmark List</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design Card Bookmark</td>
      <td>Mayada Azizah, Adinda Zahra Q</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Mobile Profile</td>
      <td>Design Profile Page</td>
      <td>Gandi Rukmaning Ayu</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Profile User</td>
      <td>Shofira Izza N</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Profile Page</td>
      <td>Arsyita Devanaya Arianto</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Target Score</td>
      <td>Slicing Target Score List</td>
      <td>Adam Rasyid Nurmuhammad</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Target Score List</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design Target Score Page</td>
      <td>Mayada Azizah, Adinda Zahra Q</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Simulation Test List Page</td>
      <td>Slicing Test List Page</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume List Test Page</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Simulation Test Page</td>
      <td>Slicing Bottom Nav Bar</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design Bottom Nav Bar</td>
      <td>Mayada Azizah, Adinda Zahra Q</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing List Soal Bottom Sheet</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Design List Soal Bottom Sheet</td>
      <td>Mayada Azizah, Adinda Zahra Q</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Implementasi Logic Test Question</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Test Question Option dan Key</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Implementasi Logic Test Session</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Membuat State Management Test</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Test Result</td>
      <td>Adam Rasyid Nurmuhammad</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Logic Test Result</td>
      <td>Mahendra Khibrah R. S</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Leaderboard</td>
      <td>Design Leaderboard</td>
      <td>Gandi Rukmaning Ayu, Mayada Azizah</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Leaderboard</td>
      <td>Gandi Rukmaning Ayu</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Leaderboard</td>
      <td>Arsyita Devanaya Arianto</td>
    </tr>
    <tr>
      <td>8</td>
      <td>Quiz List Page</td>
      <td>Design Quiz List Page</td>
      <td>Gandi Rukmaning Ayu</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Quiz List Page</td>
      <td>Arsyita Devanaya Arianto, M Reza Muktasib</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Consume Quiz List Page</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td>9</td>
      <td>Quiz Page</td>
      <td>Consume Quiz Question</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Logic Take Quiz</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Logic Result</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td>10</td>
      <td>Game Page</td>
      <td>Desain Layout Game Path </td>
      <td>Gandi Rukmaning Ayu</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Slicing Layout Game Path</td>
      <td>M Reza Muktasib</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Create Logic Path Background</td>
      <td>M Reza Muktasib</td>
    </tr>
  </table>

## Tahapan Pelaksaan

 ![tahapan-pelaksanaan (2)](https://github.com/user-attachments/assets/710085be-3a3c-403d-839e-3c48b001063f)

## Implementasi

**Tahap 1: Perencanaan & Analisis (Minggu 1-2)**

Tujuan & Sasaran: Output dari tahap ini adalah dokumen yang berisi tujuan dan sasaran implementasi E-TOEFL. Dokumen ini harus jelas, terukur, dapat dicapai, relevan, dan berjangka waktu (SMART). <br>
Mengidentifikasi Target Pengguna: Output dari tahap ini adalah profil target pengguna E-TOEFL. Profil ini harus mencakup informasi demografis, kebutuhan, dan ekspektasi pengguna. <br>
Gamifikasi: Output dari tahap ini adalah desain gamifikasi yang akan diterapkan pada E-TOEFL. Desain ini harus menarik dan memotivasi pengguna untuk menyelesaikan tes. <br>
Rancangan Database: Output dari tahap ini adalah rancangan database yang akan digunakan untuk menyimpan data pengguna, hasil tes, dan informasi lainnya. <br>
Pemilihan Teknologi: Output dari tahap ini adalah pilihan teknologi yang akan digunakan untuk mengembangkan E-TOEFL. Pilihan teknologi ini harus mempertimbangkan faktor-faktor seperti skalabilitas, keamanan, dan kemudahan penggunaan.

**Tahap 2: Desain & Prototyping (Minggu 3-4)**

Desain UI/UX: Output dari tahap ini adalah desain antarmuka pengguna (UI) dan pengalaman pengguna (UX) E-TOEFL. Desain ini harus intuitif, mudah digunakan, dan estetis. <br>
Pengembangan Konten: Output dari tahap ini adalah konten tes E-TOEFL. Konten ini harus sesuai dengan standar internasional dan relevan dengan kebutuhan target pengguna.

**Tahap 3: Pengembangan & Implementasi (Minggu 5-6)**

Pengembangan FE Mobile: Output dari tahap ini adalah aplikasi mobile E-TOEFL. Aplikasi ini harus memungkinkan pengguna untuk mengikuti tes dari perangkat mobile mereka. <br>
Pengembangan BE: Output dari tahap ini adalah backend E-TOEFL. Backend ini harus bertanggung jawab untuk memproses data pengguna, hasil tes, dan informasi lainnya. <br>
Containerization Docker: Output dari tahap ini adalah container Docker untuk E-TOEFL. Container ini akan memungkinkan E-TOEFL untuk dijalankan dengan mudah di berbagai lingkungan.

**Tahap 4: Testing & Deployment (Minggu 7-8)**

Testing Installation: Output dari tahap ini adalah instalasi E-TOEFL di lingkungan produksi. Instalasi ini harus memastikan bahwa E-TOEFL berjalan dengan lancar dan aman. <br>
Functional Testing: Output dari tahap ini adalah pengujian fungsional E-TOEFL. Pengujian ini harus memastikan bahwa semua fitur E-TOEFL berfungsi dengan benar. <br>
Uji Coba: Output dari tahap ini adalah hasil uji coba E-TOEFL dengan pengguna nyata. Uji coba ini harus mengidentifikasi masalah dan bug yang masih ada. <br>
Peluncuran: Output dari tahap ini adalah peluncuran E-TOEFL ke publik. Peluncuran ini harus dilakukan dengan strategi yang tepat untuk memastikan kelancaran dan kesuksesan.

## Sistem testing

### Fungsional Testing API
![image](https://github.com/gandirayu/Administrasi_Jaringan/assets/123063394/e64aad55-9f83-44ba-b8d0-a06f0e5efd36)

## Kesimpulan

Melalui tahapan pelaksanaan ini, diharapkan aplikasi e-TOEFL dapat membantu mahasiswa PENS dalam mempersiapkan diri menghadapi tes e-TOEFL dengan lebih baik, memberikan pengalaman belajar yang dipersonalisasi, serta membuat tes e-TOEFL lebih mudah diakses. Implementasi teknologi yang tepat serta pengujian yang komprehensif akan memastikan aplikasi berjalan dengan baik dan memenuhi kebutuhan pengguna.

Penerapan teknologi Docker Engine dalam aplikasi E-TOEFL menghadirkan banyak keuntungan. Konsistensi dan efisiensi operasional terjamin, deployment dan skalabilitas menjadi mudah, serta keamanan dan keandalan aplikasi terjaga. Docker Engine mengisolasi aplikasi, membuatnya aman dan terlindungi. Image yang tidak dapat diubah memastikan aplikasi selalu berjalan dalam kondisi yang ideal. Keunggulan ini menjadikan Docker Engine sebagai alat penting dalam memastikan kelancaran dan keandalan E-TOEFL.

Keunggulan utama dari penggunaan Docker dalam proyek ini meliputi:

- **Portabilitas:** Aplikasi dapat berjalan di berbagai lingkungan tanpa perlu mengubah konfigurasi, sehingga memudahkan proses pengembangan dan deployment.
- **Isolasi Lingkungan:** Setiap container berjalan terpisah, yang memastikan tidak ada konflik antara layanan yang berbeda dan meningkatkan keamanan
- **Skalabilitas:** Dengan Docker, menambah atau mengurangi instance container dapat dilakukan dengan mudah sesuai kebutuhan, memungkinkan aplikasi untuk mengelola beban kerja yang dinamis
- **Efisiensi:** Docker memungkinkan pemanfaatan sumber daya yang lebih baik dan meminimalkan overhead yang biasanya terkait dengan virtualisasi tradisional.

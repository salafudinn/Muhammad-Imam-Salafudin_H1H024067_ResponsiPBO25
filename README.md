NAMA : MUHAMMAD IMAM SALAFUDIN

NIM : H1H024067

SHIFT AWAL : D

SHIFT AKHIR : B


PokéCare adalah sebuah aplikasi web berbasis PHP yang dirancang untuk mengelola dan melatih Pokémon, khususnya Fearow yang merupakan Pokémon tipe Flying.

Pokemon.php (Class Abstrak)
File ini adalah fondasi dari seluruh sistem Pokémon dalam aplikasi. Di dalamnya terdapat class abstrak Pokemon yang tidak dapat langsung diinstansiasi, melainkan berfungsi sebagai blueprint (cetak biru) bagi semua Pokémon spesifik. Class ini memiliki properti dasar yang wajib dimiliki oleh semua Pokémon ($name, $type, $level, $hp, $specialMove) yang dilindungi dengan visibility protected untuk menerapkan Encapsulation. Untuk berinteraksi dengan properti ini, hanya diizinkan melalui getter methods (
getName()
, 
getType()
, 
getLevel()
, 
getHP()
, 
getSpecialMove()
). Lebih lanjut, class ini memiliki dua metode abstrak yang harus diimplementasikan oleh class turunan: 
train()
 dan 
specialMoveDescription()
. Tujuannya adalah memastikan setiap tipe Pokémon memiliki cara training dan deskripsi jurus spesial yang unik, tetapi dengan struktur pemanggilan yang seragam (Polimorfisme).

FlyingTypePokemon.php (Class Perantara)
File ini berisi class FlyingTypePokemon yang merupakan turunan langsung (Inheritance) dari class abstrak Pokemon. Class ini merepresentasikan semua Pokémon bertipe Flying/Normal dan menambahkan properti spesifik $flightSpeed yang mencerminkan kecepatan terbang. Constructor-nya secara otomatis menetapkan tipe sebagai "Flying/Normal" dan menginisialisasi flight speed di 100 km/jam. Yang paling penting adalah implementasi metode 
train()
, yang menerima parameter $trainingType (Attack/Defense/Speed) dan $intensity (10-100). Metode ini menggunakan struktur switch-case untuk memberikan peningkatan yang berbeda: Attack meningkatkan level (intensity/10), HP (intensity×2), dan flight speed (intensity/2); Defense fokus pada HP maksimal (intensity×3) dengan peningkatan level lebih lambat (intensity/15); Speed memberikan boost terbesar pada flight speed (intensity×1) dan level (intensity/8). Metode ini mengembalikan array berisi data sebelum dan sesudah latihan untuk tracking. Metode 
specialMoveDescription()
 menghasilkan deskripsi dinamis yang menyertakan nama Pokémon, jurus spesial, dan kecepatan terbang aktual.

Fearow.php (Class Turunan Spesifik)
File ini berisi class Fearow yang merupakan implementasi konkret dari FlyingTypePokemon. Class ini menambahkan properti unik $wingspan (lebar sayap 1.2 meter) yang spesifik untuk Fearow. Constructor-nya langsung menetapkan Fearow dengan status awal yang telah ditentukan: nama "Fearow", Level 20, HP 165, dan jurus spesial "Drill Peck". Fearow meng-override metode 
specialMoveDescription()
 untuk memberikan deskripsi yang lebih spesifik dan dramatis: "Fearow menukik dari ketinggian dengan Drill Peck! Paruhnya yang tajam berputar seperti bor dengan kecepatan [flight speed] km/jam, mampu menembus pertahanan musuh!". Class ini juga memiliki metode unik 
intimidate()
 yang memanfaatkan properti wingspan untuk menghasilkan pesan intimidasi, menunjukkan Polimorfisme dan Encapsulation dalam action.

Manajemen Data
init.php (Session Manager & Initialization)
File ini berfungsi sebagai central configuration dan session manager untuk seluruh aplikasi. Pertama, ia memulai session PHP dan melakukan autoloading semua class yang diperlukan (Pokemon, FlyingTypePokemon, Fearow). File ini menerapkan Encapsulation melalui fungsi-fungsi utility: 
getFearow()
 untuk mengambil dan mendeserialize objek Fearow dari session, 
saveFearow()
 untuk menyimpan objek ke session, 
addTrainingHistory()
 untuk menambahkan record latihan ke awal array riwayat (menggunakan array_unshift agar yang terbaru muncul pertama), dan 
getTrainingHistory()
 untuk mengambil seluruh riwayat. Fungsi 
resetData()
 memungkinkan trainer untuk mereset Pokémon ke kondisi awal. File ini juga menangani request reset melalui query parameter ?action=reset. Yang paling penting, jika session belum memiliki data Fearow, file ini otomatis membuat instance baru dan menyimpannya, memastikan aplikasi selalu memiliki objek Pokémon yang siap digunakan.

Halaman Antarmuka Web
index.php (Halaman Beranda)
File ini adalah halaman utama dan entry point aplikasi. Pertama, ia memanggil require_once 'config/init.php' untuk memastikan session dimulai dan data Pokémon tersedia. Kemudian ia mengambil objek Fearow menggunakan 
getFearow()
. Halaman ini bertugas menampilkan profil lengkap Pokémon dengan visual yang menarik: header aplikasi "PokéCare - Pokémon Research & Training Center", avatar Fearow, nama dan tipe Pokémon, statistik dalam card (Level dan HP), special move dengan deskripsi dinamis yang dihasilkan dari 
specialMoveDescription()
, dan pesan intimidasi dari metode 
intimidate()
. Dari Beranda, pengguna dapat menavigasi ke halaman Latihan (training.php) atau Riwayat (history.php) melalui tombol action yang jelas. Halaman ini juga menyediakan tombol "Reset Level" di header untuk mengembalikan Pokémon ke kondisi awal.

training.php (Halaman Training)
Halaman ini berisi formulir interaktif di mana trainer dapat memilih Jenis Latihan (Attack/Defense/Speed) menggunakan radio button dengan ikon visual (⚡ untuk Attack, 🛡️ untuk Defense, 💨 untuk Speed) dan mengatur Intensitas Latihan (10-100) menggunakan range slider yang responsif dengan label dinamis. Halaman ini menampilkan status Pokémon saat ini (Level dan HP) sebelum latihan dimulai. Ketika formulir disubmit via POST, kode akan memanggil metode 
train()
 dari objek Fearow dengan parameter yang dipilih pengguna. Metode ini memicu perhitungan peningkatan Level dan HP sesuai dengan tipe latihan dan intensitas. Hasil latihan (berupa array dengan data sebelum dan sesudah) disimpan ke session menggunakan 
saveFearow()
 dan dicatat ke riwayat menggunakan 
addTrainingHistory()
. Data hasil kemudian disimpan dalam $_SESSION['training_result'] dan pengguna di-redirect ke halaman result.php untuk melihat hasil latihan.

result.php (Halaman Hasil Latihan)
Halaman ini menampilkan hasil latihan setelah sesi training selesai. Pertama, ia memeriksa apakah ada data $_SESSION['training_result'], jika tidak ada maka redirect ke index.php (mencegah akses langsung). Halaman ini menampilkan perbandingan visual yang jelas antara status sebelum dan sesudah latihan: Level lama → Level baru dengan indikator peningkatan (+X Level) dalam warna hijau (success), HP lama → HP baru dengan indikator peningkatan (+X HP). Halaman ini juga menampilkan deskripsi jurus spesial Pokémon yang telah diperbarui dengan flight speed terbaru. Setelah menampilkan hasil, session training_result dihapus menggunakan unset() untuk mencegah tampilan ulang. Dari halaman ini, pengguna dapat kembali ke Beranda atau melihat Riwayat lengkap.

history.php (Halaman Riwayat)
Halaman ini menampilkan catatan lengkap semua sesi latihan yang pernah dilakukan. Ia mengambil data riwayat menggunakan 
getTrainingHistory()
 dan menampilkannya dalam format list yang terstruktur. Setiap record riwayat menampilkan: badge berwarna sesuai tipe latihan (kuning untuk Attack, biru untuk Defense, cyan untuk Speed) dengan ikon dan label, timestamp lengkap kapan latihan dilakukan, perbandingan Level (sebelum → sesudah) dengan indikator peningkatan, perbandingan HP (sebelum → sesudah) dengan indikator peningkatan, dan nilai intensitas yang digunakan. Jika belum ada riwayat latihan, halaman menampilkan pesan "Belum ada riwayat latihan" dengan styling yang sesuai. Dari halaman ini, pengguna dapat kembali ke Beranda atau langsung memulai sesi latihan baru. Halaman ini menerapkan konsep data persistence dan user feedback yang baik untuk tracking progress Pokémon.

![2025-11-29 14-17-53](https://github.com/user-attachments/assets/2c0cf64b-ab63-4d01-9a9d-1f813ce62423)

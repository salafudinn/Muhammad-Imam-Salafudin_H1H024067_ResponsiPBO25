NAMA : MUHAMMAD IMAM SALAFUDIN

NIM : H1H024067

SHIFT AWAL : D

SHIFT AKHIR : B


PokéCare adalah sebuah aplikasi web berbasis PHP yang dirancang untuk mengelola dan melatih Pokémon, khususnya Fearow yang merupakan Pokémon tipe Flying.

Pokemon.php (Class Abstrak)
Class abstrak yang menjadi blueprint semua Pokémon. Memiliki properti protected ($name, $type, $level, $hp, $specialMove) dengan akses melalui getter methods. Mendefinisikan dua abstract methods (
train()
 dan 
specialMoveDescription()
) yang wajib diimplementasikan turunan untuk menerapkan Polimorfisme.

FlyingTypePokemon.php (Class Perantara)
Turunan Pokemon yang menambahkan properti $flightSpeed. Mengimplementasikan 
train()
 dengan logika berbeda per tipe: Attack (level +intensity/10, HP +intensity×2, speed +intensity/2), Defense (level +intensity/15, HP +intensity×3), Speed (level +intensity/8, HP +intensity×1.5, speed +intensity). Mengembalikan array data sebelum/sesudah untuk tracking.

Fearow.php (Class Konkret)
Implementasi spesifik dengan properti unik $wingspan. Constructor menetapkan stats awal (Level 20, HP 165, "Drill Peck"). Meng-override 
specialMoveDescription()
 dengan deskripsi dramatis dan menambahkan method 
intimidate()
 yang memanfaatkan wingspan.

Manajemen Data
init.php (Session Manager)
Mengelola session dengan fungsi utility: 
getFearow()
 (deserialize objek), 
saveFearow()
 (simpan objek), 
addTrainingHistory()
 (tambah record dengan array_unshift), 
getTrainingHistory()
 (ambil riwayat), 
resetData()
 (reset ke kondisi awal). Auto-create instance Fearow jika session kosong.

Halaman Web
index.php (Beranda)
Entry point yang menampilkan profil Pokémon: avatar, nama, tipe, statistik (Level, HP), deskripsi special move, dan pesan intimidasi. Navigasi ke Training/History dan tombol Reset.

training.php (Form Latihan)
Form dengan radio button (Attack/Defense/Speed) dan range slider (10-100). POST handler memanggil 
train()
, menyimpan hasil dengan 
saveFearow()
, mencatat ke riwayat dengan 
addTrainingHistory()
, lalu redirect ke result.php


result.php (Hasil)
Menampilkan perbandingan before/after (Level dan HP) dengan indikator peningkatan. Validasi session, tampilkan hasil, lalu unset() untuk mencegah reload.

history.php (Riwayat)
Menampilkan list semua sesi latihan dengan badge berwarna per tipe, timestamp, perbandingan stats, dan intensitas. Empty state jika kosong.

![2025-11-29 14-17-53](https://github.com/user-attachments/assets/2c0cf64b-ab63-4d01-9a9d-1f813ce62423)

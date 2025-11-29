NAMA : MUHAMMAD IMAM SALAFUDIN

NIM : H1H024067

SHIFT AWAL : D

SHIFT AKHIR : B


PokéCare adalah sebuah aplikasi web berbasis PHP yang dirancang untuk mengelola dan melatih Pokémon, khususnya Fearow yang merupakan Pokémon tipe Flying.

1. Abstraction (Pokemon.php)
Class 
Pokemon
 adalah abstract class yang berfungsi sebagai blueprint. Class ini tidak dapat diinstansiasi langsung, tetapi mendefinisikan struktur dasar dengan properti ($name, $type, $level, $hp, $specialMove) dan dua abstract methods (
train()
 dan 
specialMoveDescription()
) yang wajib diimplementasikan oleh class turunan.

2. Inheritance (Pewarisan)
Terdapat hierarki pewarisan bertingkat: 
Pokemon
 → 
FlyingTypePokemon
 → 
Fearow
. Class 
FlyingTypePokemon
 mewarisi dari 
Pokemon
 dan menambahkan properti spesifik $flightSpeed. Class 
Fearow
 mewarisi dari 
FlyingTypePokemon
 dan menambahkan properti unik $wingspan. Setiap level pewarisan menambahkan spesialisasi sambil mempertahankan struktur dasar dari parent class.

3. Encapsulation
Semua properti dideklarasikan sebagai protected atau private, sehingga tidak dapat diakses langsung dari luar class. Akses ke properti hanya melalui getter methods (
getName()
, 
getType()
, 
getLevel()
, 
getHP()
, 
getSpecialMove()
, 
getFlightSpeed()
, 
getWingspan()
). Ini melindungi data internal dan mengontrol bagaimana data diakses.

4. Polymorphism (Polimorfisme)
Metode 
specialMoveDescription()
 diimplementasikan berbeda di setiap level: 
FlyingTypePokemon
 memberikan deskripsi generik untuk tipe Flying, sedangkan 
Fearow
 meng-override dengan deskripsi spesifik "Drill Peck". Metode 
train()
 juga menunjukkan polimorfisme dengan memberikan hasil berbeda berdasarkan $trainingType (Attack/Defense/Speed), meskipun dipanggil dengan interface yang sama.

5. Constructor Chaining
Constructor 
Fearow
 memanggil parent::__construct() dari 
FlyingTypePokemon
, yang kemudian memanggil parent::__construct() dari 
Pokemon
. Ini memastikan inisialisasi properti dilakukan secara bertahap dari class paling dasar hingga paling spesifik.

Dengan struktur OOP ini, aplikasi dapat dengan mudah diperluas untuk menambahkan Pokémon baru (misalnya Pidgeot, Articuno) dengan mewarisi dari 
FlyingTypePokemon
, atau bahkan membuat tipe Pokémon baru (misalnya WaterTypePokemon) dengan mewarisi dari 
Pokemon
.

![2025-11-29 14-17-53](https://github.com/user-attachments/assets/2c0cf64b-ab63-4d01-9a9d-1f813ce62423)

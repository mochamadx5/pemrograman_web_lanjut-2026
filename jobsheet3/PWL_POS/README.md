# Laporan Praktikum - Jobsheet 3: Migration, Seeder, DB Façade, Query Builder, dan Eloquent ORM

---

## Identitas Mahasiswa
* **Nama:** Mochamad Reza Firdaus
* **NIM:** 244107020104
* **Kelas:** TI-2F
* **Project:** PWL_POS

---

## Praktikum 1 - Pengaturan Database
**Set up database**
![File env](img/1.png)
![Database file](img/2.png)

### Hasil Pengamatan
* Konfigurasi database pada file `.env` telah disesuaikan dengan pengaturan MySQL lokal.
* [cite_start]`APP_KEY` telah di-generate menggunakan perintah `php artisan key:generate`[cite: 41, 548].

---

## Praktikum 2 - Migration
[cite_start]Migration digunakan untuk mengelola struktur tabel database melalui kode program secara efisien[cite: 91].

### Praktikum 2.1 - Pembuatan File Migrasi Tanpa Relasi
[cite_start]Pembuatan tabel utama yang tidak memiliki *Foreign Key* terlebih dahulu[cite: 159].
1.  [cite_start]**Tabel `m_level`**: Menyimpan data level pengguna[cite: 247].
2.  [cite_start]**Tabel `m_kategori`**: Menyimpan kategori produk[cite: 307].
3.  [cite_start]**Tabel `m_supplier`**: Menyimpan data pemasok barang[cite: 307].

### Praktikum 2.2 - Pembuatan File Migrasi Dengan Relasi
[cite_start]Pembuatan tabel yang memiliki ketergantungan data (*Foreign Key*)[cite: 309].
1.  [cite_start]**Tabel `m_user`**: Berelasi dengan `m_level` melalui `level_id`[cite: 311].
2.  [cite_start]**Tabel `m_barang`**: Berelasi dengan `m_kategori` dan `m_supplier`[cite: 321].
3.  [cite_start]**Tabel `t_stok`**, **`t_penjualan`**, dan **`t_penjualan_detail`**[cite: 321].

**Screenshot Hasil Migration di HeidiSQL/phpMyAdmin:**
> ![Screenshot Migration](link_gambar_kamu_disini)

---

## Praktikum 3 - Seeder
[cite_start]Seeder digunakan untuk mengisi database dengan data awal atau data *dummy* agar aplikasi siap digunakan untuk pengujian[cite: 331, 332].

### Hasil Pengamatan
* [cite_start]Berhasil memasukkan data awal ke tabel `m_level` dan `m_user` melalui perintah `php artisan db:seed`[cite: 336, 353].
* Data password telah dienkripsi menggunakan `Hash::make()` demi keamanan[cite: 556].

---

## Praktikum 4 - DB Façade
Implementasi *raw query* menggunakan fitur DB Façade untuk operasi CRUD[cite: 376, 377].

### Hasil Pengamatan (LevelController)
* [cite_start]**Insert**: Menambahkan data level baru menggunakan `DB::insert()`[cite: 389, 406].
* [cite_start]**Update**: Mengubah data yang sudah ada menggunakan `DB::update()`[cite: 390, 416].
* **Delete**: Menghapus data menggunakan `DB::delete()`[cite: 397, 419].
* [cite_start]**Select**: Menampilkan data ke View menggunakan `DB::select()`[cite: 385, 424].

---

## Praktikum 5 - Query Builder
[cite_start]Implementasi operasi database menggunakan method-method yang disediakan oleh Laravel tanpa menulis SQL murni[cite: 439, 440].

### Hasil Pengamatan (KategoriController)
* Menggunakan `DB::table('m_kategori')->insert()` untuk menambah data[cite: 451, 470].
* [cite_start]Menggunakan method `where()` dan `update()` untuk mengubah data[cite: 454, 478].
* [cite_start]Menampilkan data ke view melalui objek yang lebih terstruktur dibanding raw query[cite: 465, 489].

---

## Praktikum 6 - Eloquent ORM
[cite_start]Implementasi teknik pemetaan tabel ke dalam bentuk objek (Model)[cite: 501, 502].

### Hasil Pengamatan (UserController)
* [cite_start]Dibuat file `UserModel.php` untuk merepresentasikan tabel `m_user`[cite: 512, 517].
* [cite_start]Pengambilan data dilakukan dengan memanggil `UserModel::all()` yang mengembalikan seluruh data dalam bentuk koleksi objek[cite: 523, 537].
* Operasi database menjadi lebih intuitif karena setiap baris tabel dianggap sebagai properti dari sebuah objek[cite: 501].

---

## Jawaban Pertanyaan (Penutup)
1.  **Fungsi `APP_KEY`**: Digunakan untuk enkripsi data (seperti session dan cookie) agar data aplikasi tetap aman[cite: 547].
2.  [cite_start]**Generate `APP_KEY`**: Menggunakan perintah `php artisan key:generate`[cite: 548].
3.  [cite_start]**Default Migration**: Terdapat 3 file bawaan (users, password_reset_tokens, failed_jobs)[cite: 549, 550].
4.  [cite_start]**Tujuan `timestamps()`**: Otomatis membuat kolom `created_at` dan `updated_at` untuk mencatat waktu manipulasi data[cite: 551].
5.  [cite_start]**Tipe data `id()`**: Menghasilkan tipe data *Big Integer Unsigned Auto Increment*[cite: 552].
6.  [cite_start]**Perbedaan `id()` vs `id('level_id')`**: `id()` membuat nama kolom default `id`, sedangkan `id('level_id')` secara eksplisit memberi nama kolom tersebut `level_id`[cite: 553].
7.  [cite_start]**Fungsi `unique()`**: Memastikan data pada kolom tersebut tidak ada yang kembar/duplikat[cite: 554].
8.  [cite_start]**UnsignedBigInteger vs ID**: Kolom relasi harus menggunakan `unsignedBigInteger` agar tipe datanya sama persis dengan kolom `id` di tabel induk agar relasi bisa terbentuk[cite: 555].
9.  [cite_start]**Tujuan Class Hash**: Untuk melakukan *hashing* (enkripsi satu arah) pada password pengguna agar tidak bisa dibaca dalam bentuk teks biasa[cite: 556].
10. [cite_start]**Tanda Tanya (?) pada Query**: Sebagai *placeholder* (parameter binding) untuk mencegah serangan SQL Injection[cite: 557].
11. [cite_start]**Protected `$table` dan `$primaryKey`**: Memberitahu Laravel bahwa model ini secara manual merujuk pada tabel `m_user` dan menggunakan `user_id` sebagai kunci utamanya, bukan nama default Laravel[cite: 558].
12. [cite_start]**Metode Termudah**: Eloquent ORM sering dianggap paling mudah karena sintaksnya sangat mendekati bahasa manusia dan integrasi objeknya sangat kuat di Laravel[cite: 560].
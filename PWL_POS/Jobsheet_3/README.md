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


## Praktikum 2 - Migration
**Migration**

### Praktikum 2.1 - Pembuatan File Migrasi Tanpa Relasi
[cite_start]Pembuatan tabel utama yang tidak memiliki *Foreign Key* terlebih dahulu[cite: 159].
1.  [cite_start]**Tabel `m_level`**: Menyimpan data level pengguna[cite: 247].
![level](img/3.png)
2.  [cite_start]**Tabel `m_kategori`**: Menyimpan kategori produk[cite: 307].
![kategori](img/4.png)
3.  [cite_start]**Tabel `m_supplier`**: Menyimpan data pemasok barang[cite: 307].
![supplier](img/5.png)
tampilan database
![supplier](img/6.png)

### Praktikum 2.2 - Pembuatan File Migrasi Dengan Relasi
Seluruh tabel hasil migrasi (heidiSQL), relasi sudah ada
![database dengan relasi](img/7.png)

## Praktikum 3 - Seeder
[cite_start]Seeder digunakan untuk mengisi database dengan data awal atau data *dummy* agar aplikasi siap digunakan untuk pengujian[cite: 331, 332].

### Hasil Pengamatan
* [cite_start]Berhasil memasukkan data awal ke tabel `m_level` dan `m_user` melalui perintah `php artisan db:seed`[cite: 336, 353].
Seeder untuk tabel m_level
![database dengan relasi](img/8.png)
Seeder untuk tabel m_user
![database dengan relasi](img/9.png)
Data seeder untuk table m_kategori, m_supplier, m_barang, t_stok, t_penjualan, t_penjualan_detail
![database dengan relasi](img/10.png)
![database dengan relasi](img/11.png)
![database dengan relasi](img/12.png)
![database dengan relasi](img/13.png)
![database dengan relasi](img/14.png)
![database dengan relasi](img/15.png)

---

## Praktikum 4 - DB Façade
Implementasi *raw query* menggunakan fitur DB Façade untuk operasi CRUD[cite: 376, 377].

### Hasil Pengamatan (LevelController)
* **Update dan Hapus**
![update](img/16.png)
![delete](img/17.png)

* **Menampilkan Data (view)**
![view](img/18.png)

---

## Praktikum 5 - Query Builder
* **Update dan Hapus**
![update](img/19.png)
![delete](img/20.png)

* **Menampilkan Data (view)**
![view](img/20.png)


### Hasil Pengamatan (KategoriController)
* Menggunakan `DB::table('m_kategori')->insert()` untuk menambah data.
* Menggunakan method `where()` dan `update()` untuk mengubah data.
* Menampilkan data ke view melalui objek yang lebih terstruktur dibanding raw query.

---

## Praktikum 6 - Eloquent ORM
![view](img/21.png)

### Hasil Pengamatan (UserController)
* Dibuat file `UserModel.php` untuk merepresentasikan tabel `m_user`.
* Pengambilan data dilakukan dengan memanggil `UserModel::all()` yang mengembalikan seluruh data dalam bentuk koleksi objek.
* Operasi database menjadi lebih intuitif karena setiap baris tabel dianggap sebagai properti dari sebuah objek.

---

## Jawaban Pertanyaan (Penutup)
1.  **Fungsi `APP_KEY`**: digunakan untuk enkripsi data (seperti session dan cookie) agar data aplikasi tetap aman
2. **Generate `APP_KEY`**: Menggunakan perintah `php artisan key:generate`.
3. **Default Migration**: Terdapat 3 file bawaan (users, password_reset_tokens, failed_jobs)
4. **Tujuan `timestamps()`**: Otomatis membuat kolom `created_at` dan `updated_at` untuk mencatat waktu manipulasi data.
5.  **Tipe data `id()`**: Menghasilkan tipe data *Big Integer Unsigned Auto Increment*.
6.  **Perbedaan `id()` vs `id('level_id')`**: `id()` membuat nama kolom default `id`, sedangkan `id('level_id')` secara eksplisit memberi nama kolom tersebut `level_id`
7.  **Fungsi `unique()`**: Memastikan data pada kolom tersebut tidak ada yang kembar
8.  **UnsignedBigInteger vs ID**: Kolom relasi harus menggunakan `unsignedBigInteger` agar tipe datanya sama persis dengan kolom `id` di tabel induk agar relasi bisa terbentuk.
9.  **Tujuan Class Hash**: Untuk melakukan *hashing* (enkripsi satu arah) pada password pengguna agar tidak bisa dibaca dalam bentuk teks biasa.
10. **Tanda Tanya (?) pada Query**: Sebagai *placeholder* (parameter binding) untuk mencegah serangan SQL Injection.
11. **Protected `$table` dan `$primaryKey`**: Memberitahu Laravel bahwa model ini secara manual merujuk pada tabel `m_user` dan menggunakan `user_id` sebagai kunci utamanya, bukan nama default Laravel
12. **Metode Termudah**: Eloquent ORM sering dianggap paling mudah karena sintaksnya sangat mendekati bahasa manusia dan integrasi objeknya sangat kuat di Laravel[cite: 560].
# Laporan Praktikum Pemrograman Web Lanjut - Pertemuan 7, 8, dan 9

## Deskripsi
Dokumen ini memuat dokumentasi langkah-langkah instalasi dan konfigurasi Filament untuk modul **Product**. Konfigurasi ini mencakup pembuatan form multi-tahap (Wizard Form), pengaturan halaman detail (*read-only* Info List), serta pengelompokan informasi menggunakan tata letak Tabs.

---

## 1. Pertemuan 7: Implementasi Wizard Form (Multi Step Form)
Pada tahap ini, *form* input produk diubah menjadi berjenjang agar lebih rapi dan ramah pengguna.
- **Membuat Migration & Model Product:** Menyiapkan struktur tabel `products` (name, sku, description, price, stock, image, is_active, is_featured) beserta *casting* tipe data otomatis.
- **Membuat Resource Product:** Melakukan *generate* `ProductResource` pada Filament.
- **Mengonfigurasi Wizard Form:** Membagi form `Create` dan `Edit` menjadi 3 langkah (*Step*):
  1. Product Info
  2. Pricing & Stock
  3. Media & Status
- **Kustomisasi Tombol Submit:** Menonaktifkan tombol simpan *default* bawaan halaman dan memindahkannya secara kustom ke langkah terakhir di dalam Wizard.

### Dokumentasi Tampilan Wizard Form Product
- Tampilan Database
![database](img/11.png)

- Tampilan Post
![database](img/12.png)

- Tampilan Product
![database](img/13.png)
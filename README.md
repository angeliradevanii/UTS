# Posyandu KIA (Laravel 13 + Tailwind 4)

Aplikasi mini **pencatatan pemantauan balita Posyandu** dengan **CRUD** (buat, baca, ubah, hapus) dan antarmuka **Tailwind CSS** (Vite + `@tailwindcss/vite` v4).

Data yang dicatat per baris: identitas balita & ibu, tanggal lahir, tanggal kunjungan, berat/tinggi (dan lingkar kepala opsional), imunisasi/intervensi, **status gizi** (baik, kurang, obesitas, stunting), serta catatan kader.

## Prasyarat

- PHP **8.3+**
- Composer
- Node.js **20+** dan npm

## Setup lokal

```bash
cd posyandu
composer install
cp .env.example .env          # macOS / Linux / Git Bash
# copy .env.example .env      # Windows CMD
# Copy-Item .env.example .env # Windows PowerShell
php artisan key:generate
```

Buat database SQLite:

```bash
New-Item -ItemType File database\database.sqlite -Force   # PowerShell
```

Migrasi dan contoh data:

```bash
php artisan migrate
php artisan db:seed
```

Frontend:

```bash
npm install
npm run dev
```

Server:

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` — diarahkan ke daftar **/balitas**.

## Proyek lain (tema kelurahan)

Versi **surat menyurat kelurahan** ada di folder `../surat-kelurahan` (tema dan warna UI berbeda).

## Pengumpulan UTS

Push repositori GitHub terpisah untuk tema Posyandu, atau satu repo monorepo dengan dua folder (`posyandu` dan `surat-kelurahan`) sesuai aturan dosen.

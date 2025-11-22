# Rancangan Desain UI/UX (Wireframe)

Dokumen ini memuat rancangan awal antarmuka (**Low-Fidelity Wireframe**) yang dibuat menggunakan Figma sebelum tahap pengembangan kode dimulai. Rancangan ini menjadi acuan tata letak elemen dan alur pengguna (*user flow*).

---

## 1. Manajemen Peserta (Students)

Halaman ini dirancang dengan layout **Split View**.
* **Kiri:** Formulir untuk input data peserta baru (Sticky/Tetap).
* **Kanan:** Daftar peserta yang sudah terdaftar dalam bentuk list card.

![Wireframe Peserta](/docs/skillhub-wireframe-01.png)

---

## 2. Manajemen Kelas (Courses)

Serupa dengan halaman peserta, halaman ini menggunakan layout responsif.
* **Kiri:** Formulir pembuatan kelas baru.
* **Kanan:** Katalog kelas ditampilkan dalam bentuk **Grid Card** agar lebih visual dan menarik.

![Wireframe Form & List Kelas](/docs/skillhub-wireframe-03.png)

---

## 3. Detail Peserta (Student Detail)

Halaman detail ketika student diklik.
* **Header:** Menampilkan Nama peserta, alamat email, dan no hp.
* **Body:** Menampilkan daftar kelas yang diikuti oleh peserta.
![Wireframe Grid Kelas](/docs/skillhub-wireframe-02.png)

---

## 4. Detail Kelas (Course Detail)

Halaman detail ketika sebuah kelas diklik.
* **Header:** Menampilkan Judul Kelas, Instruktur, dan Deskripsi lengkap.
* **Body:** Menampilkan daftar siswa yang terdaftar di kelas tersebut (Enrollment List).

![Wireframe Detail Kelas](/docs/skillhub-wireframe-04.png)

---

## 5. Pendaftaran Kelas (Enrollment)

Halaman khusus untuk menghubungkan **Siswa** dengan **Kelas**.
* Menggunakan dua *dropdown* utama: Memilih Siswa dan Memilih Kelas.
* Tombol aksi besar untuk eksekusi pendaftaran.

![Wireframe Pendaftaran](/docs/skillhub-wireframe-05.png)

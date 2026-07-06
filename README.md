# 📅 Meeting Booking System

Sistem Booking Ruang Meeting berbasis PHP Native dan MySQL.

## 🚀 Clone Repository

```bash
git clone https://github.com/fahrulfahmi/meeting-booking.git
```

Masuk ke folder project.

```bash
cd meeting-booking
```

---

# ⚙️ Konfigurasi

Pindahkan project ke folder web server.

### MAMP (macOS)

```
/Applications/MAMP/htdocs/
```

### XAMPP (Windows)

```
htdocs/
```

Jalankan Apache dan MySQL.

---

# 🗄️ Database

Buat database baru.

```sql
CREATE DATABASE meeting_booking;

USE meeting_booking;
```

---

## Create Table Users

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','employee') NOT NULL,
    employee_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## Create Table Employees

```sql
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    departemen VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_hp VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## Create Table Rooms

```sql
CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_ruangan VARCHAR(100),
    kapasitas INT,
    lokasi VARCHAR(100),
    fasilitas TEXT,
    status ENUM('Available','Maintenance') DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## Create Table Bookings

```sql
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    room_id INT NOT NULL,
    tanggal DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    keperluan TEXT,
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);
```

---

## Relasi Users dan Employees

```sql
ALTER TABLE users
ADD CONSTRAINT fk_user_employee
FOREIGN KEY (employee_id)
REFERENCES employees(id)
ON DELETE SET NULL;
```

---

# 📥 Data Awal

## Ruangan

```sql
INSERT INTO rooms
(nama_ruangan,kapasitas,lokasi,fasilitas,status)
VALUES
('Ruang Garuda',12,'Lantai 1','Proyektor, TV, AC, Whiteboard','Available'),
('Ruang Merpati',8,'Lantai 2','TV, AC','Available'),
('Ruang Elang',20,'Lantai 3','Proyektor, Sound System, Whiteboard','Available');
```

---

## Karyawan

```sql
INSERT INTO employees
(nama,departemen,email,no_hp)
VALUES
('Budi Santoso','IT','budi@company.com','081234567890'),
('Siti Aisyah','HRD','siti@company.com','081234567891'),
('Andi Saputra','Finance','andi@company.com','081234567892');
```

---

# 👤 Membuat Admin

Jalankan file berikut melalui browser:

```
http://localhost:8888/meeting-booking/create_admin.php
```

Setelah akun admin berhasil dibuat, hapus file tersebut demi keamanan.

---

# 🔑 Login

**Admin**

```
Email    : admin@meeting.com
Password : admin123
```

Employee dapat dibuat melalui menu **Data Karyawan** oleh Admin.

---

# ▶️ Menjalankan Aplikasi

Buka browser.

```
http://localhost:8888/meeting-booking
```

---

# ✨ Fitur

- Login Authentication
- Dashboard
- CRUD Data Ruangan
- CRUD Data Karyawan
- CRUD Booking
- Approval Booking
- Role Admin
- Role Employee
- Validasi Jadwal Meeting
- Session Login
- Password Hashing
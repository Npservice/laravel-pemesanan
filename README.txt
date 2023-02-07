#user

//admin
username: admin
password: 12345678

//manager / pihak menyetujui 1
username: manager
password: 12345678

//HRD / pihak menyetujui 2
username: human
password: 12345678

#Database

versi database: 10.4.27-MariaDB
nama database: project
username db: root
password db: 

#php 
 versi php: 8.2.1

#freamwork

laravel 9

#panduan pemesanan

-admin menginput data pemesanan di menu "pemesanan"->"input Pemesanan"
-admin dapat memberikan driver dan kendaraan dengan status siap
-setelah data pemesanan diinput admin menungu persetujuan dari pihhak manager dan hrd
-manager memberikan persetujuan di menu "pemesanan"->"data pemesanan" ditabel bagian opsi dengan login sebagai "manager"
-apabila manager memeberikan opsi "tidak setuju" maka otomatis pemesanan kendaraan gagal dan field "keterangan"  yang semula "menungu" menjadi "gagal"
-apabila manager memberikan opsi "setuju" maka pemesenan akan menungu persetujuan dari HRD,
-kemudian HRD memberikan persetujuan dengan login sebagai HRD
-apabila manager tidak memberikan opsi "setuju" maka HRD belum bisa memberikan persetujuan
-apabila HRD memberikan opsi "setuju" makan field "keterangan" berubah menjadi "berhasil"
-apabila HRD memberikan opsi "tidak setuju" maka field "keterangan" berubah menjadi "gagal"

#pandaun laporan 

-laporan dapat langsung didownload dalam bentuk excel di menu "pemesanan"->"laporan pemesanan"

#NB

-user Admin dapat menapulasi data dan mendapatkan akses penuh di aplikasi
-user HRD dan Manager hanya dapat melihat data "kendaraan","driver","pemesanan"
-persetujuan hanya dapat dilakukan oleh HRD dan Manager 



 

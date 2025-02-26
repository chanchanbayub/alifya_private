<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Users\UsersController::index');
// $routes->get('/mitra_pengajar', 'Users\UsersController::mitra_pengajar');
// $routes->get('/peserta_didik', 'Users\UsersController::peserta_didik');
$routes->get('/daftar_mitra_pengajar', 'Users\UsersController::daftar_mitra');
$routes->get('/daftar_peserta_didik', 'Users\UsersController::daftar_peserta_didik');
$routes->post('/daftar_mitra_pengajar/insert', 'Users\UsersController::daftar_mitra_pengajar');
$routes->post('/daftar_peserta_didik/insert', 'Users\UsersController::daftar_peserta');

$routes->get('/profil', 'Users\ProfilController::index');
$routes->get('/program_belajar', 'Users\ProgramBelajarController::index');
$routes->get('/materi_belajar', 'Users\MateriBelajarController::index');
$routes->get('/getMateriBelajar', 'Users\MateriBelajarController::getMateriBelajar');

$routes->group('admin', static function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');

    $routes->get('role_management', 'Admin\RoleManagementController::index');
    $routes->post('role_management/insert', 'Admin\RoleManagementController::insert');
    $routes->get('role_management/edit', 'Admin\RoleManagementController::edit');
    $routes->post('role_management/update', 'Admin\RoleManagementController::update');
    $routes->post('role_management/delete', 'Admin\RoleManagementController::delete');

    $routes->get('jenis_media_belajar', 'Admin\JenisMediaBelajarController::index');
    $routes->post('jenis_media_belajar/insert', 'Admin\JenisMediaBelajarController::insert');
    $routes->get('jenis_media_belajar/edit', 'Admin\JenisMediaBelajarController::edit');
    $routes->post('jenis_media_belajar/update', 'Admin\JenisMediaBelajarController::update');
    $routes->post('jenis_media_belajar/delete', 'Admin\JenisMediaBelajarController::delete');

    $routes->get('user_management', 'Admin\UserManagementController::index');
    $routes->post('user_management/insert', 'Admin\UserManagementController::insert');
    $routes->get('user_management/getMitra', 'Admin\UserManagementController::getMitra');
    $routes->get('user_management/edit', 'Admin\UserManagementController::edit');
    $routes->post('user_management/update', 'Admin\UserManagementController::update');
    $routes->post('user_management/delete', 'Admin\UserManagementController::delete');

    $routes->get('klaim_media_belajar', 'Admin\KlaimMediaPesertaController::index');
    $routes->post('klaim_media_belajar/insert', 'Admin\KlaimMediaPesertaController::insert');
    $routes->get('klaim_media_belajar/edit', 'Admin\KlaimMediaPesertaController::edit');
    $routes->post('klaim_media_belajar/update', 'Admin\KlaimMediaPesertaController::update');
    $routes->post('klaim_media_belajar/delete', 'Admin\KlaimMediaPesertaController::delete');
    $routes->post('klaim_media_belajar/getDataHargaMedia', 'Admin\KlaimMediaPesertaController::getDataHargaMedia');
    $routes->post('klaim_media_belajar/update_media_belajar', 'Admin\KlaimMediaPesertaController::update_media');

    $routes->get('klaim_lain_lain', 'Admin\KlaimLainLainMitraController::index');
    $routes->post('klaim_lain_lain/insert', 'Admin\KlaimLainLainMitraController::insert');
    $routes->get('klaim_lain_lain/edit', 'Admin\KlaimLainLainMitraController::edit');
    $routes->post('klaim_lain_lain/update', 'Admin\KlaimLainLainMitraController::update');
    $routes->post('klaim_lain_lain/delete', 'Admin\KlaimLainLainMitraController::delete');
    $routes->post('klaim_lain_lain/getLainLain', 'Admin\KlaimLainLainMitraController::getLainLain');
    $routes->post('klaim_lain_lain/lain_lain_perbulan', 'Admin\KlaimLainLainMitraController::getLainLainPerbulan');
    $routes->post('klaim_lain_lain/update_lain_lain', 'Admin\KlaimLainLainMitraController::update_lain_lain');


    $routes->get('harga', 'Admin\HargaController::index');
    $routes->post('harga/update_harga', 'Admin\HargaController::update_harga');
    $routes->post('harga/insert', 'Admin\HargaController::insert');
    $routes->get('harga/edit', 'Admin\HargaController::edit');
    $routes->post('harga/update', 'Admin\HargaController::update');
    $routes->post('harga/delete', 'Admin\HargaController::delete');
    $routes->post('harga/getDataHarga', 'Admin\HargaController::getDataHarga');
    $routes->post('harga/harga_perbulan', 'Admin\HargaController::harga_perbulan');

    $routes->get('kelompok', 'Admin\KelompokController::index');
    $routes->post('kelompok/insert', 'Admin\KelompokController::insert');
    $routes->get('kelompok/view/(:any)', 'Admin\KelompokController::views/$1');
    $routes->get('kelompok/edit', 'Admin\KelompokController::edit');
    $routes->post('kelompok/update', 'Admin\KelompokController::update');
    $routes->post('kelompok/delete', 'Admin\KelompokController::delete');

    $routes->get('paket_belajar', 'Admin\PaketBelajarController::index');
    $routes->post('paket_belajar/insert', 'Admin\PaketBelajarController::insert');
    $routes->get('paket_belajar/edit', 'Admin\PaketBelajarController::edit');
    $routes->post('paket_belajar/update', 'Admin\PaketBelajarController::update');
    $routes->post('paket_belajar/delete', 'Admin\PaketBelajarController::delete');

    $routes->get('program_belajar', 'Admin\ProgramBelajarController::index');
    $routes->post('program_belajar/insert', 'Admin\ProgramBelajarController::insert');
    $routes->get('program_belajar/edit', 'Admin\ProgramBelajarController::edit');
    $routes->post('program_belajar/update', 'Admin\ProgramBelajarController::update');
    $routes->post('program_belajar/delete', 'Admin\ProgramBelajarController::delete');

    $routes->get('alat_pengajaran', 'Admin\AlatPengajaranController::index');
    $routes->post('alat_pengajaran/insert', 'Admin\AlatPengajaranController::insert');
    $routes->get('alat_pengajaran/edit', 'Admin\AlatPengajaranController::edit');
    $routes->post('alat_pengajaran/update', 'Admin\AlatPengajaranController::update');
    $routes->post('alat_pengajaran/delete', 'Admin\AlatPengajaranController::delete');

    $routes->get('alat_tim', 'Admin\AlatTimController::index');
    $routes->post('alat_tim/insert', 'Admin\AlatTimController::insert');
    $routes->get('alat_tim/edit', 'Admin\AlatTimController::edit');
    $routes->post('alat_tim/update', 'Admin\AlatTimController::update');
    $routes->post('alat_tim/delete', 'Admin\AlatTimController::delete');

    $routes->get('materi_belajar', 'Admin\MateriBelajarController::index');
    $routes->post('materi_belajar/insert', 'Admin\MateriBelajarController::insert');
    $routes->get('materi_belajar/edit', 'Admin\MateriBelajarController::edit');
    $routes->post('materi_belajar/update', 'Admin\MateriBelajarController::update');
    $routes->post('materi_belajar/delete', 'Admin\MateriBelajarController::delete');

    $routes->get('status_pengajar', 'Admin\StatusPengajarController::index');
    $routes->post('status_pengajar/insert', 'Admin\StatusPengajarController::insert');
    $routes->get('status_pengajar/edit', 'Admin\StatusPengajarController::edit');
    $routes->post('status_pengajar/update', 'Admin\StatusPengajarController::update');
    $routes->post('status_pengajar/delete', 'Admin\StatusPengajarController::delete');

    $routes->get('hari_belajar', 'Admin\HariBelajarController::index');
    $routes->post('hari_belajar/insert', 'Admin\HariBelajarController::insert');
    $routes->get('hari_belajar/edit', 'Admin\HariBelajarController::edit');
    $routes->post('hari_belajar/update', 'Admin\HariBelajarController::update');
    $routes->post('hari_belajar/delete', 'Admin\HariBelajarController::delete');

    $routes->get('jadwal_tetap', 'Admin\JadwalTetapController::index');
    $routes->post('jadwal_tetap/insert', 'Admin\JadwalTetapController::insert');
    $routes->get('jadwal_tetap/edit', 'Admin\JadwalTetapController::edit');
    $routes->post('jadwal_tetap/update', 'Admin\JadwalTetapController::update');
    $routes->post('jadwal_tetap/delete', 'Admin\JadwalTetapController::delete');
    $routes->get('jadwal_tetap/getPesertaDidik', 'Admin\JadwalTetapController::getPesertaDidik');

    $routes->get('data_pengajar', 'Admin\PengajarController::index');
    $routes->get('data_pengajar/ulang_tahun', 'Admin\PengajarController::ulang_tahun');
    $routes->post('data_pengajar/data_ulang_tahun_mitra', 'Admin\PengajarController::data_ulang_tahun_mitra');
    $routes->post('data_pengajar/insert', 'Admin\PengajarController::insert');
    $routes->get('data_pengajar/edit', 'Admin\PengajarController::edit');
    $routes->post('data_pengajar/update', 'Admin\PengajarController::update');
    $routes->post('data_pengajar/delete', 'Admin\PengajarController::delete');
    $routes->get('data_pengajar/view/(:any)', 'Admin\PengajarController::view/$1');

    $routes->get('kontrak_mitra', 'Admin\KontrakMitraController::index');
    $routes->post('kontrak_mitra/insert', 'Admin\KontrakMitraController::insert');
    $routes->get('kontrak_mitra/edit', 'Admin\KontrakMitraController::edit');
    $routes->post('kontrak_mitra/update', 'Admin\KontrakMitraController::update');
    $routes->post('kontrak_mitra/delete', 'Admin\KontrakMitraController::delete');
    $routes->post('kontrak_mitra/kontrak_perbulan', 'Admin\KontrakMitraController::kontrak_perbulan');

    $routes->get('harga_mitra', 'Admin\HargaMitraController::index');
    $routes->post('harga_mitra/insert', 'Admin\HargaMitraController::insert');
    $routes->get('harga_mitra/edit', 'Admin\HargaMitraController::edit');
    $routes->post('harga_mitra/update', 'Admin\HargaMitraController::update');
    $routes->post('harga_mitra/delete', 'Admin\HargaMitraController::delete');
    $routes->get('harga_mitra/getPesertaDidik', 'Admin\HargaMitraController::getPesertaDidik');
    $routes->post('harga_mitra/update_harga', 'Admin\HargaMitraController::update_harga');

    $routes->get('status_murid', 'Admin\StatusMuridController::index');
    $routes->post('status_murid/insert', 'Admin\StatusMuridController::insert');
    $routes->get('status_murid/edit', 'Admin\StatusMuridController::edit');
    $routes->post('status_murid/update', 'Admin\StatusMuridController::update');
    $routes->post('status_murid/delete', 'Admin\StatusMuridController::delete');

    $routes->get('data_murid', 'Admin\MuridController::index');
    $routes->get('data_murid/getMateriBelajar', 'Admin\MuridController::getMateriBelajar');
    $routes->post('data_murid/insert', 'Admin\MuridController::insert');
    $routes->get('data_murid/edit', 'Admin\MuridController::edit');
    $routes->post('data_murid/update', 'Admin\MuridController::update');
    $routes->post('data_murid/delete', 'Admin\MuridController::delete');
    $routes->get('data_murid/ulang_tahun_murid', 'Admin\MuridController::ulang_tahun');
    $routes->post('data_murid/data_ulang_tahun_murid', 'Admin\MuridController::data_ulang_tahun_murid');
    $routes->get('data_murid/view/(:any)', 'Admin\MuridController::view/$1');

    $routes->get('kontrak_peserta', 'Admin\KontrakPesertaController::index');
    $routes->post('kontrak_peserta/insert', 'Admin\KontrakPesertaController::insert');
    $routes->get('kontrak_peserta/edit', 'Admin\KontrakPesertaController::edit');
    $routes->post('kontrak_peserta/update', 'Admin\KontrakPesertaController::update');
    $routes->post('kontrak_peserta/delete', 'Admin\KontrakPesertaController::delete');
    $routes->post('kontrak_peserta/kontrak_perbulan', 'Admin\KontrakPesertaController::kontrak_perbulan');

    $routes->get('kelompok_belajar', 'Admin\KelompokBelajarController::index');
    $routes->post('kelompok_belajar/insert', 'Admin\KelompokBelajarController::insert');
    $routes->get('kelompok_belajar/edit', 'Admin\KelompokBelajarController::edit');
    $routes->post('kelompok_belajar/update', 'Admin\KelompokBelajarController::update');
    $routes->post('kelompok_belajar/delete', 'Admin\KelompokBelajarController::delete');

    $routes->get('presensi', 'Admin\PresensiController::index');
    $routes->post('presensi/insert', 'Admin\PresensiController::insert');
    $routes->get('presensi/edit', 'Admin\PresensiController::edit');
    $routes->post('presensi/update', 'Admin\PresensiController::update');
    $routes->post('presensi/delete', 'Admin\PresensiController::delete');
    $routes->get('presensi/getPesertaDidik', 'Admin\PresensiController::getPesertaDidik');

    $routes->get('presensi_harian', 'Admin\PresensiController::presensi_harian');
    $routes->get('presensi_bulanan', 'Admin\PresensiController::presensi_bulanan');
    $routes->get('presensi/getPresensiPerbulan', 'Admin\PresensiController::getPresensiPerbulan');


    $routes->get('absensi', 'Admin\AbsensiController::index');
    $routes->post('absensi/insert', 'Admin\AbsensiController::insert');
    $routes->get('absensi/edit', 'Admin\AbsensiController::edit');
    $routes->post('absensi/update', 'Admin\AbsensiController::update');
    $routes->post('absensi/delete', 'Admin\AbsensiController::delete');
    $routes->get('absensi/getPesertaDidik', 'Admin\AbsensiController::getPesertaDidik');

    $routes->get('invoice', 'Admin\InvoiceController::index');
    $routes->get('invoice/cetak_invoice/(:any)', 'Admin\InvoiceController::cetak_invoice/$1');
    $routes->post('invoice/cek_invoice', 'Admin\InvoiceController::cek_invoice');
    $routes->get('invoice/getPesertaDidik', 'Admin\InvoiceController::getPesertaDidik');
    $routes->get('invoice/getHargaPeserta', 'Admin\InvoiceController::getHargaPeserta');

    $routes->get('invoice_mitra', 'Admin\InvoiceMitraController::index');
    $routes->post('invoice_mitra/cek_invoice', 'Admin\InvoiceMitraController::cek_invoice');
    $routes->get('invoice_mitra/getPesertaDidik', 'Admin\InvoiceMitraController::getPesertaDidik');

    // invoice orang tua
    $routes->get('cetak_invoice/pdf', 'PDF\PdfController::index');
    $routes->get('cetak_invoice/pdf/(:any)', 'PDF\PdfController::invoice_peserta_didik/$1');
    // invoice mitra
    $routes->get('invoice_mitra/pdf/(:any)', 'PDF\PdfController::mitra/$1');


    // export excel peserta

    $routes->get('export_excel/', 'Excel\ExcelController::index');
});

$routes->group('auth', static function ($routes) {

    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('cek_login', 'Auth\LoginController::cek_login');
    $routes->get('logout', 'Auth\LoginController::logout');
});

$routes->group('mitra_pengajar', static function ($routes) {
    $routes->get('dashboard', 'Mitra\DashboardController::index');

    $routes->get('materi_belajar', 'Mitra\MateriBelajarController::index');

    $routes->get('jadwal_tetap', 'Mitra\JadwalTetapController::index');
    $routes->post('jadwal_tetap/insert', 'Mitra\JadwalTetapController::insert');
    $routes->get('jadwal_tetap/edit', 'Mitra\JadwalTetapController::edit');
    $routes->post('jadwal_tetap/update', 'Mitra\JadwalTetapController::update');
    $routes->post('jadwal_tetap/delete', 'Mitra\JadwalTetapController::delete');
    $routes->get('jadwal_tetap/getPesertaDidik', 'Mitra\JadwalTetapController::getPesertaDidik');

    $routes->get('data_pengajar', 'Mitra\PengajarController::index');
    $routes->get('data_pengajar/edit', 'Mitra\PengajarController::edit');
    $routes->post('data_pengajar/update', 'Mitra\PengajarController::update');
    $routes->get('data_pengajar/view/(:any)', 'Mitra\PengajarController::view/$1');

    $routes->get('media_belajar', 'Mitra\KlaimMediaPesertaController::index');
    $routes->post('media_belajar/insert', 'Mitra\KlaimMediaPesertaController::insert');
    $routes->post('media_belajar/getDataHargaMedia', 'Mitra\KlaimMediaPesertaController::getDataHargaMedia');

    $routes->get('kelompok', 'Mitra\KelompokController::index');
    $routes->get('kelompok/view/(:any)', 'Mitra\KelompokController::views/$1');

    $routes->get('data_murid', 'Mitra\MuridController::index');
    $routes->get('data_murid/view/(:any)', 'Mitra\MuridController::view/$1');
    $routes->get('data_murid/edit', 'Mitra\MuridController::edit');
    $routes->post('data_murid/update', 'Mitra\MuridController::update');


    $routes->get('presensi', 'Mitra\PresensiController::index');
    $routes->post('presensi/insert', 'Mitra\PresensiController::insert');
    $routes->get('presensi/edit', 'Mitra\PresensiController::edit');
    $routes->post('presensi/update', 'Mitra\PresensiController::update');
    $routes->post('presensi/delete', 'Mitra\PresensiController::delete');
    $routes->get('presensi/getPesertaDidik', 'Mitra\PresensiController::getPesertaDidik');

    $routes->get('absensi', 'Mitra\AbsensiController::index');
    $routes->post('absensi/insert', 'Mitra\AbsensiController::insert');
    $routes->get('absensi/edit', 'Mitra\AbsensiController::edit');
    $routes->post('absensi/update', 'Mitra\AbsensiController::update');
    $routes->post('absensi/delete', 'Mitra\AbsensiController::delete');
    $routes->get('absensi/getPesertaDidik', 'Mitra\AbsensiController::getPesertaDidik');

    $routes->get('alat_pengajaran', 'Mitra\AlatPengajaranController::index');
});

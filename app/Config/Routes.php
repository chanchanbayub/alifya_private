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

    $routes->get('user_management', 'Admin\UserManagementController::index');
    $routes->post('user_management/insert', 'Admin\UserManagementController::insert');
    $routes->get('user_management/getMitra', 'Admin\UserManagementController::getMitra');
    $routes->get('user_management/edit', 'Admin\UserManagementController::edit');
    $routes->post('user_management/update', 'Admin\UserManagementController::update');
    $routes->post('user_management/delete', 'Admin\UserManagementController::delete');

    $routes->get('harga', 'Admin\HargaController::index');
    $routes->post('harga/insert', 'Admin\HargaController::insert');
    $routes->get('harga/edit', 'Admin\HargaController::edit');
    $routes->post('harga/update', 'Admin\HargaController::update');
    $routes->post('harga/delete', 'Admin\HargaController::delete');

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
    $routes->post('data_pengajar/insert', 'Admin\PengajarController::insert');
    $routes->get('data_pengajar/edit', 'Admin\PengajarController::edit');
    $routes->post('data_pengajar/update', 'Admin\PengajarController::update');
    $routes->post('data_pengajar/delete', 'Admin\PengajarController::delete');
    $routes->get('data_pengajar/view/(:any)', 'Admin\PengajarController::view/$1');

    $routes->get('harga_mitra', 'Admin\HargaMitraController::index');
    $routes->post('harga_mitra/insert', 'Admin\HargaMitraController::insert');
    $routes->get('harga_mitra/edit', 'Admin\HargaMitraController::edit');
    $routes->post('harga_mitra/update', 'Admin\HargaMitraController::update');
    $routes->post('harga_mitra/delete', 'Admin\HargaMitraController::delete');
    $routes->get('harga_mitra/getPesertaDidik', 'Admin\HargaMitraController::getPesertaDidik');

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
    $routes->get('data_murid/view/(:any)', 'Admin\MuridController::view/$1');

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

    $routes->get('absensi', 'Admin\AbsensiController::index');
    $routes->post('absensi/insert', 'Admin\AbsensiController::insert');
    $routes->get('absensi/edit', 'Admin\AbsensiController::edit');
    $routes->post('absensi/update', 'Admin\AbsensiController::update');
    $routes->post('absensi/delete', 'Admin\AbsensiController::delete');
    $routes->get('absensi/getPesertaDidik', 'Admin\AbsensiController::getPesertaDidik');

    $routes->get('invoice', 'Admin\InvoiceController::index');
    $routes->post('invoice/cek_invoice', 'Admin\InvoiceController::cek_invoice');
    $routes->get('invoice/getPesertaDidik', 'Admin\InvoiceController::getPesertaDidik');
    $routes->get('invoice/getHargaPeserta', 'Admin\InvoiceController::getHargaPeserta');

    $routes->get('invoice_mitra', 'Admin\InvoiceMitraController::index');
    $routes->post('invoice_mitra/cek_invoice', 'Admin\InvoiceMitraController::cek_invoice');
    $routes->get('invoice_mitra/getPesertaDidik', 'Admin\InvoiceMitraController::getPesertaDidik');

    // invoice orang tua
    $routes->get('cetak_invoice/pdf', 'PDF\PdfController::index');
    // invoice mitra
    $routes->get('invoice_mitra/pdf/(:any)', 'PDF\PdfController::mitra/$1');
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
    $routes->get('data_pengajar/view/(:any)', 'Admin\PengajarController::view/$1');

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

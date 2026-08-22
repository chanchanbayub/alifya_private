<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="pagetitle">
    <h1><?= $title ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">|</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Recent Sales -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Aksi</h6>
                                </li>
                                <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-plus"></i> Tambah <?= $title ?></a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $title ?> <span>| Table </span></h5>
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Mitra Pengajar</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($absensi as $absensi) : ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?= $no++ ?>.</a></th>
                                            <td> <?= tanggal_indonesia(date('Y-m-d', strtotime($absensi->tanggal))) ?>, <?= date_indo(date('Y-m-d', strtotime($absensi->tanggal))) ?></td>
                                            <td> <?= $absensi->nama_lengkap ?></td>
                                            <td><?= $absensi->keterangan ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>

<!-- modal save-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_form">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="date" class="col-form-label">Tanggal :</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <div class="invalid-feedback error-tanggal">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mitra_pengajar_id" class="col-form-label">Mitra Pengajar :</label>
                        <select name="mitra_pengajar_id" id="mitra_pengajar_id" class="form-select">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="<?= $mitra_pengajar->id ?>"><?= $mitra_pengajar->nama_lengkap ?></option>
                        </select>
                        <div class="invalid-feedback error-mitra-pengajar">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="keterangan" class="col-form-label">Keterangan :</label>
                        <textarea name="keterangan" id="keterangan" class="form-control">Tulis tanggal pengganti. Jika tidak ada, jelaskan alasannya</textarea>
                        <div class="invalid-feedback error-keterangan">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Batal</button>
                        <button type="submit" class="btn btn-outline-success save"> <i class="bi bi-arrow-right"></i> Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Save -->

<!-- View Modal -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(e) {

        $('#mitra_pengajar_id').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#exampleModal')
        });

        $('#mitra_pengajar_id_edit').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#editModal')
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();

            let tanggal = $("#tanggal").val();
            let mitra_pengajar_id = $("#mitra_pengajar_id").val();
            let keterangan = $("#keterangan").val();

            $.ajax({
                url: '/mitra_pengajar/absensi_ahl/insert',
                method: 'post',
                dataType: 'JSON',
                data: {
                    tanggal: tanggal,
                    mitra_pengajar_id: mitra_pengajar_id,
                    keterangan: keterangan,
                },
                beforeSend: function() {
                    $('.save').html("<span class='spinner-border spinner-border-sm' role='harga' aria-hidden='true'></span>Loading...");
                    $('.save').prop('disabled', true);
                },
                success: function(response) {
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                    if (response.error) {
                        if (response.error.tanggal) {
                            $("#tanggal").addClass('is-invalid');
                            $(".error-tanggal").html(response.error.tanggal);
                        } else {
                            $("#tanggal").removeClass('is-invalid');
                            $(".error-tanggal").html('');
                        }
                        if (response.error.mitra_pengajar_id) {
                            $("#mitra_pengajar_id").addClass('is-invalid');
                            $(".error-mitra-pengajar").html(response.error.mitra_pengajar_id);
                        } else {
                            $("#mitra_pengajar_id").removeClass('is-invalid');
                            $(".error-mitra-pengajar").html('');
                        }
                        if (response.error.keterangan) {
                            $("#keterangan").addClass('is-invalid');
                            $(".error-keterangan").html(response.error.keterangan);
                        } else {
                            $("#keterangan").removeClass('is-invalid');
                            $(".error-keterangan").html('');
                        }

                    } else if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: `${response.success}`,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000)
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: `${response.duplikat}`,
                        });
                        $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                        $('.save').prop('disabled', false);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: `Data Belum Tersimpan!`,
                    });
                    $('.save').html('<i class="bi bi-box-arrow-in-right"></i> Kirim');
                    $('.save').prop('disabled', false);
                }
            });
        })
    });
</script>

</script>

<?= $this->endSection(); ?>
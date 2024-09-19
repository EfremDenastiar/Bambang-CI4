<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link rel="stylesheet" href="<?= base_url("asset/bootstrap/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1>Perpustakaan Digital</h1>
        </div>
    </header>

    <div class="container mt-5">
        <a href="/perpus/tambah" class="btn btn-primary mb-3">Tambah Data Buku</a>

        <table id="bukuTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Id Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($buku as $perpus) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $perpus['id_buku'] ?></td>
                        <td><?= $perpus['judul'] ?></td>
                        <td><?= $perpus['penulis'] ?></td>
                        <td><?= $perpus['penerbit'] ?></td>
                        <td><?= $perpus['tahun_terbit'] ?></td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="<?= $perpus['id_buku'] ?>" 
                                    data-judul="<?= $perpus['judul'] ?>" 
                                    data-penulis="<?= $perpus['penulis'] ?>" 
                                    data-penerbit="<?= $perpus['penerbit'] ?>" 
                                    data-tahun="<?= $perpus['tahun_terbit'] ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal">Edit</button>

                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm delete-btn" 
                                    data-id="<?= $perpus['id_buku'] ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">Hapus</button>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/perpus/edit" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_buku" id="editIdBuku">
                        <div class="mb-3">
                            <label for="editJudul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="editJudul" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="editPenulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="editPenulis" name="penulis">
                        </div>
                        <div class="mb-3">
                            <label for="editPenerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" id="editPenerbit" name="penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="editTahun" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" id="editTahun" name="tahun_terbit">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/perpus/hapus" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_buku" id="deleteIdBuku">
                        <p>Apakah Anda yakin ingin menghapus buku ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notifikasi</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Buku berhasil dihapus!
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and DataTables JS -->
    <script src="<?= base_url("asset/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#bukuTable').DataTable();

            // Edit Modal
            $('.edit-btn').click(function () {
                var id = $(this).data('id');
                var judul = $(this).data('judul');
                var penulis = $(this).data('penulis');
                var penerbit = $(this).data('penerbit');
                var tahun = $(this).data('tahun');

                $('#editIdBuku').val(id);
                $('#editJudul').val(judul);
                $('#editPenulis').val(penulis);
                $('#editPenerbit').val(penerbit);
                $('#editTahun').val(tahun);
            });

            // Delete Modal
            $('.delete-btn').click(function () {
                var id = $(this).data('id');
                $('#deleteIdBuku').val(id);
            });

            // Toast Notification
            var toastTrigger = document.getElementById('liveToastBtn')
            var toastLiveExample = document.getElementById('liveToast')
            if (toastTrigger) {
                toastTrigger.addEventListener('click', function () {
                    var toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                })
            }
        });
    </script>
</body>

</html>

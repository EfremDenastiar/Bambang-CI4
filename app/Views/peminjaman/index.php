<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Daftar Peminjaman</h1>
            <a href="/peminjaman/create" class="btn btn-primary mb-3">Tambah Peminjaman</a>
            <table id="peminjamanTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Buku ID</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Peminjaman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peminjaman as $item): ?>
                    <tr>
                        <td><?= $item['PeminjamanID']; ?></td>
                        <td><?= $item['UserID']; ?></td>
                        <td><?= $item['BukuID']; ?></td>
                        <td><?= $item['TanggalPeminjaman']; ?></td>
                        <td><?= $item['TanggalPengembalian']; ?></td>
                        <td><?= $item['StatusPeminjaman']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="<?= $item['PeminjamanID']; ?>" 
                                    data-user="<?= $item['UserID']; ?>" 
                                    data-buku="<?= $item['BukuID']; ?>" 
                                    data-peminjaman="<?= $item['TanggalPeminjaman']; ?>" 
                                    data-pengembalian="<?= $item['TanggalPengembalian']; ?>" 
                                    data-status="<?= $item['StatusPeminjaman']; ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal">Edit</button>

                            <button class="btn btn-danger btn-sm delete-btn" 
                                    data-id="<?= $item['PeminjamanID']; ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/peminjaman/edit" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="PeminjamanID" id="editIdPeminjaman">
                            <div class="mb-3">
                                <label for="editUserID" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="editUserID" name="UserID">
                            </div>
                            <div class="mb-3">
                                <label for="editBukuID" class="form-label">Buku ID</label>
                                <input type="text" class="form-control" id="editBukuID" name="BukuID">
                            </div>
                            <div class="mb-3">
                                <label for="editTanggalPeminjaman" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="editTanggalPeminjaman" name="TanggalPeminjaman">
                            </div>
                            <div class="mb-3">
                                <label for="editTanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="editTanggalPengembalian" name="TanggalPengembalian">
                            </div>
                            <div class="mb-3">
                                <label for="editStatusPeminjaman" class="form-label">Status Peminjaman</label>
                                <select class="form-control" id="editStatusPeminjaman" name="StatusPeminjaman">
                                    <option value="sudah dikembalikan">Sudah Dikembalikan</option>
                                    <option value="masih dipinjam">Masih Dipinjam</option>
                                </select>
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
                    <form action="/peminjaman/delete" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="PeminjamanID" id="deleteIdPeminjaman">
                            <p>Apakah Anda yakin ingin menghapus peminjaman ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function () {
                // Edit Modal
                $('.edit-btn').click(function () {
                    var id = $(this).data('id');
                    var user = $(this).data('user');
                    var buku = $(this).data('buku');
                    var peminjaman = $(this).data('peminjaman');
                    var pengembalian = $(this).data('pengembalian');
                    var status = $(this).data('status');

                    $('#editIdPeminjaman').val(id);
                    $('#editUserID').val(user);
                    $('#editBukuID').val(buku);
                    $('#editTanggalPeminjaman').val(peminjaman);
                    $('#editTanggalPengembalian').val(pengembalian);
                    $('#editStatusPeminjaman').val(status);
                });

                // Delete Modal
                $('.delete-btn').click(function () {
                    var id = $(this).data('id');
                    $('#deleteIdPeminjaman').val(id);
                });
            });
        </script>
    </body>

</html>

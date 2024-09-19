<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1>Data User</h1>
        </div>
    </header>

    <div class="container mt-5">
        <a href="/register" class="btn btn-primary mb-3">Tambah Data User</a>
        <table id="userTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($user as $data): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['Username']; ?></td>
                    <td><?= $data['Password']; ?></td>
                    <td><?= $data['Email']; ?></td>
                    <td><?= $data['NamaLengkap']; ?></td>
                    <td><?= $data['Alamat']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" 
                                data-id="<?= $data['UserID']; ?>" 
                                data-username="<?= $data['Username']; ?>" 
                                data-password="<?= $data['Password']; ?>" 
                                data-email="<?= $data['Email']; ?>" 
                                data-namalengkap="<?= $data['NamaLengkap']; ?>" 
                                data-alamat="<?= $data['Alamat']; ?>" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal">Edit</button>

                        <button class="btn btn-danger btn-sm delete-btn" 
                                data-id="<?= $data['UserID']; ?>" 
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
                <form action="/user/edit" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="UserID" id="editUserID">
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="Username">
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="Password">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="Email">
                        </div>
                        <div class="mb-3">
                            <label for="editNamaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="editNamaLengkap" name="NamaLengkap">
                        </div>
                        <div class="mb-3">
                            <label for="editAlamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="editAlamat" name="Alamat">
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
                <form action="/user/hapus" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="UserID" id="deleteUserID">
                        <p>Apakah Anda yakin ingin menghapus user ini?</p>
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
                var username = $(this).data('username');
                var password = $(this).data('password');
                var email = $(this).data('email');
                var namalengkap = $(this).data('namalengkap');
                var alamat = $(this).data('alamat');

                $('#editUserID').val(id);
                $('#editUsername').val(username);
                $('#editPassword').val(password);
                $('#editEmail').val(email);
                $('#editNamaLengkap').val(namalengkap);
                $('#editAlamat').val(alamat);
            });

            // Delete Modal
            $('.delete-btn').click(function () {
                var id = $(this).data('id');
                $('#deleteUserID').val(id);
            });
        });
    </script>
</body>

</html>

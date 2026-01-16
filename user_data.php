<table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-25">Profile</th>
                        <th class="w-75">Username</th>
                        <th class="w-30">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";               
                    $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
                    $limit = 4;
                    $limit_start = ($hlm - 1) * $limit;
                    $no = $limit_start + 1;
                
                    $sql = "select * from user order by user . id asc limit $limit_start, $limit";
                    $hasil = $conn->query($sql);
            
                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>                            
                            <td>
                                <?php
                                if ($row["foto"] != '') {
                                    if (file_exists('img/' . $row["foto"] . '')) {
                                ?>
                                        <img src="img/<?= $row['foto'] ?>" width="80" height="80" style="border-radius: 50%; object-fit: cover;" >
                                <?php
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $row["username"] ?></td>
                            <td>                    
                                <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                                <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>                                
                                <!-- modal edit -->
                                <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="modal-body">

                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <input type="hidden" name="password_lama" value="<?= $row['password'] ?>">
                                                    <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">

                                                    <!-- username -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Username</label>
                                                        <input 
                                                            type="text" 
                                                            class="form-control" 
                                                            name="username"
                                                            value="<?= $row['username'] ?>"
                                                            required
                                                        >
                                                    </div>

                                                    <!-- password -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                                                        <div class="input-group">
                                                            <input 
                                                                type="password" 
                                                                class="form-control"
                                                                id="password<?= $row['id'] ?>"
                                                                name="password"
                                                                placeholder="password baru"
                                                            >
                                                            <button 
                                                                class="btn btn-outline-secondary" 
                                                                type="button"
                                                                onclick="togglePasswordEdit(<?= $row['id'] ?>)"
                                                            >
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- foto -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Foto Profil</label>
                                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                                        <small class="text-muted">kosongkan jika tidak diubah</small>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                                                    <button type="submit" name="edit" class="btn btn-warning">simpan</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- modal hapus -->
                                <div class="modal fade" id="modalHapus<?= $row['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger">Hapus User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="post" action="">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <input type="hidden" name="foto" value="<?= $row['foto'] ?>">                                            
                                                    <p>
                                                        Yakin ingin menghapus user  
                                                        <strong><?= $row['username'] ?></strong> ?
                                                    </p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                                                    <button type="submit" name="hapus" class="btn btn-danger">hapus</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>


    
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

<?php 
$sql1 = "SELECT * FROM user";
$hasil1 = $conn->query($sql1); 
$total_records = $hasil1->num_rows;
?>
<p>Total article : <?php echo $total_records; ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
    <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
        $end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;

        if($hlm == 1){
            echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $link_prev = ($hlm > 1)? $hlm - 1 : 1;
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for($i = $start_number; $i <= $end_number; $i++){
            $link_active = ($hlm == $i)? ' active' : '';
            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }

        if($hlm == $jumlah_page){
            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        } else {
        $link_next = ($hlm < $jumlah_page)? $hlm + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
        }
    ?>
    </ul>
</nav>            
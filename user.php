<div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah User 
        </button>
    <div class="row">
        <div class="table-responsive" id="user_data">
            
        </div>

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">

                            <!-- username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="username"
                                    name="username"
                                    placeholder="masukkan username"
                                    required
                                >
                            </div>

                            <!-- password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password"
                                        name="password"
                                        placeholder="masukkan password"
                                        required
                                    >
                                    <button 
                                        class="btn btn-outline-secondary" 
                                        type="button"
                                        onclick="togglePassword()"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- foto profil -->
                            <div class="mb-3">
                                <label class="form-label">Foto Profil</label>
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    name="foto"
                                    accept="image/*"
                                >
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Akhir Modal Tambah-->
    </div>
</div>

<script>
$(document).ready(function(){
    load_data();
    function load_data(hlm){
        $.ajax({
            url : "user_data.php",
            method : "POST",
            data : {
					            hlm: hlm
				           },
            success : function(data){
                    $('#user_data').html(data);
            }
        })
    } 
    $(document).on('click', '.halaman', function(){
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});
</script>

<?php
        include "upload_foto.php";

        /* =====================
        TAMBAH & EDIT USER
        ===================== */
        if (isset($_POST['simpan']) || isset($_POST['edit'])) {

            $username = $_POST['username'];
            $password_input = $_POST['password'];
            $foto = '';
            $nama_foto = $_FILES['foto']['name'];

            // jika ada upload foto
            if ($nama_foto != '') {
                $cek_upload = upload_foto($_FILES['foto']);

                if ($cek_upload['status']) {
                    $foto = $cek_upload['message'];
                } else {
                    echo "<script>
                        alert('" . $cek_upload['message'] . "');
                        document.location='admin.php?page=user';
                    </script>";
                    die;
                }
            }

            /* ===== EDIT USER ===== */
            if (isset($_POST['id'])) {

                $id = $_POST['id'];

                // password
                if ($password_input != '') {
                    $password = password_hash($password_input, PASSWORD_DEFAULT);
                } else {
                    $password = $_POST['password_lama'];
                }

                // foto
                if ($nama_foto == '') {
                    $foto = $_POST['foto_lama'];
                } else {
                    if ($_POST['foto_lama'] != '') {
                        unlink("img/" . $_POST['foto_lama']);
                    }
                }

                $stmt = $conn->prepare(
                    "update user set username=?, password=?, foto=? where id=?"
                );
                $stmt->bind_param("sssi", $username, $password, $foto, $id);
                $simpan = $stmt->execute();

            }
            /* ===== TAMBAH USER ===== */
            else {

                $password = password_hash($password_input, PASSWORD_DEFAULT);

                // cek username
                $cek = $conn->prepare("select id from user where username=?");
                $cek->bind_param("s", $username);
                $cek->execute();
                $cek->store_result();

                if ($cek->num_rows > 0) {
                    echo "<script>
                        alert('username sudah digunakan');
                        document.location='admin.php?page=user';
                    </script>";
                    exit;
                }

                $stmt = $conn->prepare(
                    "insert into user (username,password,foto) values (?,?,?)"
                );
                $stmt->bind_param("sss", $username, $password, $foto);
                $simpan = $stmt->execute();
            }

            if ($simpan) {
                echo "<script>
                    alert('data user berhasil disimpan');
                    document.location='admin.php?page=user';
                </script>";
            } else {
                echo "<script>
                    alert('data user gagal disimpan');
                    document.location='admin.php?page=user';
                </script>";
            }

            $stmt->close();
            $conn->close();
        }


        /* =====================
        HAPUS USER
        ===================== */
        if (isset($_POST['hapus'])) {

            $id = $_POST['id'];
            $foto = $_POST['foto'];

            if ($foto != '') {
                unlink("img/" . $foto);
            }

            $stmt = $conn->prepare("delete from user where id=?");
            $stmt->bind_param("i", $id);
            $hapus = $stmt->execute();

            if ($hapus) {
                echo "<script>
                    alert('user berhasil dihapus');
                    document.location='admin.php?page=user';
                </script>";
            } else {
                echo "<script>
                    alert('user gagal dihapus');
                    document.location='admin.php?page=user';
                </script>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>

<script>
function togglePassword() {
    const password = document.getElementById("password");
    const icon = event.currentTarget.querySelector("i");

    if (password.type === "password") {
        password.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        password.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
    
function togglePasswordEdit(id) {
    const pass = document.getElementById("password" + id);
    const icon = event.currentTarget.querySelector("i");

    if (pass.type === "password") {
        pass.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        pass.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    }    
}
</script>
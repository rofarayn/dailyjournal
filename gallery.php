<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gambar 
    </button>
    <div class="row">
       
        <div class="table-responsive" id="gallery_data">
            
        </div>

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal"  required>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Nama Uploader</label>
                                <input type="text" class="form-control" name="uploader" placeholder="Isi Nama Anda" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
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
            url : "gallery_data.php",
            method : "POST",
            data : {
					            hlm: hlm
				           },
            success : function(data){
                    $('#gallery_data').html(data);
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

/* ================= SIMPAN & EDIT ================= */
if (isset($_POST['simpan'])) {

    $uploader = $_POST['uploader'];
    $tanggal  = $_POST['tanggal'];
    $gambar   = '';

    /* === UPLOAD GAMBAR === */
    if (!empty($_FILES['gambar']['name'])) {

        $cek = upload_foto($_FILES['gambar']);

        if ($cek['status']) {
            $gambar = $cek['message'];
        } else {
            echo "<script>alert('".$cek['message']."');history.back();</script>";
            exit;
        }
    }


    /* ============ EDIT DATA ============ */
    if (!empty($_POST['id'])) {

        $id = $_POST['id'];

        if ($gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            if (!empty($_POST['gambar_lama']) && file_exists('img/'.$_POST['gambar_lama'])) {
                unlink('img/'.$_POST['gambar_lama']);
            }
        }

        $stmt = $conn->prepare(
            "UPDATE gallery SET gambar=?, tanggal=?, uploader=? WHERE id=?"
        );
        $stmt->bind_param("sssi", $gambar, $tanggal, $uploader, $id);

    } 
    /* ============ TAMBAH DATA ============ */
    else {

    if ($gambar == '') {
        echo "<script>alert('Gambar wajib diupload');history.back();</script>";
        exit;
    }

    $stmt = $conn->prepare(
        "INSERT INTO gallery (gambar, tanggal, uploader) VALUES (?,?,?)"
    );
    $stmt->bind_param("sss", $gambar, $tanggal, $uploader);
}


    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Data berhasil disimpan');location='admin.php?page=gallery';</script>";
}

/* ================= HAPUS ================= */
if (isset($_POST['hapus'])) {

    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if (!empty($gambar) && file_exists('img/'.$gambar)) {
        unlink('img/'.$gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Data berhasil dihapus');location='admin.php?page=gallery';</script>";
}
?>


<?php
function upload_fotogallery($file)
{
    $folder = "img/";
    $nama_file = time() . "_" . basename($file['name']);
    $target = $folder . $nama_file;

    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','webp'];

    if (!in_array($ext, $allowed)) {
        return ['status'=>false,'message'=>'Format gambar tidak valid'];
    }

    if ($file['size'] > 2000000) {
        return ['status'=>false,'message'=>'Ukuran maksimal 2MB'];
    }

    if (move_uploaded_file($file['tmp_name'], $target)) {
        return ['status'=>true,'message'=>$nama_file];
    }

    return ['status'=>false,'message'=>'Upload gagal'];
}

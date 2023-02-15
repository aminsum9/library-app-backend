<?php

include("../controllers/userController.php");
// include("../controllers/bukuController.php");

$db_conn = new Database();

header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"));

$path = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];

if($path == '/'){
    if ($method == 'GET') {
        echo "success";
    }
    return;
}

if($method == 'POST'){
    $user =  new userController($db_conn);

    if ($path == '/user/users') {
        $user->get_users();
    }

    if ($path == '/user/create') {
        $user->create(trim($data->nama),trim($data->nomor_telepon));
    }
    
    if ($path == '/user/update') {
        $user->update_user(trim($data->id),trim($data->nama),trim($data->nomor_telepon));
    }
    
    if ($path == '/user/delete') {
        $user->delete(trim($data->id));
    }
}

// if($method == 'POST'){
//     $usbooker =  new bukuController($db_conn);

//     if ($path == '/book/create') {
//         $book->create(trim($data->nomor_buku),trim($data->nama_buku),trim($data->penerbit),trim($data->penulis),trim($data->tanggal_masuk));
//     }

//     if ($path == '/book/books') {
//         $book->get_buku();
//     }
    
//     if ($path == '/book/update') {
//         $book->update_buku(trim($data->id),trim($data->nama),trim($data->nomor_telepon));
//     }
    
//     if ($path == '/book/delete') {
//         $book->delete(trim($data->id));
//     }
// }



<?php

include("../config/db.php");
include("../controllers/userController.php");
include("../controllers/bukuController.php");

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
        $user->create($data->nama,$data->nomor_telepon);
    }
    
    if ($path == '/user/update') {
        $user->update($data->id,$data->nama,$data->nomor_telepon);
    }
    
    if ($path == '/user/delete') {
        $user->delete($data->id);
    }
}

if($method == 'POST'){
    $book =  new bukuController($db_conn);

    if ($path == '/book/create') {
        $book->create($data->nomor_buku,$data->nama_buku,$data->penerbit,$data->penulis,$data->tanggal_masuk);
    }

    if ($path == '/book/books') {
        $book->get_buku();
    }
    
    if ($path == '/book/update') {
        $book->update($data->id,$data->nomor_buku,$data->nama_buku,$data->penerbit,$data->penulis,$data->tanggal_masuk);
    }
    
    if ($path == '/book/delete') {
        $book->delete($data->id);
    }
}



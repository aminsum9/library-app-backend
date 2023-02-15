<?php
include("../config/db.php");

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


class bukuController
{

    protected $db_conn;

    function __construct(Database $db_conn)
    {
        $this->db_conn = $db_conn->db();
    }

    function create($nomor_buku, $nama_buku, $penerbit, $penulis, $tanggal_masuk)
    {

        $nomor_buku = mysqli_real_escape_string($this->db_conn, trim($nomor_buku));
        $nama_buku = mysqli_real_escape_string($this->db_conn, trim($nama_buku));
        $penerbit = mysqli_real_escape_string($this->db_conn, trim($penerbit));
        $penulis = mysqli_real_escape_string($this->db_conn, trim($penulis));
        $tanggal_masuk = mysqli_real_escape_string($this->db_conn, trim($tanggal_masuk));

        $addUser = mysqli_query($this->db_conn, "INSERT INTO `perpustakaan_botika`.buku(id,nomor_buku,nama_buku,penerbit,penulis,tanggal_masuk) VALUES(0,'$nomor_buku','$nama_buku','$penerbit'.'$penulis','tanggal_masuk')");

        if ($addUser) {
            echo json_encode(["success" => true, "message" => 'success register']);
        } else {
            echo json_encode(["success" => false, "message" => 'failed register']);
        }

    }

    function get_buku()
    {

        $all_user = mysqli_query($this->db_conn, 'SELECT * FROM buku');

        if (mysqli_num_rows($all_user) > 0) {
            $allUsers = mysqli_fetch_all($all_user, MYSQLI_ASSOC);

            echo json_encode(['success' => false, 'users' => $allUsers]);
        } else {
            echo json_encode(['success' => false, "message" => "failed get data buku"]);
        }

    }

    function update($id,$nomor_buku, $nama_buku, $penerbit, $penulis, $tanggal_masuk)
    {

        if (isset($id) && isset($nomor_buku) && isset($nama_buku) && isset($penerbit) && isset($penulis)  && isset($tanggal_masuk)) {

            $updateUser = mysqli_query($this->db_conn, "
            UPDATE user SET nomor_buku = '$nomor_buku', 
            nama_buku = '$nama_buku', 
            penerbit = '$penerbit' 
            penulis = '$penulis' 
            tanggal_masuk = '$tanggal_masuk'
            WHERE id = $id");

            if ($updateUser) {
                echo json_encode(["success" => true, "buku $nama_buku updated successfully"]);
            } else {
                echo json_encode(["success" => false, "buku $nama_buku failed updated!"]);
            }
            
        } else {
            echo  json_encode(["success" => false, "please fill all required data!"]);
        }

    }

    function delete($id)
    {
        
        if(isset($id)){
            $deleteUser = mysqli_query($this->db_conn, "DELETE FROM buku WHERE id =".$id);
        
            if($deleteUser){
                echo json_encode(["success" => true, "User success deleted!"]);
            } else {
                echo  json_encode(["success" => false, "User failed deleted!"]);
            }
        } else {
            echo json_encode(["success" => false, "Please fill all required data!"]);
        }

    }
}

<?php
include("../config/db.php");

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class userController
{

    protected $db_conn;

    function __construct(Database $db_conn)
    {
        $this->db_conn = $db_conn->db();
    }

    public function create($name, $nomor_telepon)
    {

        $name = mysqli_real_escape_string($this->db_conn, trim($name));
        $nomor_telepon = mysqli_real_escape_string($this->db_conn, trim($nomor_telepon));

        $token_user = "";

        $addUser = mysqli_query($this->db_conn, "INSERT INTO `perpustakaan_botika`.user(id,nama,nomor_telepon,token_user) VALUES(0,'$name','$nomor_telepon','$token_user')");

        if ($addUser) {
            echo json_encode(["success" => true, "message" => 'success register']);
        } else {
            echo json_encode(["success" => false, "message" => 'failed register']);
        }
    }

    public function get_users()
    {
        $all_user = mysqli_query($this->db_conn, 'SELECT * FROM user');

        if (mysqli_num_rows($all_user) > 0) {
            $allUsers = mysqli_fetch_all($all_user, MYSQLI_ASSOC);

            echo json_encode(['success' => 1, 'users' => $allUsers]);
        } else {
            echo json_encode(['success' => 0]);
        }
    }

    public function update($id, $name, $nomor_telepon)
    {

        $name = mysqli_real_escape_string($this->db_conn, trim($name));
        $nomor_telepon = mysqli_real_escape_string($this->db_conn, trim($nomor_telepon));

        if (isset($id) && isset($name) && isset($nomor_telepon)) {
            $updateUser = mysqli_query($this->db_conn, "UPDATE user SET nama = '$name' , nomor_telepon = '$nomor_telepon' WHERE id = $id");

            if ($updateUser) {
                echo json_encode(["success" => true, "user $name updated successfully"]);
            } else {
                echo json_encode(["success" => false, "user $name failed updated!"]);
            }
        } else {
            echo  json_encode(["success" => false, "please fill all required data!"]);
        }
    }

    public function delete($id)
    {   
        if(isset($id)){

            $id = strval($id);

            $deleteUser = mysqli_query($this->db_conn, "DELETE FROM user WHERE id =".$id);
        
            if($deleteUser){
                echo json_encode(["success" => true, "message" => "User success deleted!"]);
            } else {
                echo  json_encode(["success" => false, "message" => "User failed deleted!"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Please fill all required data!"]);
        }
    }
}

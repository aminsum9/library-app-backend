<?php
include("../config/db.php");

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// $data_base = new Database();

// $db = $data_base->db();

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
            echo json_encode(["success" => true, 'success register']);
        } else {
            echo json_encode(["success" => false, 'failed register']);
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

    public function update_user($id, $name, $nomor_telepon)
    {

        if (isset($id) && isset($name) && isset($email) && isset($phone)) {
            $updateUser = mysqli_query($this->db_conn, "UPDATE user SET name = '$name' , email = '$nomor_telepon' WHERE id = $id");

            if ($updateUser) {
                echo json_encode(["success" => 1, "user $name updated successfully"]);
            } else {
                echo json_encode(["success" => 0, "user $name failed updated!"]);
            }
        } else {
            echo  json_encode(["success" => 0, "please fill all required data!"]);
        }
    }

    public function delete($id)
    {   
        if(isset($id)){
            $deleteUser = mysqli_query($this->db_conn, "DELETE FROM user WHERE id = $id");
        
            if($deleteUser){
                echo json_encode(["success" => 1, "User success deleted!"]);
            } else {
                echo  json_encode(["success" => 0, "User failed deleted!"]);
            }
        } else {
            echo json_encode(["success" => 0, "Please fill all required data!"]);
        }
    }
}

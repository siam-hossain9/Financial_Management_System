<?php

    class Model {

        function OpenCon(){
            $conn = new mysqli("localhost", "root", "", "financialmanagementsystem");
            return $conn;
        }

        function CloseCon($conn){
            $conn->close();
        }

        function get_user_type($conn, $table){
            $sql = "SELECT user_type, MIN(money) AS money FROM $table GROUP BY user_type ORDER BY user_type LIMIT 2";
            $result = $conn->query($sql);
            return $result; 
        }

        function PersonalcheckLogin($conn, $table, $email, $password){
            $email = mysqli_real_escape_string($conn, $email);
            
   
            $sql = "SELECT * FROM $table WHERE P_mail = '$email'";
            $result = $conn->query($sql);
            

            if ($result && $result->num_rows > 0) {
                $user = $result->fetch_assoc();
                
   
                if (password_verify($password, $user['P_password'])) {
 
                    return $user;
                }
            }

            return false;
        }


        function BusinesscheckLogin($conn, $table, $email, $password){
            $email = mysqli_real_escape_string($conn, $email);

            $sql = "SELECT * FROM $table WHERE B_mail = '$email'";
            $result = $conn->query($sql);
   
            if ($result && $result->num_rows > 0) {
                $user = $result->fetch_assoc();
                
     
                if (password_verify($password, $user['B_password'])) {
    
                    return $user;
                }
            }
            
  
            return false;
        }
    }

?>

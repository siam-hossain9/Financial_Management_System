<?php

class Model
{
   
    function OpenConn()
    {
        $conn = new mysqli("localhost", "root", "", "financialmanagementsystem");
        return $conn;
    }

    function CloseCon($conn)
    {
        $conn->close();
    }

   
    function AddIntoPesonalUser($conn, $table, $fname, $lname, $email, $username, $password, $gender, $monthly_Income)
    {
        $stmt = $conn->prepare("INSERT INTO $table (P_fname, P_lname, P_mail, P_Username, P_password, P_gender, P_montlyIncome) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssd", $fname, $lname, $email, $username, $password, $gender, $monthly_Income);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    
    function addUserIntoRegistration($conn, $table, $user_name, $email, $password, $user_type)
    {
        $money = 0.00;
        $stmt = $conn->prepare("INSERT INTO $table (user_name, email, password, user_type, money) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $user_name, $email, $password, $user_type, $money);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function addSavings($conn, $table, $P_id, $s_name, $s_amount, $s_type)
    {
        $stmt = $conn->prepare("INSERT INTO $table (s_name, s_amount, s_type, s_date, P_id) VALUES (?, ?, ?, NOW(), ?)");
        $stmt->bind_param("sdsi", $s_name, $s_amount, $s_type, $P_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    function savingshistory($conn, $table, $P_id)
    {
        $stmt = $conn->prepare("SELECT s_id, s_name, s_amount, s_type, s_date FROM $table WHERE P_id = ? ORDER BY s_date DESC");
        $stmt->bind_param("i", $P_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
    function deleteSavings($conn, $table, $Saving_id)
    {
        $stmt = $conn->prepare("DELETE FROM $table WHERE s_id = ?");
        $stmt->bind_param("i", $Saving_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    function editSavings($conn, $table, $Saving_id)
    {
        $stmt = $conn->prepare("SELECT s_id, s_name, s_amount, s_type, s_date FROM $table WHERE s_id = ?");
        $stmt->bind_param("i", $Saving_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    
    function updateSavings($conn, $table, $s_id, $s_name, $s_amount, $s_type)
    {
        $stmt = $conn->prepare("UPDATE $table SET s_name = ?, s_amount = ?, s_type = ? WHERE s_id = ?");
        $stmt->bind_param("sdsi", $s_name, $s_amount, $s_type, $s_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    
    function searchSavings($conn, $table, $s_name, $P_id)
    {
        $search = "%$s_name%";
        $stmt = $conn->prepare("SELECT s_id, s_name, s_amount, s_type, s_date FROM $table WHERE s_name LIKE ? AND P_id = ? ORDER BY s_date DESC");
        $stmt->bind_param("si", $search, $P_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
    function addExpence($conn, $table, $P_id, $ex_name, $ex_amount, $ex_type)
    {
        $stmt = $conn->prepare("INSERT INTO $table (ex_name, ex_amount, ex_type, ex_date, P_id) VALUES (?, ?, ?, NOW(), ?)");
        $stmt->bind_param("sdsi", $ex_name, $ex_amount, $ex_type, $P_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function expensehistory($conn, $table, $P_id)
    {
        $stmt = $conn->prepare("SELECT ex_id, ex_name, ex_amount, ex_type, ex_date FROM $table WHERE P_id = ? ORDER BY ex_date DESC");
        $stmt->bind_param("i", $P_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function deleteExpense($conn, $table, $ex_id)
    {
        $stmt = $conn->prepare("DELETE FROM $table WHERE ex_id = ?");
        $stmt->bind_param("i", $ex_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function editExpense($conn, $table, $ex_id)
    {
        $stmt = $conn->prepare("SELECT ex_id, ex_name, ex_amount, ex_type, ex_date FROM $table WHERE ex_id = ?");
        $stmt->bind_param("i", $ex_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }


    function updateExpense($conn, $table, $ex_id, $ex_name, $ex_amount, $ex_type)
    {
        $stmt = $conn->prepare("UPDATE $table SET ex_name = ?, ex_amount = ?, ex_type = ? WHERE ex_id = ?");
        $stmt->bind_param("sdsi", $ex_name, $ex_amount, $ex_type, $ex_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

  
    function searchExpense($conn, $table, $ex_name, $P_id)
    {
        $search = "%$ex_name%";
        $stmt = $conn->prepare("SELECT ex_id, ex_name, ex_amount, ex_type, ex_date FROM $table WHERE ex_name LIKE ? AND P_id = ? ORDER BY ex_date DESC");
        $stmt->bind_param("si", $search, $P_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>

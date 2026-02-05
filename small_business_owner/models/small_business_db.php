<?php

class Model
{
    
    function OpenCon()
    {
        $conn = new mysqli("localhost", "root", "", "financialmanagementsystem");
        return $conn;
    }

 
    
    function addSavings($conn, $table, $s_id, $s_name, $s_amount, $s_type, $s_date)
    {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $B_id = $_SESSION['userid'];
        
        if (empty($s_id)) {
         
            $sql = "INSERT INTO $table(B_id, s_name, s_amount, s_type, s_date) 
                    VALUES('$B_id', '$s_name', '$s_amount', '$s_type', '$s_date')";
        } else {
          
            $sql = "UPDATE $table SET s_name='$s_name', s_amount='$s_amount', s_type='$s_type', s_date='$s_date' 
                    WHERE s_id='$s_id' AND B_id='$B_id'";
        }
        $result = $conn->query($sql);
        return $result;
    }

    function savingshistory($conn, $table, $B_id)
    {
        $sql = "SELECT * FROM $table WHERE B_id='$B_id' ORDER BY s_date DESC";
        $result = $conn->query($sql);
        return $result;
    }

    function deleteSavings($conn, $table, $Saving_id)
    {
        $sql = "DELETE FROM $table WHERE s_id='$Saving_id'";
        $result = $conn->query($sql);
        return $result;
    }

    function editSavings($conn, $table, $Saving_id)
    {
        $sql = "SELECT * FROM $table WHERE s_id='$Saving_id'";
        $result = $conn->query($sql);
        return $result;
    }

    
    
    function addExpence($conn, $table, $ex_id, $ex_name, $ex_amount, $ex_type, $ex_date)
    {
       
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $B_id = $_SESSION['userid'];
        
        if (empty($ex_id)) {
           
            $sql = "INSERT INTO $table(B_id, ex_name, ex_amount, ex_type, ex_date) 
                    VALUES('$B_id', '$ex_name', '$ex_amount', '$ex_type', '$ex_date')";
        } else {
          
            $sql = "UPDATE $table SET ex_name='$ex_name', ex_amount='$ex_amount', ex_type='$ex_type', ex_date='$ex_date' 
                    WHERE ex_id='$ex_id' AND B_id='$B_id'";
        }
        $result = $conn->query($sql);
        return $result;
    }

    function expensehistory($conn, $table, $B_id)
    {
        $sql = "SELECT * FROM $table WHERE B_id='$B_id' ORDER BY ex_date DESC";
        $result = $conn->query($sql);
        return $result;
    }

    function deleteExpense($conn, $table, $ex_id)
    {
        $sql = "DELETE FROM $table WHERE ex_id='$ex_id'";
        $result = $conn->query($sql);
        return $result;
    }

    function editExpense($conn, $table, $ex_id)
    {
        $sql = "SELECT * FROM $table WHERE ex_id='$ex_id'";
        $result = $conn->query($sql);
        return $result;
    }

    
    function addUserIntoRegistration($conn, $table, $user_name, $email, $password, $user_type)
    {
        $sql = "INSERT INTO $table (user_name, email, password, user_type)
                VALUES ('$user_name', '$email', '$password', '$user_type')";
        $result = $conn->query($sql);
        return $result;
    }

    function addUserIntoSmallBusiness($conn, $table, $Business_type, $Business_name, $BIN_number, $B_monthly_income, $B_email, $B_password, $B_tax)
    {
        $sql = "INSERT INTO $table (Bussiness_type, Bussiness_name, BIN_number, B_montlyIncome, B_mail, B_password, B_tax)
                VALUES ('$Business_type', '$Business_name', '$BIN_number', '$B_monthly_income', '$B_email', '$B_password', '$B_tax')";
        $result = $conn->query($sql);
        return $result;
    }
    
    
    function CloseCon($conn)
    {
        $conn->close();
    }
}
?>

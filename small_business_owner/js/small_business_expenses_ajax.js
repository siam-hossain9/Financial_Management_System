$(document).ready(function () {

    
    function displayError(inputId, message) {
        var errorDiv = $("<p>").addClass("error-message").text(message);
        $("#" + inputId).after(errorDiv);
    }

    
    function removeError(inputId) {
        $("#" + inputId).next(".error-message").remove();
    }

   
    function validateForm() {
        $(".error-message").remove();
        var isValid = true;

        
        var expenseName = $("#expense-name").val().trim();
        var expenseAmount = $("#expense-amount").val().trim();
        var expenseType = $("#expense-type").val();
        
        if (expenseName === "") {
            displayError("expense-name", "Expense name cannot be empty");
            isValid = false;
        } else if (!isNaN(expenseName)) {
            displayError("expense-name", "Expense name cannot be a number");
            isValid = false;
        } else {
            removeError("expense-name");
        }
        

        if (isNaN(expenseAmount) || expenseAmount === "") {
            displayError("expense-amount", "Expense amount must be a number and cannot be empty");
            isValid = false;
        } else {
            removeError("expense-amount");
        }

        

        if (expenseType === "") {
            displayError("expense-type", "Please select an expense type");
            isValid = false;
        } else {
            removeError("expense-type");
        }

        return isValid; 
    }



  
    function showExpenseData() {

        output = " ";
        $.ajax({
            url: "../controllers/small_business_expenseHistory_controller.php",
            method: "GET",
            dataType: "json",   
            success: function (data) {
                
                for (i = 0; i < data.length; i++) {         
                    
                    output += "<body><div class='history-card-div'> <h5 class='history-title'><i class='history-icon fa-solid fa-coins'></i>" + data[i].ex_name
                        + "</h5> <p class='time'>" + data[i].ex_date
                        + "</p> <p class='history-money'>$" + data[i].ex_amount
                        + "</p><a href=' ' class='history-delete expense-delete' data-eid=" + data[i].ex_id + "><i class=' history-icon fa-solid fa-trash'></i> Delete </a> <a href = ' ' class='history-edit expense-edit' data-eid=" + data[i].ex_id + "><i class=' history-icon fa-solid fa-pen'></i> Edit </a> </div></body>";
                               
                }
                $("#expensehistory").html(output);
            },
        });
    }
    showExpenseData();


    //Ajax for inserting data
    $("#addexpense").click(function (e) {
        if (!validateForm()) {
            e.preventDefault(); // Prevent form submission if validation fails
            return;
        }
        e.preventDefault();
        // console.log("button clicked");
        let pe_id = $("#expense_id").val();
        let pe_name = $("#expense-name").val();
        let pe_amount = $("#expense-amount").val();
        let pe_type = $("#expense-type").val();
        mydata = { id: pe_id, name: pe_name, amount: pe_amount, type: pe_type, date: new Date().toISOString().split('T')[0] };
        //console.log(mydata);
        $.ajax({
            url: "../controllers/small_business_expense_insert_controller.php",
            method: "POST",
            data: JSON.stringify(mydata), // convert mydata obj to string and send to server
            success: function (data) {
                //console.log(data);
                $("#expences")[0].reset(); // reset
                showExpenseData();
            },
        });
    });



    //Ajax for deleting data
    $(expensehistory).on("click", ".history-delete", function (e) {
        removeError("expense-name");
        removeError("expense-amount");
        removeError("expense-type");
        e.preventDefault();
        console.log("delete clicked");
        let id = $(this).attr("data-eid");
        console.log("the id is:" + id);
        mydata = { ex_id: id };
        $.ajax({
            url: "../controllers/small_business_expense_delete.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function (data) {     //this data will come from the server
                //console.log(data);
                showExpenseData(); // will execute the full showExpenseData function
            },
        });
    });


    //Ajax for editing data
    $(expensehistory).on("click", ".history-edit", function (e) {
        removeError("expense-name");
        removeError("expense-amount");
        removeError("expense-type");
        e.preventDefault();
        //console.log("edit clicked");
        let id = $(this).attr("data-eid");
        console.log("the id is:" + id);
        mydata = { ex_id: id };
        $.ajax({
            url: "../controllers/small_business_expense_edit_controller.php",
            method: "POST",
            dataType: "json",       //return string but need obj so we used datatype
            data: JSON.stringify(mydata),
            success: function (data) {     //this data or response will come from the server
                //console.log(data);
                $("#expense_id").val(data.ex_id);
                $("#expense-name").val(data.ex_name);
                $("#expense-amount").val(data.ex_amount);
                $("#expense-type").val(data.ex_type);
            },
        });

    });






});

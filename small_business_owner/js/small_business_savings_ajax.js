$(document).ready(function () {


    
    function displayError(inputId, message) {
        var errorDiv = $("<div>").addClass("error-message").text(message);
        $("#" + inputId).after(errorDiv);
    }

    
    function removeError(inputId) {
        $("#" + inputId).next(".error-message").remove();
    }

    
    function validateForm() {
        $(".error-message").remove();
        var isValid = true;

        
        var savingsName = $("#savings-name").val().trim();
        var savingsAmount = $("#savings-amount").val().trim();
        var savingsType = $("#savings-type").val();
        
        if (savingsName === "") {
            displayError("savings-name", "Savings name cannot be empty");
            isValid = false;
        } else if (!isNaN(savingsName)) {
            displayError("savings-name", "Savings name cannot be a number");
            isValid = false;
        } else {
            removeError("savings-name");
        }
        

        if (isNaN(savingsAmount) || savingsAmount === "") {
            displayError("savings-amount", "Savings amount must be a number and cannot be empty");
            isValid = false;
        } else {
            removeError("savings-amount");
        }

        

        if (savingsType === "") {
            displayError("savings-type", "Please select a savings type");
            isValid = false;
        } else {
            removeError("savings-type");
        }

        return isValid; 
    }



   
    function showSavingsData() {
        output = " ";
        $.ajax({
            url: "../controllers/small_business_savingsHistory_controller.php",
            method: "GET",
            dataType: "json",   
            success: function (data) {
               
                for (i = 0; i < data.length; i++) {        
                   
                    output += "<body><div class='history-card-div'> <h5 class='history-title'><i class='history-icon fa-solid fa-coins'></i>" + data[i].s_name
                        + "</h5> <p class='time'>" + data[i].s_date
                        + "</p> <p class='history-money'>$" + data[i].s_amount
                        + "</p><a href=' ' class='history-delete savings-delete' data-sid=" + data[i].s_id + "><i class=' history-icon fa-solid fa-trash'></i> Delete </a> <a href = ' ' class='history-edit savings-edit' data-sid=" + data[i].s_id + "><i class=' history-icon fa-solid fa-pen'></i> Edit </a> </div></body>";
                              
                }
                $("#savingshistory").html(output);
            },
        });
    }
    showSavingsData();



    

    $("#addsavings").click(function (e) {
        if (!validateForm()) {
            e.preventDefault(); 
            return;
        }
        e.preventDefault();     
        let ps_id = $("#savings_id").val();
        let ps_name = $("#savings-name").val();
        let ps_amount = $("#savings-amount").val();
        let ps_type = $("#savings-type").val();

       
        mydata = { id: ps_id, name: ps_name, amount: ps_amount, type: ps_type, date: new Date().toISOString().split('T')[0] };
        

        $.ajax({
            url: "../controllers/small_business_savings_insert_controller.php",
            method: "POST",
            data: JSON.stringify(mydata), 
            success: function (data) {
                $("#savings")[0].reset();
                showSavingsData();
            },
        });

    });





   
    $(savingshistory).on("click", ".history-edit", function (e) {
        removeError("savings-name");
        removeError("savings-amount");
        removeError("savings-type");
        e.preventDefault();
  
        let id = $(this).attr("data-sid");
        console.log("the id is:" + id);
        mydata = { s_id: id };
        $.ajax({
            url: "../controllers/small_business_savings_edit_controller.php",
            method: "POST",
            dataType: "json",       
            data: JSON.stringify(mydata),
            success: function (data) {     
                $("#savings_id").val(data.s_id);
                $("#savings-name").val(data.s_name);
                $("#savings-amount").val(data.s_amount);
                $("#savings-type").val(data.s_type);
            },
        });

    });




    
    $(savingshistory).on("click", ".history-delete", function (e) {
        removeError("savings-name");
        removeError("savings-amount");
        removeError("savings-type");
        e.preventDefault();
       
        let id = $(this).attr("data-sid");
        console.log("the id is:" + id);
        mydata = { s_id: id };
        $.ajax({
            url: "../controllers/small_business_saving_delete.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function (data) {     
                showSavingsData();  
            },
        });
    });




});

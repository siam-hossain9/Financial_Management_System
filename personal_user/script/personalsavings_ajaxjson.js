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


    $("#search").keyup(function (e) {
        var input = $(this).val();
        console.log("Search input:", input);
    
        $.ajax({
            url: "../controllers/personaluser_searchSavings.php",
            method: "POST",
            data: { search: input },
            dataType: "json",
            success: function (data) {
                console.log("Search response:", data);
                var output = "";
                for (var i = 0; i < data.length; i++) {
                    output += "<div class='history-card-div'> <h5 class='history-title'><i class='history-icon fa-solid fa-coins'></i>" + data[i].s_name
                        + "</h5> <p class='time'>" + data[i].s_date
                        + "</p> <p class='history-money'>$" + data[i].s_amount
                        + "</p><a href=' ' class='history-delete savings-delete' data-sid=" + data[i].s_id + "><i class=' history-icon fa-solid fa-trash'></i> Delete </a> <a href = ' ' class='history-edit savings-edit' data-sid=" + data[i].s_id + "><i class=' history-icon fa-solid fa-pen'></i> Edit </button> </div>";
                }
                $("#savingshistory").html(output);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    });
    
 
    function showSavingsData() {
        output = "";
        $.ajax({
            url: "../controllers/personaluser_sdatahistory.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                for (i = 0; i < data.length; i++) {
                    output += "<body><div class='history-card-div'> <h5 class='history-title'><i class='history-icon fa-solid fa-coins'></i>" + data[i].s_name
                        + "</h5> <p class='time'>" + data[i].s_date
                        + "</p> <p class='history-money'>$" + data[i].s_amount
                        + "</p><a href=' ' class='history-delete savings-delete' data-sid=" + data[i].s_id + "><i class=' history-icon fa-solid fa-trash'></i> Delete </a> <a href = ' ' class='history-edit savings-edit' data-sid=" + data[i].s_id + "><i class=' history-icon fa-solid fa-pen'></i> Edit </button> </div></body>";
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
        let ps_amout = $("#savings-amount").val();
        let ps_type = $("#savings-type").val();

        console.log("=== ADD/UPDATE CLICKED ===");
        console.log("ps_id value:", ps_id);
        console.log("ps_id is empty?", ps_id === "");
        console.log("ps_name:", ps_name);
        console.log("ps_amount:", ps_amout);
        console.log("ps_type:", ps_type);

       
        if (ps_id && ps_id !== "") {
            
            mydata = { 
                s_id: ps_id,
                name: ps_name, 
                amount: ps_amout, 
                type: ps_type 
            };
            console.log(">>> UPDATING savings:", mydata);
            
            $.ajax({
                url: "../controllers/personaluser_updatesavingdata.php",
                method: "POST",
                data: JSON.stringify(mydata),
                success: function (data) {
                    console.log("Update response:", data);
                    $("#savings")[0].reset();
                    $("#savings_id").val("");
                    showSavingsData();
                },
                error: function(xhr, status, error) {
                    console.error("Update Error:", error);
                    alert("Failed to update savings: " + xhr.responseText);
                }
            });
        } else {
        
            mydata = { 
                name: ps_name, 
                amount: ps_amout, 
                type: ps_type 
            };
            console.log(">>> ADDING new savings:", mydata);
            
            $.ajax({
                url: "../controllers/personaluser_savingdata.php",
                method: "POST",
                data: JSON.stringify(mydata),
                success: function (data) {
                    console.log("Add response:", data);
                    $("#savings")[0].reset();
                    showSavingsData();
                },
                error: function(xhr, status, error) {
                    console.error("Add Error:", error);
                    alert("Failed to add savings: " + xhr.responseText);
                }
            });
        }
    });

  
    $(savingshistory).on("click", ".history-edit", function (e) {
        removeError("savings-name");
        removeError("savings-amount");
        removeError("savings-type");
        e.preventDefault();
        
        console.log("=== EDIT CLICKED ===");
        let id = $(this).attr("data-sid");
        console.log("Editing savings ID:", id);
        
        mydata = { s_id: id };
        
        $.ajax({
            url: "../controllers/personaluser_editsavingdata.php",
            method: "POST",
            dataType: "json",
            data: JSON.stringify(mydata),
            success: function (data) {
                console.log(">>> Data received from server:", data);
                console.log("s_id:", data.s_id);
                console.log("s_name:", data.s_name);
                console.log("s_amount:", data.s_amount);
                console.log("s_type:", data.s_type);
                
                $("#savings_id").val(data.s_id);
                $("#savings-name").val(data.s_name);
                $("#savings-amount").val(data.s_amount);
                $("#savings-type").val(data.s_type);
                
                console.log(">>> After setting values:");
                console.log("savings_id field:", $("#savings_id").val());
                console.log("savings-name field:", $("#savings-name").val());
                console.log("savings-amount field:", $("#savings-amount").val());
                console.log("savings-type field:", $("#savings-type").val());
            },
            error: function(xhr, status, error) {
                console.error("Edit AJAX Error:", status, error);
                console.error("Response:", xhr.responseText);
            }
        });
    });

  
    $(savingshistory).on("click", ".history-delete", function (e) {
        removeError("savings-name");
        removeError("savings-amount");
        removeError("savings-type");
        e.preventDefault();
        console.log("delete clicked");
        let id = $(this).attr("data-sid");
        console.log("the id is:" + id);
        mydata = { s_id: id };
        $.ajax({
            url: "../controllers/personaluser_deletesavingdata.php",
            method: "POST",
            data: JSON.stringify(mydata),
            success: function (data) {
                console.log(data);
                showSavingsData();
            },
        });
    });

});

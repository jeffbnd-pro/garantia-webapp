<h2>Ajouter une garantie</h2>



<form  method="post" id="addWarrantyForm">
    <label>Marque</label>
    <input type="text" name="brandWarranty" required>

    <label>Nom du produit</label>
    <input type="text" name="nameWarranty" required >

    <label>Date d'achat</label>
    <input type="date" name="purchaseDate" required >

    <label>Date fin de garantie</label>
    <input type="date" name="warrantyTime" required>

    <button type="submit">Ajouter</button>
</form>


<script>
// Variable to hold request
var request;
    console.log('ok');

$(document).ready(function() {
// Bind to the submit event of our form
$("#addWarrantyForm").submit(function(event){

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();
    console.log('ok');

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "http://localhost:8000/?page=addWarrantyBdd",
        type: "post",
        data: serializedData
    });


request.done(function (response, textStatus, jqXHR) {
    console.log(response);
    console.log("Garantie bien ajoutée");

    // 1. Vider le formulaire
    document.getElementById('addWarrantyForm').reset();

    // 2. Redirection vers le dashboard
    window.location.href = "http://localhost:8000/layout.php?page=dashboard";
});

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

})
});
</script>
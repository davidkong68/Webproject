function showSuccessMessage(message) {
    var successMessage = document.getElementById("success-message");
    successMessage.textContent = message;
    successMessage.style.color = "green";
    successMessage.style.display = "block";
}

function showErrorMessage(message) {
    var errorMessage = document.getElementById("errorMessage");
    errorMessage.textContent = message;
}

function resetMessages() {
    var successMessage = document.getElementById("success-message");
    var errorMessage = document.getElementById("errorMessage");

    successMessage.style.display = "none";
    errorMessage.textContent = "";
}

function donate() {
    resetMessages();

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var amount = document.getElementById("amount").value;
    var paymentType = document.getElementById("paymentType").value;

    // Check if all fields are filled
    if (name.trim() === "" || email.trim() === "" || amount.trim() === "") {
        showErrorMessage("Please fill in all the fields.");
        return;
    }

    // Validate the email format
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        showErrorMessage("Please enter a valid email address.");
        return;
    }

    // Validate the amount is a positive integer
    if (!/^[1-9]\d*$/.test(amount)) {
        showErrorMessage("Please enter a valid positive integer amount.");
        return;
    }

    // If all validation passes, reset error message
    showSuccessMessage("Donated successfully!");
}


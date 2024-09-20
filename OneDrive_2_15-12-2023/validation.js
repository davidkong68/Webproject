document.addEventListener("DOMContentLoaded", function() {
    // Function to display error message
    function showError(element, message) {
        const errorElement = document.getElementById(element + "-error");
        errorElement.textContent = message;
        errorElement.style.display = "block";
    }

    // Function to hide error message
    function hideError(element) {
        const errorElement = document.getElementById(element + "-error");
        errorElement.textContent = "";
        errorElement.style.display = "none";
    }

    // Function to validate email format
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Function to validate password length
    function validatePassword(password) {
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[0-9A-Za-z!@#$%]{6,12}$/;
        return passwordRegex.test(password);
    }

    // Function to validate form fields
    async function validateForm() {
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("pass_confirmation").value;

        // Reset all error messages
        hideError("name");
        hideError("email");
        hideError("password");
        hideError("pass-confirmation");

        // Validate Name
        if (name.trim() === "") {
            showError("name", "Name is required");
            return false;
        }

        // Validate Email
        if (email.trim() === "") {
            showError("email", "Email is required");
            return false;
        } else if (!validateEmail(email)) {
            showError("email", "Enter a valid email address");
            return false;
        }

        // Check email uniqueness on the server
        const isEmailTaken = await checkEmailUniqueness(email);

        if (isEmailTaken) {
            showError("email", "Email is already taken");
            return false;
        }

        // Validate Password
        if (password.trim() === "") {
            showError("password", "Password is required");
            return false;
        } else if (!validatePassword(password)) {
            showError("password", "Password must have at least one letter, at least one number, and there have to be 6-12 characters");
            return false;
        }

        // Validate Confirm Password
        if (confirmPassword.trim() === "") {
            showError("pass-confirmation", "Confirm Password is required");
            return false;
        }

        // If all validations pass, the form is considered valid
        return true;
    }

    // Function to check email uniqueness on the server
    async function checkEmailUniqueness(email) {
        try {
            const response = await fetch("validate_email.php?email=" + encodeURIComponent(email));
            const json = await response.json();
            return !json.available;
        } catch (error) {
            console.error("Error checking email uniqueness:", error);
            return false; // Assume email is not taken to avoid blocking the form
        }
    }

    // Attach event listener to the form's submit event
    document.getElementById("signup").addEventListener("submit", async function(event) {
        // Prevent the form from submitting if validation fails
        if (!(await validateForm())) {
            event.preventDefault();
        }
    });

});
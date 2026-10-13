```javascript
const form = document.getElementById("studentForm");

form.addEventListener("submit", function (event) {

    let valid = true;

    const fullname = document.getElementById("fullname");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");

    const fullnameError = document.getElementById("fullnameError");
    const emailError = document.getElementById("emailError");
    const phoneError = document.getElementById("phoneError");

    // Clear previous errors
    fullnameError.textContent = "";
    emailError.textContent = "";
    phoneError.textContent = "";

    // Validate full name
    if (fullname.value.trim().length < 3) {

        fullnameError.textContent =
            "Please enter your full name.";

        valid = false;
    }

    // Validate email
    const emailPattern =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email.value)) {

        emailError.textContent =
            "Please enter a valid email address.";

        valid = false;
    }

    // Validate phone
    const phonePattern =
        /^(07|01)\d{8}$/;

    if (!phonePattern.test(phone.value)) {

        phoneError.textContent =
            "Enter a valid Kenyan phone number.";

        valid = false;
    }

    if (!valid) {
        event.preventDefault();
        return;
    }

    const submitButton =
        document.getElementById("submitBtn");

    submitButton.textContent = "Submitting...";
    submitButton.disabled = true;
});
```

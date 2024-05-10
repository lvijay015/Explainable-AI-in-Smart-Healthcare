// Function to calculate age from date of birth
function calculateAge(dateOfBirth) {
    var today = new Date();
    var birthDate = new Date(dateOfBirth);
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

// Event listener for date of birth input
document.getElementById('dob').addEventListener('change', function() {
    var dob = this.value;
    var age = calculateAge(dob);
    document.getElementById('age').value = age;

    // Check if the calculated age is less than 15
    var ageWarning = document.getElementById('ageWarning');
    if (age < 15) {
        ageWarning.textContent = "Age must be at least 15";
    } else {
        ageWarning.textContent = "";
    }
});

// Password length warning
document.getElementById('password').addEventListener('input', function() {
    var password = this.value;
    var passwordWarning = document.getElementById('passwordWarning');
    if (password.length < 8) {
        passwordWarning.textContent = "Password must be at least 8 characters long";
    } else {
        passwordWarning.textContent = "";
    }
});

// Email validation
document.getElementById('email').addEventListener('input', function() {
    var email = this.value;
    var emailWarning = document.getElementById('emailWarning');
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        emailWarning.textContent = "Please enter a valid email address";
    } else {
        emailWarning.textContent = "";
    }
});
document.getElementById('phoneNumber').addEventListener('input', function() {
    var phoneNumber = this.value;
    var phoneNumberWarning = document.getElementById('phoneNumberWarning');
    var phoneNumberRegex = /^\d{10}$/; // Validating 10 digits phone number

    if (!phoneNumberRegex.test(phoneNumber)) {
        phoneNumberWarning.textContent = "Please enter a valid phone number";
    } else {
        phoneNumberWarning.textContent = "";
    }
});

flatpickr("#dob", {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d"
});
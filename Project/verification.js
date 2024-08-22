// ================================================================================ Registration Form Validation ================================================================================
document.getElementById('RLForm').addEventListener('submit', function (event) {
    let valid = true;

    // Name Validation
    const name = document.getElementById('Name');
    const namePattern = /^[A-Za-z ]+$/;
    if (name.value.trim() === '') {
        document.getElementById('nameError').textContent = 'Name is required';
        valid = false;
    } else if (!namePattern.test(name.value.trim())) {
        document.getElementById('nameError').textContent = 'Invalid name format';
        valid = false;
    } else {
        document.getElementById('nameError').textContent = '';
    }

    // Username Validation
    const username = document.getElementById('userName');
    const usernamePattern = /^[A-Za-z0-9]+$/;
    if (username.value.trim().length < 3) {
        document.getElementById('usernameError').textContent = 'Must be at least 3 characters long';
        valid = false;
    } else if (!usernamePattern.test(username.value.trim())) {
        document.getElementById('usernameError').textContent = 'Invalid username format';
        valid = false;
    } else {
        document.getElementById('usernameError').textContent = '';
    }

    // Email Validation
    const email = document.getElementById('Email');
    const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    if (!emailPattern.test(email.value.trim())) {
        document.getElementById('emailError').textContent = 'Invalid email format';
        valid = false;
    } else {
        document.getElementById('emailError').textContent = '';
    }

    // Telephone Validation
    const tel = document.getElementById('Telno');
    const telValue = tel.value.trim();
    const telPattern = /^[0-9]+$/;
    const startsWithZero = telValue.startsWith('0');
    const consecutiveSameDigitPattern = /(.)\1{9,}/;

    if (telValue === '') {
        document.getElementById('telError').textContent = 'Telephone number is required';
        valid = false;
    } else if (!telPattern.test(telValue)) {
        document.getElementById('telError').textContent = 'Invalid telephone number format';
        valid = false;
    } else if (!startsWithZero) {
        document.getElementById('telError').textContent = 'Telephone number must start with 0';
        valid = false;
    } else if (consecutiveSameDigitPattern.test(telValue)) {
        document.getElementById('telError').textContent = 'Telephone number cannot contain the same digit repeated 10 times';
        valid = false;
    } else {
        document.getElementById('telError').textContent = '';
    }

    // Password Validation
    const password = document.getElementById('Pswd');
    const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!passwordPattern.test(password.value)) {
        document.getElementById('pswdError').textContent = 'Password must be at least 8 characters long and contain at least one number, one uppercase and one lowercase letter';
        valid = false;
    } else {
        document.getElementById('pswdError').textContent = '';
    }

    // Confirm Password Validation
    const confirmPassword = document.getElementById('Rpswd');
    if (password.value !== confirmPassword.value) {
        document.getElementById('RpswdError').textContent = 'Passwords do not match';
        valid = false;
    } else {
        document.getElementById('RpswdError').textContent = '';
    }

    if (!valid) {
        event.preventDefault(); // Prevent form submission if validation fails
    }
});

// ================================================================================ Item & Category Form Validation ================================================================================

document.addEventListener('DOMContentLoaded', function () {
    // Add Item Form Validation
    document.querySelector('form[action=""]').addEventListener('submit', function (event) {
        const name = document.getElementById('name');
        const description = document.getElementById('description');
        const quantity = document.getElementById('quantity');
        const price = document.getElementById('price');
        const category = document.getElementById('category_id');

        let valid = true;

        // Validate Item Name
        if (!name.value.trim().match(/^[A-Za-z ]+$/)) {
            alert('Item Name must contain only letters and spaces.');
            valid = false;
        }

        // Validate Quantity
        if (!quantity.value.trim().match(/^[0-9]+$/) || quantity.value <= 0) {
            alert('Quantity must be a positive number.');
            valid = false;
        }

        // Validate Price
        if (!price.value.trim().match(/^\d+(\.\d{1,2})?$/) || price.value <= 0) {
            alert('Price must be a positive number with up to two decimal places.');
            valid = false;
        }

        // Validate Description (if necessary, can add more specific checks)
        if (description.value.trim() === '') {
            alert('Description is required.');
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Add Category Form Validation
    document.querySelector('form[action=""]').addEventListener('submit', function (event) {
        const categoryName = document.getElementById('category_name');

        if (!categoryName.value.trim().match(/^[A-Za-z ]+$/)) {
            alert('Category Name must contain only letters and spaces.');
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Update Item Form Validation
    document.querySelector('form[action=""]').addEventListener('submit', function (event) {
        const id = document.getElementById('id');
        const name = document.getElementById('name');
        const description = document.getElementById('description');
        const quantity = document.getElementById('quantity');
        const price = document.getElementById('price');

        let valid = true;

        // Validate ID
        if (!id.value.trim().match(/^[0-9]+$/) || id.value <= 0) {
            alert('Item ID must be a positive number.');
            valid = false;
        }

        // Validate New Item Name
        if (name.value.trim() !== '' && !name.value.trim().match(/^[A-Za-z ]+$/)) {
            alert('New Item Name must contain only letters and spaces.');
            valid = false;
        }

        // Validate New Quantity
        if (quantity.value.trim() !== '' && (!quantity.value.trim().match(/^[0-9]+$/) || quantity.value <= 0)) {
            alert('New Quantity must be a positive number.');
            valid = false;
        }

        // Validate New Price
        if (price.value.trim() !== '' && (!price.value.trim().match(/^\d+(\.\d{1,2})?$/) || price.value <= 0)) {
            alert('New Price must be a positive number with up to two decimal places.');
            valid = false;
        }

        // Validate New Description (if necessary, can add more specific checks)
        if (description.value.trim() === '') {
            alert('New Description is required.');
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Delete Item Form Validation
    document.querySelector('form[action=""]').addEventListener('submit', function (event) {
        const idOrName = document.getElementById('id_or_name');

        if (!idOrName.value.trim().match(/^[0-9]+$/) && idOrName.value.trim() === '') {
            alert('Item ID or Name is required.');
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});

/*
 ================================================================================ Typewriter animation ================================================================================
*/

// Constructor function for the typewriter effect
var TxtType = function (el, toRotate, period) {
    this.toRotate = toRotate; // Array of strings to rotate through
    this.el = el; // The element where the effect will be applied
    this.loopNum = 0; // The current loop number
    this.period = parseInt(period, 10) || 2000; // Duration of each typing cycle (in milliseconds)
    this.txt = ''; // The current text being displayed
    this.tick(); // Start the typing animation
    this.isDeleting = false; // Flag to indicate if text is being deleted
};

// Function to handle the typing and deleting effect
TxtType.prototype.tick = function () {
    var i = this.loopNum % this.toRotate.length; // Get the index of the current string
    var fullTxt = this.toRotate[i]; // Get the full text of the current string

    // Update the displayed text based on whether we are typing or deleting
    if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1); // Remove one character
    } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1); // Add one character
    }

    this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>'; // Update the element's content

    var that = this; // Reference to the current object
    var delta = 200 - Math.random() * 100; // Typing speed with some randomness

    if (this.isDeleting) { delta /= 2; } // Slow down the deletion speed

    // Determine the next action based on the current state
    if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period; // Pause after typing
        this.isDeleting = true; // Start deleting
    } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false; // Start typing again
        this.loopNum++; // Move to the next string
        delta = 500; // Short pause before typing
    }

    // Call the tick function again after the delay
    setTimeout(function () {
        that.tick();
    }, delta);
};

// Initialize the typewriter effect when the page loads
window.onload = function () {
    var elements = document.getElementsByClassName('typewrite'); // Get all elements with the 'typewrite' class
    for (var i = 0; i < elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type'); // Get the text to rotate
        var period = elements[i].getAttribute('data-period'); // Get the typing period
        if (toRotate) {
            new TxtType(elements[i], JSON.parse(toRotate), period); // Apply the typewriter effect
        }
    }

    // Inject CSS for the typewriter effect
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}"; // Style for the cursor effect
    document.body.appendChild(css); // Add the style to the document
};

/*
 ================================================================================ On scroll animations ================================================================================
*/

// Add 'show' class to elements with the 'hidden-cls' class when they come into view
const hiddenElemnts = document.querySelectorAll('.hidden-cls'); // Select all elements with the 'hidden-cls' class
const observer = new IntersectionObserver((entries) => { // Create an IntersectionObserver
    entries.forEach((entry) => {
        if (entry.isIntersecting) { // Check if the element is in view
            entry.target.classList.add('show'); // Add 'show' class to make the element visible
        }
    });
});
hiddenElemnts.forEach((elem) => {
    observer.observe(elem); // Observe each element
});

/*
 ================================================================================ Button click event handlers ================================================================================
*/


    // Add event listener to the 'getstartedbtn' button to redirect to the register page
    document.getElementById('getstartedbtn').addEventListener('click', function () {
        window.location.href = 'register.php'; // Redirect to register page
    });

    // Add event listener to the 'loginbtn' button to redirect to the login page
    document.getElementById('loginbtn').addEventListener('click', function () {
        window.location.href = 'login.php'; // Redirect to login page
    });

    // Add event listener to the 'login' button to redirect to the home page
    document.getElementById('login').addEventListener('click', function () {
        window.location.href = 'home.php'; // Redirect to home page
    });

    // Add event listener to the 'clearBtn' button to clear form fields
    document.getElementById('clearBtn').addEventListener('click', function () {
        document.getElementById('id').value = ''; // Clear ID field
        document.getElementById('name').value = ''; // Clear name field
        document.getElementById('category').value = ''; // Clear category field
    });



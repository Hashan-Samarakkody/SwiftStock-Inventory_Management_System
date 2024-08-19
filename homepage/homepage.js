document.addEventListener("DOMContentLoaded", function() {
    // Simulate fetching user and inventory data from backend
    const username = "John Doe";
    const totalItems = 120;
    const lowStock = 5;

    // Display fetched data
    document.getElementById("username").textContent = username;
    document.getElementById("total-items").textContent = totalItems;
    document.getElementById("low-stock").textContent = lowStock;
});

function manageItems() {
    alert("Redirecting to Manage Items page...");
    // Implement redirection to Manage Items page
}

function viewReports() {
    alert("Redirecting to View Reports page...");
    // Implement redirection to View Reports page
}

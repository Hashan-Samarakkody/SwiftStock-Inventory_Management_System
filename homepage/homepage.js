document.addEventListener('DOMContentLoaded', () => {
    const username = 'John Doe'; // This would come from your authentication system
    const totalItems = 100; // This would come from your backend system
    const lowStock = 5; // This would come from your backend system

    document.getElementById('username').textContent = username;
    document.getElementById('total-items').textContent = totalItems;
    document.getElementById('low-stock').textContent = lowStock;

    document.getElementById('manage-items').addEventListener('click', () => {
        // Redirect to Manage Items page
        window.location.href = '/manage-items';
    });

    document.getElementById('view-reports').addEventListener('click', () => {
        // Redirect to View Reports page
        window.location.href = '/view-reports';
    });
});

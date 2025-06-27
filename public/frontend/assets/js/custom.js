function showToast({
    icon = 'info',
    title = '',
    text = '',
    timer = 3000,
    position = 'top-end',
}) {
    Swal.fire({
        icon: icon, // Type of the notification (success, error, warning, info)
        title: title, // Title of the notification
        text: text, // Optional text message
        position: position, // Position of the toast on the screen (default: top-end)
        toast: true, // Enable toast style notification
        showConfirmButton: false, // Hide the confirm button
        timer: timer, // Duration of the toast (in ms)
        timerProgressBar: true, // Show progress bar during the timer
        background: '#f8f9fa', // Background color (optional)
        showClass: {
            popup: 'swal2-noanimation', // No animations (optional)
        },
        hideClass: {
            popup: 'swal2-hide', // No hide animation (optional)
        },
        customClass: {
            popup: 'custom-toast', // Custom class for additional styling (optional)
        },
    })
}
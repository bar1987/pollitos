document.addEventListener('DOMContentLoaded', () => {
    const reserveButtons = document.querySelectorAll('.reserve-button');

    reserveButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const timeSlot = event.target.dataset.timeslot;
            reserveTimeSlot(timeSlot);
        });
    });
});

function reserveTimeSlot(timeSlot) {
    // Logic to handle reservation
    alert(`You have reserved the time slot: ${timeSlot}`);
    // Additional code to update the server or UI can be added here
}
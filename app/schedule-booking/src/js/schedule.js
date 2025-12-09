// This file manages the display of available schedules, fetching data and updating the DOM accordingly.

document.addEventListener('DOMContentLoaded', () => {
    const scheduleContainer = document.getElementById('schedule-container');

    // Sample data for available schedules
    const availableSchedules = [
        { time: '09:00 AM', available: true },
        { time: '10:00 AM', available: true },
        { time: '11:00 AM', available: false },
        { time: '01:00 PM', available: true },
        { time: '02:00 PM', available: false },
    ];

    function renderSchedules() {
        scheduleContainer.innerHTML = '';
        availableSchedules.forEach(schedule => {
            const scheduleDiv = document.createElement('div');
            scheduleDiv.className = 'schedule-item';
            scheduleDiv.innerText = schedule.time;

            if (schedule.available) {
                const reserveButton = document.createElement('button');
                reserveButton.innerText = 'Reserve';
                reserveButton.className = 'reserve-button';
                reserveButton.addEventListener('click', () => {
                    alert(`You have reserved the ${schedule.time} slot.`);
                });
                scheduleDiv.appendChild(reserveButton);
            } else {
                scheduleDiv.className += ' unavailable';
                scheduleDiv.innerText += ' - Unavailable';
            }

            scheduleContainer.appendChild(scheduleDiv);
        });
    }

    renderSchedules();
});
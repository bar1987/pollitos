class Schedule {
    constructor() {
        this.timeSlots = [];
    }

    fetchAvailableSchedules() {
        // Simulate fetching available schedules from an API
        this.timeSlots = [
            { time: '09:00 AM', available: true },
            { time: '10:00 AM', available: true },
            { time: '11:00 AM', available: false },
            { time: '01:00 PM', available: true },
            { time: '02:00 PM', available: false },
        ];
    }

    render() {
        const scheduleContainer = document.getElementById('schedule');
        scheduleContainer.innerHTML = '';

        this.timeSlots.forEach(slot => {
            const slotElement = document.createElement('div');
            slotElement.className = 'time-slot';
            slotElement.textContent = slot.time;

            if (slot.available) {
                const reserveButton = new ReservationButton(slot.time);
                slotElement.appendChild(reserveButton.render());
            } else {
                slotElement.classList.add('unavailable');
            }

            scheduleContainer.appendChild(slotElement);
        });
    }
}

export default Schedule;
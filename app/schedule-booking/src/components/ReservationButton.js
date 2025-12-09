class ReservationButton {
    constructor(schedule) {
        this.schedule = schedule;
        this.button = document.createElement('button');
        this.button.innerText = 'Reserve';
        this.button.addEventListener('click', () => this.handleReserve());
    }

    handleReserve() {
        // Logic to handle reservation
        alert(`Reservation made for ${this.schedule}`);
    }

    render() {
        return this.button;
    }
}

export default ReservationButton;
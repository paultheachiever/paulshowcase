<script>
        
        document.querySelector(".menu-toggle").addEventListener("click", function() {
            document.querySelector(".nav-links").classList.toggle("show");
        });
    
    const images = [
    'pic3.png',
    'pic4.png',
    'pic5.png',
    'pic6.png',

    ];
    let index = 0;
    const pic = document.querySelector('.pic');
function changebg(){
    pic.style.backgroundImage =     `url(${images[index]})`;
    pic.classList.add('active');

    setTimeout(() =>{
        pic.style.backgroundImage =     `url(${images[index]})`;
        pic.classList.remove('active');

         index = (index + 1) % images.length;

    },3000);


}
setInterval(changebg,5000);
changebg()


const phoneDialog = document.getElementById("phoneDialog");
        const reservationDialog = document.getElementById("reservationDialog");

        // Open phone input dialog
        document.getElementById("confirmations").addEventListener("click", () => {
            phoneDialog.showModal();
        });

        // Close phone input dialog
        document.getElementById("closePhoneDialog").addEventListener("click", () => {
            phoneDialog.close();
        });

        // Handle phone number confirmation
        document.getElementById("confirmPhone").addEventListener("click", () => {
            const phoneNumber = document.getElementById("phoneInput").value;
            if (phoneNumber.trim() === "") {
                alert("Please enter a phone number.");
                return;
            }

            // Fetch reservation data based on phone number
            fetch("fetch_reservation.php?PHONE=" + encodeURIComponent(phoneNumber))
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("No reservation found for this phone number.");
                    } else {
                        let output = `
                            <p><b>Full Name:</b> ${data.NAME}</p>
                            <p><b>Phone:</b> ${data.PHONE}</p>
                            <p><b>Email:</b> ${data.EMAIL}</p>
                            <p><b>Check-in Date:</b> ${data.DATEIN}</p>
                            <p><b>Check-out Date:</b> ${data.DATEOUT}</p>
                            <p><b>Guests:</b> ${data.GUESTS}members</p>
                            <p><b>Rooms booked:</b> ${data.ROOMS}rooms</p>
                        `;
                        document.getElementById("reservationData").innerHTML = output;
                        reservationDialog.showModal();
                        console.log("fetching data");
                    }
                })
                .catch(error => {
                    alert("Error fetching reservation details.");
                    console.error(error);
                });

            phoneDialog.close();
        });

        // Close reservation details dialog
        document.getElementById("closeReservationDialog").addEventListener("click", () => {
            reservationDialog.close();
        });

    </script>
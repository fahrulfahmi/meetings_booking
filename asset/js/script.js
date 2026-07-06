// =========================
// Meeting Booking System
// =========================

document.addEventListener("DOMContentLoaded", function () {

    console.log("Meeting Booking System Loaded");

    // Auto close alert
    const alerts = document.querySelectorAll(".alert");

    alerts.forEach(function(alert){

        setTimeout(function(){

            alert.style.transition="0.5s";
            alert.style.opacity="0";

            setTimeout(function(){

                alert.remove();

            },500);

        },3000);

    });

});
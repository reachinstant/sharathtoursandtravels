document.addEventListener("DOMContentLoaded", function() {
    // Array of video file names
    const videos = [
        '../videos/banner.mp4',
        '../videos/banner.mp4',
        '../videos/banner.mp4'
    ];

    // Function to get a random video
    function getRandomVideo() {
        const randomIndex = Math.floor(Math.random() * videos.length);
        return videos[randomIndex];
    }

    // Set the video source
    const videoElement = document.getElementById('car-video');
    videoElement.src = `videos/${getRandomVideo()}`;
});



$(document).ready(function() {
    $('#scroll-to-contact').click(function(event) {
        event.preventDefault(); // Prevent default link behavior
        $('html, body').animate({
            scrollTop: $('#contact').offset().top
        }, 1000); // Duration in milliseconds
    });

    $(window).on('scroll', function() {
        if ($(window).scrollTop() + $(window).height() > $('#contact').offset().top) {
            $('#contact').addClass('scrolled');
        }
    });
});

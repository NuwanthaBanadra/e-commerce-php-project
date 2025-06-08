// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("backToTopBtn").style.display = "block";
    } else {
        document.getElementById("backToTopBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document with slow-motion animation
function topFunction() {
    // Get the current scroll position
    var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;

    // If the current scroll position is not at the top
    if (currentScroll > 0) {
        // Calculate the step size for smooth scrolling
        var step = Math.floor(currentScroll / 20); // Adjust the divisor for desired smoothness

        // Scroll to the top with animation
        scrollToTop(step);
    }
}

// Function to scroll to the top with animation
function scrollToTop(step) {
    // Get the current scroll position
    var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;

    // If the current scroll position is not at the top
    if (currentScroll > 0) {
        // Scroll to the top gradually
        window.scrollTo(0, currentScroll - step);

        // Call the function recursively with a slight delay for slow-motion effect
        setTimeout(function() {
            scrollToTop(step);
        }, 10); // Adjust the delay for desired animation speed
    }
}

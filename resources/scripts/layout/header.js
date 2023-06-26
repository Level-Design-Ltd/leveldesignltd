const body = document.body;
const banner = document.querySelector(".banner");
const scrollUp = "scroll-up";
const scrollDown = "scroll-down";
const scrolled = "scrolled";
let lastScroll = 0;
let scrollPosition = window.scrollY || document.documentElement.scrollTop;

document.addEventListener("scroll", function () {
    const currentScroll = window.scrollY;
    scrollPosition = window.scrollY || document.documentElement.scrollTop;

    if (scrollPosition > 80) {
        banner.classList.add(scrolled);
    } else {
        banner.classList.remove(scrolled);
    }

    if (currentScroll <= 100) {
        body.classList.remove(scrollUp);
        return;
    }

    if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
        // down
        body.classList.remove(scrollUp);
        body.classList.add(scrollDown);
    } else if (
        currentScroll < lastScroll &&
        body.classList.contains(scrollDown)
    ) {
        // up
        body.classList.remove(scrollDown);
        body.classList.add(scrollUp);
    }
    lastScroll = currentScroll;
});

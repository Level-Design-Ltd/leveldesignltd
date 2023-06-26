const toggleMenu = document.querySelector(".menu-toggle");
const menuItem = document.querySelectorAll(
    ".nav-mobile .menu-item-has-children > a"
);

if (toggleMenu) {
    toggleMenu.addEventListener("click", () => {
        const iconBurger = document.querySelector(".menu-toggle .burger");
        const navMenu = document.querySelector(".nav-mobile");

        navMenu.classList.toggle("open");
        iconBurger.classList.toggle("closed");

        if (navMenu.classList.contains("open")) {
            document.querySelector("body").classList.add("menu-open");
        } else {
            document.querySelector("body").classList.remove("menu-open");
        }
    });
}

if (menuItem) {
    Array.prototype.forEach.call(menuItem, function (item) {
        item.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const subMenuChildren = this.parentNode.querySelector(".sub-menu");

            subMenuChildren.classList.add("show");
        });

        Array.prototype.forEach.call(
            item.parentNode.querySelectorAll("a.back"),
            function (icon) {
                icon.addEventListener("click", function () {
                    this.parentNode.classList.remove("show");
                });
            }
        );
    });
}

document.addEventListener("click", function (e) {
    const menuToggle = document.querySelector(".menu-toggle");
    const iconBurger = document.querySelector(".menu-toggle .burger");
    const navMenu = document.querySelector(".nav-mobile");

    if (
        navMenu.classList.contains("open") &&
        e.target !== menuToggle &&
        !menuToggle.contains(e.target) &&
        !navMenu.contains(e.target) &&
        !document.querySelector(".banner").contains(e.target)
    ) {
        navMenu.classList.remove("open");
        iconBurger.classList.toggle("closed");
        document.querySelector("body").classList.remove("menu-open");
    }
});

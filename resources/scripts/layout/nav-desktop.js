const menuItem = document.querySelectorAll(
    ".nav-primary ul:not(.sub-menu) .menu-item-has-children .sub-menu-title"
);
const SubMenuChildren = document.querySelectorAll(".sub-menu");

if (menuItem) {
    Array.prototype.forEach.call(menuItem, function (item) {
        item.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const thisSubMenuChildren =
                this.parentNode.querySelector(".sub-menu");

            if (thisSubMenuChildren.classList.contains("sub-menu")) {
                thisSubMenuChildren.classList.add("show");
            }

            Array.prototype.forEach.call(SubMenuChildren, function (menu) {
                if (menu !== thisSubMenuChildren) {
                    menu.classList.remove("show");
                }
            });
        });

        // Close all menus on document click
        document.addEventListener("click", (e) => {
            Array.prototype.forEach.call(SubMenuChildren, function (menu) {
                if (e.target !== menu) {
                    menu.classList.remove("show");
                }
            });
        });
    });
}

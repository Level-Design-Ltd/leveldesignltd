import domReady from "@roots/sage/client/dom-ready";

// Layout
import "./layout/header.js";
import "./layout/nav-desktop.js";
import "./layout/nav-mobile.js";
import "./layout/blob.js";

/**
 * Application entrypoint
 */
domReady(async () => {
    // ...
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
import.meta.webpackHot?.accept(console.error);

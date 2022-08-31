require("./bootstrap");

require("alpinejs");

document
    .querySelectorAll(".submit-disabled")
    .forEach(elm =>
        elm.addEventListener("submit", evt =>
            disableBtn(evt.target.querySelector("button[type=submit]"), true)
        )
    );

window.Vue = require("vue").default;

Vue.component("home", require("./components/Home.vue").default);

const app = new Vue({
    el: "#app"
});

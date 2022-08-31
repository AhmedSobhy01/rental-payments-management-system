require("./helpers");
window._ = require("lodash");

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.Swal = require("sweetalert2");

const { Notyf } = require("notyf");
window.notyf = new Notyf({
    duration: 5000,
    position: { x: "right", y: "top" }
});

require("./bootstrap");

require("alpinejs");
require("livewire-sortable");

document
    .querySelectorAll(".submit-disabled")
    .forEach(elm =>
        elm.addEventListener("submit", evt =>
            disableBtn(evt.target.querySelector("button[type=submit]"), true)
        )
    );

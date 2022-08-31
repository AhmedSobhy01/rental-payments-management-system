window.disableBtn = (btn, loader) => {
    let removedClasses = [];
    if (btn.dataset.hasOwnProperty("removedClasses"))
        removedClasses.push(...btn.dataset.removedClasses.split(","));

    btn.classList.add("cursor-not-allowed", "bg-opacity-50");

    btn.classList.forEach(cls => {
        if (cls.startsWith("focus:bg-") || cls.startsWith("hover:bg-")) {
            btn.classList.remove(cls);
            removedClasses.push(cls);
        }
    });

    btn.dataset.removedClasses = removedClasses.join(",");

    btn.disabled = true;

    if (loader === true) {
        btn.innerHTML =
            '<i class="fas fa-spinner animate-spin mr-2"></i>' + btn.innerHTML;
    }
};

window.enableBtn = btn => {
    btn.classList.remove("cursor-not-allowed", "bg-opacity-50");

    btn.dataset.removedClasses
        .split(",")
        .forEach(cls => (cls ? btn.classList.add(cls) : false));

    delete btn.dataset.removedClasses;

    btn.disabled = false;

    btn.innerHTML = btn.innerHTML.replace(
        '<i class="fas fa-spinner animate-spin mr-2"></i>',
        ""
    );
};

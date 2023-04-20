window.onload = () => {
    if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
    ) {
        toggleTheme();
    }
}

const btnToggleTheme = document.querySelector("button.toggle-theme");
btnToggleTheme.addEventListener("click", e => toggleTheme(e));

function toggleTheme(e = '') {
    e != '' ?? e.preventDefault();
    darkTheme = !darkTheme;
    if (darkTheme) {
        document.querySelector("button.toggle-theme i").classList.remove("fa-moon");
        document.querySelector("button.toggle-theme i").classList.add("fa-sun");
        document.querySelector(":root").classList.add("dark");
    } else {
        document.querySelector(":root").classList.remove("dark");
        document.querySelector("button.toggle-theme i").classList.add("fa-moon");
        document.querySelector("button.toggle-theme i").classList.remove("fa-sun");
    }
}
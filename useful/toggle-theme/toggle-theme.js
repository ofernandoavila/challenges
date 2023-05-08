/**
 * @description Toggle current theme
 * @param {string?} e (optional) Event object
 * @returns {void}
 */
function toggleTheme(e = '') {
    e != '' ?? e.preventDefault();
    darkTheme = !darkTheme;
    if (darkTheme) {      
    //   document.querySelector("button.toggle-theme i").classList.remove("fa-moon");
    //   document.querySelector("button.toggle-theme i").classList.add("fa-sun");

        document.documentElement.style.removeProperty("--toggle-theme-icon");
        document.documentElement.style.setProperty("--toggle-theme-icon", '"sun"');
        document.querySelector(":root").classList.add("dark");
    } else {
        document.querySelector(":root").classList.remove("dark");
        document.documentElement.style.removeProperty("--toggle-theme-icon");
        document.documentElement.style.setProperty("--toggle-theme-icon", '"moon"');

        // document.querySelector("button.toggle-theme i").classList.add("fa-moon");
        // document.querySelector("button.toggle-theme i").classList.remove("fa-sun");
    }
    
    SaveInBrowser('ofernandoavila_challenges_prod', darkTheme.toString());
}

/**
 * @description Toggle theme by device preference
 * @returns {void}
 */
function initToggleTheme() {
    console.log();
    if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
    ) {
        if(
            GetFromBrowser('ofernandoavila_challenges_prod') != null
        ) {
            if(
                GetFromBrowser('ofernandoavila_challenges_prod') == 'true'
            ) {
                toggleTheme();
            }
        } else {
            toggleTheme();
        }
    }
}

let darkTheme = false;

initToggleTheme();

const btnToggleTheme = document.querySelector("button.toggle-theme");
btnToggleTheme.addEventListener("click", e => toggleTheme(e));

let fondSombre = document.querySelector("#fond-sombre");
let fenetre = document.querySelector("#fenetre");
let menuBurger = document.querySelector("#menuburger");

menuBurger.addEventListener("click", handleClickMenuBurger);

function handleClickMenuBurger() {
    fenetre.classList.remove("hidden");
    fenetre.classList.add("flex");
    fondSombre.classList.remove("hidden");
};

fondSombre.addEventListener("click", handleClickFond);

function handleClickFond() {
    fenetre.classList.add("hidden");
    fenetre.classList.remove("flex");
    fondSombre.classList.add("hidden");
};
const items = document.querySelectorAll(".items");

function animation(e) {
    e.currentTarget.style.backgroundColor = "#bebebeed";
    e.currentTarget.children[0].classList.add("animated")
}

function animationClear(e) {
    e.currentTarget.style.backgroundColor = "#ffffff";
    e.currentTarget.children[0].classList.remove("animated")
}

items.forEach(item => {
    item.addEventListener("mouseover", animation);
    item.addEventListener("mouseleave", animationClear);
});
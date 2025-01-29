//запускается при прокручивании страницы
window.onscroll = function() {stickyHeader()};

let headerElement = document.getElementById("sticky_header");
let offset = headerElement.offsetTop;
console.log('sticky offsetTop ', offset);

function stickyHeader() {
    if (window.scrollY > offset) {
        headerElement.classList.add("sticky");
    } else {
        headerElement.classList.remove("sticky");
    }
}
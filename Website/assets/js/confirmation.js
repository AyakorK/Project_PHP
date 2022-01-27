let elems = document.getElementsByClassName('confirmation');
let confirmIt = function (e) {
    if (!confirm('Are you sure?')) e.preventDefault();
};
for (let i = 0, l = elems.length; i < l; i++) {
    elems[i].addEventListener('click', confirmIt, false);
}
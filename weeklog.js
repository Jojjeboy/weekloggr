window.scrollTo(0, document.body.scrollHeight);

function copyToInput(btn, id){
    const txt = document.querySelector('.text-' + id).textContent.trim();
    document.querySelector('form input').setAttribute('value', txt);
}


function addClass(ele, cls) {
    if (!hasClass(ele, cls)) ele.className += " " + cls;
}

function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        ele.className = ele.className.replace(reg, ' ');
    }
}
function hasClass(ele, cls) {
    return !!ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}
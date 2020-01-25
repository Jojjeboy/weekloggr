window.scrollTo(0, document.body.scrollHeight);

const appUrl = document.location.href;

function copyToInput(btn, id, update){
    const txt = document.querySelector('.text-' + id).textContent.trim();
    const date = document.querySelector('.date-' + id).getAttribute('data-date').trim();
    document.querySelector('.dateupdate').setAttribute('value', date);
    document.querySelector('form input').setAttribute('value', txt);
    if(update === true){
        addClass(document.querySelector('form'), 'update');
        removeClass(document.querySelector('.dateupdate'), 'd-none');
        document.querySelector('form').setAttribute('action', appUrl + 'update' + '/' + id);
        document.querySelector('form input').className += ' warning-border';
    }
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
window.scrollTo(0, document.body.scrollHeight);

const appUrl = document.location.href;

const arrowRightHtml = '<svg class="bi bi-chevron-right" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
                    '<path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd"></path>' + 
                   '</svg>';
const arrowUpHtml = '<svg class="bi bi-chevron-up" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
                        '<path fill-rule="evenodd" d="M9.646 6.646a.5.5 0 01.708 0l6 6a.5.5 0 01-.708.708L10 7.707l-5.646 5.647a.5.5 0 01-.708-.708l6-6z" clip-rule="evenodd"></path>' +
                    '</svg>';

function copyToInput(btn, id, update){
    const txt = document.querySelector('.text-' + id).textContent.trim();
    document.querySelector('form input').setAttribute('value', txt);
    if(update === true){
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

function toggleArrow(arrow){
    if(arrow.innerHTML.trim() == arrowRightHtml){
        arrow.innerHTML = arrowUpHtml;
    }
    else {
        arrow.innerHTML = arrowRightHtml;
    }
}


document.querySelectorAll('.navbar-brand').forEach(div => {
    div.addEventListener('click', function() {
        toggleArrow(this);
    });
});
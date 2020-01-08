window.scrollTo(0, document.body.scrollHeight);


let allHiddenLi = document.querySelectorAll("li.show-0");
for (var i = 0; i < allHiddenLi.length; ++i) {
    allHiddenLi[i].parentNode.firstElementChild.firstElementChild.classList.remove('d-none');
}

function toggleArchived(btn, status) {
    let allHiddenLi = btn.parentNode.parentNode.querySelectorAll('li.show-0');
    if(status === 1){
        for (var i = 0; i < allHiddenLi.length; ++i) {
            addClass(allHiddenLi[i], 'showAnyway');
        }
        btn.setAttribute('onclick', "toggleArchived(this, 0)");
        btn.innerText = 'Göm arkiverade';
    }
    else {
        for (var i = 0; i < allHiddenLi.length; ++i) {
            removeClass(allHiddenLi[i], 'showAnyway');
        }
        btn.setAttribute('onclick', "toggleArchived(this, 1)");
        btn.innerText = 'Visa arkiverade';
    }
}

function hideArchived(btn) {
    let allHiddenLi = btn.parentNode.parentNode.querySelectorAll('li.show-0');
    for (var i = 0; i < allHiddenLi.length; ++i) {
        removeClass(allHiddenLi[i], 'showAnyway');
    }
    document.querySelector('button.showHidden').innerText = 'Visa arkiverade';
    
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
/*
u('form').handle('submit', async e => {
    log('Sending... ');
    const form = u(e.target);
    try {
        await fetch(form.attr('action'), {
            method: form.attr('method'),
            body: form.serialize()
        });
        log("Awesome! (:");
    } catch (error) {
        log("Error: " + error);
    }
});
*/
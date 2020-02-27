window.scrollTo(0, document.body.scrollHeight);

const appUrl = document.location.origin;

function copyToInput(btn, id, update) {
    const txt = document.querySelector('.text-' + id).textContent.trim();
    const date = document.querySelector('.date-' + id).getAttribute('data-date').trim();
    document.querySelector('.dateupdate').setAttribute('value', date);
    document.querySelector('form input').setAttribute('value', txt);
    if (update === true) {
        addClass(document.querySelector('form'), 'update');
        removeClass(document.querySelector('.dateupdate'), 'd-none');
        document.querySelector('form').setAttribute('action', appUrl + '/done/update' + '/' + id);
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

function toggleClass(ele, cls) {
    if (hasClass(ele, cls)) {
        removeClass(ele, cls);
    }
    else {
        addClass(ele, cls);
    }
}

document.querySelectorAll('input[name="archiveOld"]').forEach(item => {
    item.addEventListener('click', event => {
        console.log(item.value);
        let inputParent = document.querySelector('.archiveAfter');
        let input = document.querySelector('.archiveAfter input');

        if (!parseInt(item.value)) {
            addClass(inputParent, 'disabled');
            input.value = input.getAttribute('data-originalvalue');
            input.disabled = true;
        }
        else {
            removeClass(inputParent, 'disabled');
            input.disabled = false;
        }
    })
});


document.querySelectorAll('.card').forEach(item => {
    li = item.lastElementChild.querySelectorAll('li');
    let allLiIsHidden = true;
    li.forEach(eachLi => {
        if(!hasClass(eachLi, 'd-none')){
            allLiIsHidden = false;
        }
    });
    if(allLiIsHidden){
        addClass(item, 'd-none');
        removeClass(document.querySelector('a.toggle-all'), 'd-none');
    }
});

document.querySelectorAll('.card').forEach(item => {
    document.querySelector('a.toggle-all').addEventListener('click', event => {
        
        removeClass(item, 'd-none');
        removeClass(item.querySelector('li'), 'd-none');
    });
});


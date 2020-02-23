const appUrl = document.location.origin;

document.querySelectorAll('input[type="checkbox"]').forEach(item => {
  item.addEventListener('click', event => {
    const newStatus = item.checked ? 1 : 0;
    const id = parseInt(item.getAttribute('data-id'));

    window.location = appUrl + '/togglestatus/' + id + '/' + newStatus;
  })
});

document.querySelectorAll('span.float-right.edit-0').forEach(item => {
  item.addEventListener('click', event => {
    const id = parseInt(item.getAttribute('data-id'));
    const text = item.parentElement.textContent.trim();
    document.querySelector('form input').setAttribute('value', text);
    document.querySelector('form').setAttribute('action', appUrl + '/todo/update/' + id);
    document.querySelector('form input').className += ' warning-border';
    //window.location = appUrl + '/todo/delete/' + id;

  })
});
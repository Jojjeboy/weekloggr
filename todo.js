const appUrl = document.location.origin;

document.querySelectorAll('input[type="checkbox"]').forEach(item => {
  item.addEventListener('click', event => {
    const newStatus = item.checked ? 1 : 0;
    const id = parseInt(item.getAttribute('data-id'));

    window.location = appUrl + '/togglestatus/' + id + '/' + newStatus;
  })
});

document.querySelectorAll('span.float-right.delete').forEach(item => {
  item.addEventListener('click', event => {
    const id = parseInt(item.getAttribute('data-id'));
    window.location = appUrl + '/todo/delete/' + id;

  })
})
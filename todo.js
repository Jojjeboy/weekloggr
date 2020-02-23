const appUrl = document.location.origin;

document.querySelectorAll('input[type="checkbox"]').forEach(item => {
    item.addEventListener('click', event => {
      console.log(item.parentElement.parentElement.nextElementSibling.firstChild);
      console.log('status');
      console.log(item.checked);

      const newStatus = item.checked ? 1 : 0;
      const id = parseInt(item.getAttribute('data-id'));

      window.location = appUrl + '/togglestatus/' + id + '/' + newStatus;

    })
  })
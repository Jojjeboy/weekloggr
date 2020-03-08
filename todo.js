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

$('.input-group.todo span').on('contextmenu', function(e) {
  var top = e.pageY - 50;
  var left = e.pageX - 40;
  $("#context-menu").css({
    display: "block",
    top: top,
    left: left
  }).addClass("show");
  return false; //blocks default Webbrowser right click menu
}).on("click", function() {
  $("#context-menu").removeClass("show").hide();
});

$("#context-menu a").on("click", function() {
  $(this).parent().removeClass("show").hide();
});

function confirmPromp() {
    let modal = document.getElementById("deleteModal");
    let btn = document.getElementById("btnDelete");
    let span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
      modal.style.display = "block";
    }
    span.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
}

function deleteUser() {
    window.location.href = '/logout';
}

function refresh() {
  location.reload();
}

$(document).ready(function () {
  if (!$.browser.webkit) {
      $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
  }
});
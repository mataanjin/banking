window.onload = function () {
  var delBtn = document.getElementsByName('deleteUser');
  for (var x in delBtn) {
    var name = delBtn[x].getAttribute("data-name");
    delBtn[x].onclick = function () {
      return confirm('Are you sure, you to delete user ' + name + '?');
    };
  }
};
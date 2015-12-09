window.onload = function () {
  var num = '';
  var x = 0;
  
  var delBtn = document.getElementsByName('deleteAcc');
  for (x in delBtn) {
    num = delBtn[x].getAttribute("data-acc");
    delBtn[x].onclick = function () {
      return confirm('Are you sure, you want to delete account number ' + num + '?');
    };
  }
  
  var freezeBtn = document.getElementsByName('freezeAcc');
  for (x in freezeBtn) {
    num = freezeBtn[x].getAttribute("data-acc");
    freezeBtn[x].onclick = function () {
      return confirm('Are you sure, you want to freeze account number ' + num + '?');
    };
  }
  
  var activeBtn = document.getElementsByName('activeAcc');
  for (x in activeBtn) {
    num = activeBtn[x].getAttribute("data-acc");
    activeBtn[x].onclick = function () {
      return confirm('Are you sure, you want to activate account number ' + num + '?');
    };
  }
};
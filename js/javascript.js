//delete confirmation
function ok() {
    return confirm('Do you want to delete this?');
}

//comparing passwords
function comparePass() {

    var p1 = document.getElementById('password').value;
    var p2 = document.getElementById('confirm').value;
    var pMsg = document.getElementById('pMsg');

    if (p1 != p2) {
        pMsg.innerText = 'Different password!';
        pMsg.className = 'text-danger';
        return false;
    }
    else {
        pMsg.innerText = '';
        pMsg.className = '';
        return true;
    }
}
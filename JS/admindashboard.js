function addnewItem() {
    window.location.href = "../PHP/addnewitem.php";
}

function viewItems() {
    window.location.href = "../PHP/itemlist.php";
}

function viewContactUs() {
    window.location.href = "../PHP/viewcontactus.php";
}

function viewPreupOrders() {
    window.location.href = "../PHP/viewpreuporders.php";
}

function viewCartOrders() {
    window.location.href = "../PHP/viewcartorders.php";
}

function adminDashBoard() {
    window.location.href = "../PHP/admindashboard.php";
}

function adminDashBoardCancel() {
    confirm("Are you sure you want to cancel?");
    window.location.href = "../PHP/admindashboard.php";
}

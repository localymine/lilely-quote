var ar = new Array(37, 39);
$(document).keydown(function (e) {
    var key = e.which;
    //console.log(key);
    //if(key==35 || key == 36 || key == 37 || key == 39)
    if ($.inArray(key, ar) > -1) {
        e.preventDefault();
        return false;
    }
    return true;
});
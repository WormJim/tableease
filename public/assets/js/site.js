function allergies() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'menu.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMHHttpRequest');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            console.log('Result: ' + result);
        }
    }
}

var checkbox = document.getElementByClassName("allergies-select");
for (i = 0; i < checkbox.length; i++) {
    checkbox.item(i).addEventListener("checked", allergies);
}
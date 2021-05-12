$(document).ready(function(){
    const items = document.querySelectorAll('.current_page_item');
    items.forEach((item) => {
        item.classList.remove("current_page_item");
    });
    document.getElementById("explore").classList.add('current_page_item');
    document.getElementById("questions").classList.add('current_page_item');
});
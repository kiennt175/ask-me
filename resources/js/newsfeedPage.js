$(document).ready(function(){
    const items = document.querySelectorAll('.current_page_item');
    items.forEach((item) => {
        item.classList.remove("current_page_item");
    });
    const items2 = document.querySelectorAll('.newsfeed');
    items2.forEach((item2) => {
        item2.classList.add("current_page_item");
    });
});

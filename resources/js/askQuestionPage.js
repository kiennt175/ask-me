$(document).ready(function(){
    const items = document.querySelectorAll('.current_page_item');
    items.forEach((item) => {
        item.classList.remove("current_page_item");
    });
    document.getElementById("ask_question").classList.add('current_page_item');
});

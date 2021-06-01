$(document).ready(function(){
    // add current page
    const items = document.querySelectorAll('.current_page_item');
    items.forEach((item) => {
        item.classList.remove("current_page_item");
    });
    document.getElementById("explore").classList.add('current_page_item');
    document.getElementById("questions").classList.add('current_page_item');

    // delete question
    const deleteButtons = $('#delete-question');
    deleteButtons.on('click', function (e) {
        cuteAlert({
            type: "question",
            title: "Delete Question",
            message: "Are you sure to delete this question?",
            confirmText: "Yes",
            cancelText: "Cancel"
        }).then((e) => {
            if (e == ("confirm")) {
                $.ajax({
                    type: "GET",
                    url: 'http://localhost:8000/questions/' + questionId + '/delete',
                    success: function (data) {
                        window.location.href = 'http://localhost:8000/user/newsfeed'
                    },
                    error: function (error) {

                    }
                });
            } else {
            }
        })
    });

    // copy question content
    $('.copy-question-content').on('click', function () {
        const editorContainer = document.getElementById('editor').nextSibling.lastChild.lastChild;
        const answerContainer = document.getElementById('answer-editor').nextSibling.lastChild.lastChild;
        const editorData = Array.from(editorContainer.childNodes);
        editorData.forEach(data => {
            const clone = data.cloneNode(true)
            answerContainer.appendChild(clone)
        });

        // document.execCommand('copy');
        
        // answerEditor.model.change( writer => {
        //     const insertPosition = answerEditor.model.document.selection.getFirstPosition();
        //     writer.insertText(content, { bold: true }, insertPosition);
        // } );
    });
});

window.theEditor;
ClassicEditor
    .create(document.querySelector('#editor'), {
        initialData: '',
        licenseKey: 'B5LjLiy+0DKNCFPpGIMCS96MG7XUbzVvzrkMI717WpihLPiGZVTA4Nf3',
        sidebar: {
            container: document.querySelector('#sidebar')
        },
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                '|',
                'undo',
                'redo',
                '|',
                'blockquote',
            ]
        },
        link: {
            defaultProtocol: 'https://'
        }
    })
    .then(editor => {
        editor.plugins.get('AnnotationsUIs').switchTo('narrowSidebar');
        theEditor = editor;
        editor.editing.view.change(writer => {
            writer.setStyle(
                "height",
                "321px",
                editor.editing.view.document.getRoot()
            );
        });
    })
    .catch(error => console.error(error));

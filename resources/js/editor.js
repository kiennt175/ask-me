// Application data will be available under a global variable `appData`.
const appData = {
    // Users data.
    users: [
        {
           id: 'user-1',
           name: 'Joe Doe',
           // Note that the avatar is optional.
           avatar: avatarURL
        },
        {
           id: 'user-2',
           name: 'Ella Harper',
           avatar: 'https://randomuser.me/api/portraits/thumb/women/65.jpg'
        }
    ],

    // The ID of the current user.
    userId: 'user-1',

    // Editor initial data.
    initialData:
        `<h2>
            <comment-start name="thread-1"></comment-start>
            hello
            <comment-end name="thread-1"></comment-end>
        </h2>
        <p>
            This may be the first time you hear about this made-up disorder but it actually isn’t so far from the truth.
            As recent studies show, the language you speak has more effects on you than you realize.
            According to the studies, the language a person speaks affects their cognition,
            behavior, emotions and hence <strong>their personality</strong>.
        </p>
        <p>
            This shouldn’t come as a surprise
            <a href="https://en.wikipedia.org/wiki/Lateralization_of_brain_function">since we already know</a>
            that different regions of the brain become more active depending on the activity.
            The structure, information and especially <strong>the culture</strong> of languages varies substantially
            and the language a person speaks is an essential element of daily life.
        </p>`
};
class CommentsAdapter {
    constructor( editor ) {
        this.editor = editor;
    }

    init() {
        const usersPlugin = this.editor.plugins.get( 'Users' );
        const commentsRepositoryPlugin = this.editor.plugins.get( 'CommentsRepository' );

        // Load the users data.
        for ( const user of appData.users ) {
            usersPlugin.addUser( user );
        }

        // Set the current user.
        usersPlugin.defineMe( appData.userId );

        // Set the adapter on the `CommentsRepository#adapter` property.
        commentsRepositoryPlugin.adapter = {
            addComment( data ) {
                console.log( 'Comment added', data );

                // Write a request to your database here. The returned `Promise`
                // should be resolved when the request has finished.
                // When the promise resolves with the comment data object, it
                // will update the editor comment using the provided data.
                return Promise.resolve( {
                    createdAt: new Date()       // Should be set on the server side.
                } );
            },

            updateComment( data ) {
                console.log( 'Comment updated', data );

                // Write a request to your database here. The returned `Promise`
                // should be resolved when the request has finished.
                return Promise.resolve();
            },

            removeComment( data ) {
                console.log( 'Comment removed', data );

                // Write a request to your database here. The returned `Promise`
                // should be resolved when the request has finished.
                return Promise.resolve();
            },

            getCommentThread( data ) {
                console.log( 'Getting comment thread', data );

                // Write a request to your database here. The returned `Promise`
                // should resolve with the comment thread data.
                return Promise.resolve( {
                    threadId: data.threadId,
                    comments: [
                        {
                            commentId: 'comment-1',
                            authorId: 'user-2',
                            content: '<p>Are we sure we want to use a made-up disorder name?</p>',
                            createdAt: new Date(),
                            attributes: {}
                        }
                    ],
                    isFromAdapter: true
                } );
            }
        };
    }
}
window.theEditor;
ClassicEditor
    .create( document.querySelector( '#editor' ), {
        initialData: appData.initialData,
        extraPlugins: [ CommentsAdapter ],
        licenseKey: 'B5LjLiy+0DKNCFPpGIMCS96MG7XUbzVvzrkMI717WpihLPiGZVTA4Nf3',
        sidebar: {
            container: document.querySelector( '#sidebar' )
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
                // 'comment'
            ]
        },
    } )
    .then( editor => {
        editor.plugins.get( 'AnnotationsUIs' ).switchTo( 'narrowSidebar' );
        theEditor = editor;
    } )
    .catch( error => console.error( error ) );

if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.elfinder = {
    init : function() {
        var callback = function()
        {
        //this.execCommand('underline');
        }
        // add after
        this.addBtnAfter('italic', 'underline', 'Underline', callback);
			
        // add before
        this.addBtnBefore('image', 'button1', 'Button Before', function(obj) {
           obj.modal();
        });
			
        // add separator after or before
        this.addBtnSeparatorAfter('button1');
    },
    modal : function() {
        var dialog;
        var image;
        var el = this;
        if (!dialog) {
            // create new elFinder
            dialog = $('<div />').dialogelfinder({
                url: 'php/connector.php',
                commandsOptions: {
                    getfile: {
                        oncomplete : 'close' // close/hide elFinder
                    }
                },
                getFileCallback: function(file) {
                    //console.log(file);
                    image = '<img src="'+file+'">';
                   // RedactorPlugins.insertHtml(image);
                  el.insertHtml('<img src="'+file+'">');
                  // console.log(dialog.url);
                } // pass callback to file manager
            });
//             console.log(RedactorPlugins.elfinder);
            //this.insertHtml(RedactorPlugins.elfinder);
        } else {
            // reopen elFinder
            dialog.dialogelfinder('open')
        }
    }
}
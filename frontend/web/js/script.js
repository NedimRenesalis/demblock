$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({
        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),
        limitConcurrentUploads: 1,
        maxNumberOfFiles: 1,
        sequentialUploads: true,
        progressInterval: 100,


        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            if(e) { console.error(e); }
            
            console.log(data);

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){
                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }
                tpl.fadeOut(function(){
                    tpl.remove();
                });
            });

            var jqXHR = data.submit()
                .success(function (result, textStatus, jqXHR) { 
                    if(result.success == false) {
                        $("#msg-upload-status").text(result.reason);
                        $("#msg-upload-status").attr("class", "alert-danger alert");
                        $("#msg-upload-status").css("display", "block");
                    } else {
                        $("#msg-upload-status").css("display", "none");
                    }
                })
                .error(function (jqXHR, textStatus, errorThrown) {console.error(jqXHR, textStatus, "error"); })
                .complete(function (result, textStatus, jqXHR) {console.error(result, textStatus, "complete"); });

            // Automatically upload the file once it is added to the queue
            if($('#uploadImageMainDetails').length){
                $('#uploadImageMainDetails').on('click', function(){
                    console.log(data);
                    data.submit();
                });
            }
        },

        progress: function(e, data){
            if(e) { console.error(e); }

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();
            console.log(progress);

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail: function(e, data){
            // Something has gone wrong!
            if(e) { console.error(e); }
            data.context.addClass('error');
        }
    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});
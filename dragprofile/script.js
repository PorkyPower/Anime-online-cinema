$(document).ready(function() {
    var dropZone = $('#addimgprof'),
        maxFileSize = 2000000;
    

    if (typeof(window.FileReader) == 'undefined') {
        dropZone.text('Не поддерживается браузером!');
        dropZone.addClass('error');
    }
    

    dropZone[0].ondragover = function() {
        dropZone.addClass('hover');
        return false;
    };
    

    dropZone[0].ondragleave = function() {
        dropZone.removeClass('hover');
        return false;
    };
    

    dropZone[0].ondrop = function(event) {
        event.preventDefault();
        dropZone.removeClass('hover');
        
        var file = event.dataTransfer.files[0];
        

        if (file.size > maxFileSize) {
            dropZone.text('Файл слишком большой!');
            dropZone.addClass('error');
            return false;
        }
              
		sendFiles(file);
    };  
    
	$('#js-file').change(function() {
		let files = this.files;
		sendFiles(files);
	});
    
	function sendFiles(files) {
		let maxFileSize = 2000000;
		let Data = new FormData();
		$(files).each(function(index, file) {
			if ((file.size <= maxFileSize) && ((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
				Data.append('file', file);
				Data.append('type', $('input[id=js-type]').attr('value'));
			};
		});
		$.ajax({  
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $("#textupload").text('Загрузка: ' + percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: 'http://SITE/dragprofile/upload.php',
			type: 'POST',
			data: Data,
			contentType: false,
			processData: false,
			success: function(data) { 
                if ($('input[id=js-type]').attr('value') == 'avatar'){
                    $('input[name=avatar]').attr('value',data);
                    $('#avatar').children().children('#ava-prof').css({'background':'url(http://SITE/imgs/users/temp/'+data+'?'+new Date().getTime()+')','background-size':'cover'});
                }
                if ($('input[id=js-type]').attr('value') == 'banner'){
                    $('input[name=banner]').attr('value',data);
                    $('#imgback').css({'background':'url(http://SITE/imgs/users/temp/'+data+'?'+new Date().getTime()+')', 'background-size':'cover', 'background-position':'center'});
                }
                if ($('#pop').attr('status')=='open'){
                    $('#pop').attr('status','');
                    $("#pop").fadeOut();
                }
            }
		});
	}

      
    
});    

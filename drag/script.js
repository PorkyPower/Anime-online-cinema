$(document).ready(function() {
    var dropZone = $('#addimgbanner'),
        maxFileSize = 4000000;
    

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
              
		sendFiles(file, $('#pop').attr("type"));
    };  
    
	$('#js-file').change(function() {
		let files = this.files;
		sendFiles(files, $('#pop').attr("type"));
	});
    
	function sendFiles(files, typesend) {
		let maxFileSize = 4000000;
		let Data = new FormData();
		$(files).each(function(index, file) {
			if ((file.size <= maxFileSize) && ((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
				Data.append('file', file);
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
            url: 'http://SITE/drag/upload.php',
			type: 'POST',
			data: Data,
			contentType: false,
			processData: false,
			success: function(data) {
                if (typesend == "banner"){
				    $('#addbanner').html('<div style="width: 100%;background: url(http://SITE/imgs/temp/'+data+');height: inherit;background-size: cover;background-position-y: center;"></div>');
				    $('#addbanner').append("<div type=banner id=iconsbanner><div class=addbtnupload>Удалить</div></div>");
				    $('#addbanner').append('<input hidden="" value='+data+' id="addbannerimg">');
				    $('#js-file').val("");
                } else {
				    $('#addprev').html('<div style="width: 100%;background: url(http://SITE/imgs/temp/'+data+');height: inherit;background-size: cover;background-position-y: center;"></div>');
				    $('#addprev').append("<div type=prev id=iconsbanner><div class=addbtnupload>Удалить</div></div>");
				    $('#addprev').append('<input hidden="" value='+data+' id="addprevimg">');
				    $('#js-file').val("");
                }
                $("#pop").fadeOut("slow");
            }
		});
	}

    $(document).on('click', '#iconsbanner', function  () {
        if ($(this).attr('type') == "banner"){
            $('#addbanner').html('<div type="banner" id="addbtnupload" class=styleuploadbtn>Загрузить</div><input hidden class="addbannerimg">');
        } else {
            $('#addprev').html('<div type="prev" id="addprevimg" class=styleuploadbtn>Загрузить</div><input hidden class="addprevimg">');
        }
    }); 
    
    $(document).on('click', '#addbtnupload', function  () {
        $("#pop").attr("type", "banner");
        $("#textupload").text("Загрузить баннер");
        $("#pop").fadeIn("slow");
    });          
    $(document).on('click', '#addprevimg', function  () {
        $("#pop").attr("type", "prev");
        $("#textupload").text("Загрузить превью");
        $("#pop").fadeIn("slow");
    });        
    $(document).on('click', '#btnuploadclose', function  () {
        $("#pop").fadeOut("slow");
    });
    
   
    $(document).on('click', '#checkswitch', function  () {
        //console.log(file);
    });
    
});    

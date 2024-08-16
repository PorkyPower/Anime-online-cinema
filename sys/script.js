$(document).ready(function() {
    var dropZone = $('#addvideo'),
        maxFileSize = 4000000000;
    

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
    
	$('#js-video').change(function() {
		let files = this.files;
		sendFiles(files);
	});
    let IntId = null;
	function sendFiles(files) {
        $("#formuploading").fadeIn("fast");
        $("#jsuploadform").fadeOut("fast");
        getcontentupload();
        
		let maxFileSize = 4000000000;
		let Data = new FormData();
		$(files).each(function(index, file) {
				Data.append('file', file);
		});
		$.ajax({  
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $("#lineprocess").css("width",percentComplete+"%");
                        $("#textuploadvideo").text('Загрузка: ' + percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: 'http://SITE/sys/upload.php',
			method: 'post',
            dataType: 'json',
			data: Data,
			contentType: false,
			processData: false,
			success: function(data) {
                    $.get('http://SITE/adminpanel/makevideo/swrgf3/'+data.genname+'/'+data.filename);
                    IntId = setInterval(getinfocoder, 1000, data.genname);
                }
		});
	}
    function getinfocoder(dataget){
        $("input[name=link]").attr('value', 'http://SITE/sys/upload/files/'+dataget+'/master.m3u8');
        $("input[name=poster]").attr('value', 'http://SITE/sys/upload/files/'+dataget+'/poster.jpg');
        $.ajax({  
            url: 'http://SITE/sys/getprogress.php',
			method: 'POST',
			data: {namefile: dataget},
            dataType: 'html',
			success: function(data) {
                    if (data == 'done'){
                        clearInterval(IntId);
                        $('.upg').html('Обработка - готово');
                        $("#lineprogress").css("width","100%");
                    } else {
                        $('.upg').html('Обработка - '+data+'%');
                        $("#lineprogress").css("width",data+"%");
                    }
                }
		});
    }
    
    function getcontentupload(){
    $.ajax({
        url: 'http://SITE/api/getfullcontent', 
        method: 'GET',
        dataType: 'json',
        success: function(data){ 
            var conts = "";
            for (let i = 0; i < data.length; i++) {
                conts = conts + "<option value="+data[i].id+">"+data[i].name+"</option>";
            }
            $("#selectfield").html(conts);
        }
    });
}
    
});    

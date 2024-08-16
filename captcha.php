<title>Captcha</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
#capt{    
    display: grid;
    justify-content: center;
    justify-items: start;
}
button{
    display: flex;
    color: white;
    background: #F84134; 
    padding: 10px;
    border-radius: 10px;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    border: 0;
}
input{
    width: 200px;
    margin: 2% 0;
    padding: 10px;
    border: 1px solid lightgray;
    font-size:18pt;
}
label{
    font-size: 14pt;
}
.captcha_group{
    width: 210px;
}
.captcha_image_group{
    display: flex;
    align-items: center;
}
</style>
<div id=capt>
    <div class="captcha">
    <div class="captcha_image_group">
      <img class="captcha_image" src="/gencaptcha.php" width="200" alt="captcha">
      <button id=updatecode><svg width="14" height="14" viewBox="0 0 124 124" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M118.418 70.3479C114.29 97.7923 90.6088 118.833 62.0138 118.833C30.5106 118.833 4.97217 93.2946 4.97217 61.7916C4.97217 30.2883 30.5106 4.74994 62.0138 4.74994C85.4043 4.74994 105.507 18.8289 114.309 38.9749" stroke="white" stroke-width="8.55625" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M90.5347 38.9749H115.633C117.523 38.9749 119.056 37.4426 119.056 35.5524V10.4541" stroke="white" stroke-width="8.55625" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </button>
    </div>
    <div class="captcha_group">
      <label for="captcha">Введите код с картинки</label>
      <input type="text" name="captcha" id="captcha">
      <div class="invalid-feedback"></div>
    </div>
    </div>
    <button id=sendcaptcha type="submit">Отправить</button>
    <div id=errmsg></div>
</div>
<script>

$(document).on("click", "#updatecode", function  () {
    $(".captcha_image").attr("src","/gencaptcha.php");
});
$(document).on("click", "#sendcaptcha", function  () {
    $.ajax({
        url: "http://"+window.location.host+"/checkcaptcha.php",
        method: "post",
        dataType: "json",
        data: {captcha: $("input[name=captcha]").val()},
        success: function(data){
            console.log(data);
            $(".captcha_image").attr("src","/gencaptcha.php");
            $("input[name=captcha]").val("")
            if (data.success == false){
                $("#errmsg").html(data.errors[0][1]);
            } else {
                window.location.pathname = "/";
                $("#errmsg").html("");
            }
        }
    });
});
</script>
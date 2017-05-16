$('#loginForm').submit(function (e) {
    e.preventDefault();
    var login = document.getElementById("login").value;
    var psw = document.getElementById("psw").value;
    $.ajax({
        url: '/core/participant/login.php',
        type: 'POST',
        data: 'login=' + login + "&password=" + psw,
        success: function (res) {
            console.log(res);
            if (res === "ok") {
                location.href = "index.php";
            }
            else {
                alert("wrong login or password");
            }
        }
    });
});
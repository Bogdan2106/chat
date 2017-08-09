<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron" id="status">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        <form action="" name="messages">
            <div class="row">User Id: <input type="text" name="userId"></div>
            <div class="row">Message: <input type="text" name="msg"></div>
            <div class="row"><input type="submit" value="Send"></div>
        </form>
    </div>

        <script>
            window.onload = function(){
                //var socket = new WebSocket("ws://echo.websocket.org");
                var socket = new WebSocket("ws://localhost:8080");
                var status = document.querySelector("#status");
                console.log(socket);

                socket.onopen = function() {
                    status.innerHTML = "Connection established<br>";
                };

                socket.onclose = function(event) {
                    if (event.wasClean) {
                        status.innerHTML = 'connection closed';
                    } else {
                        status.innerHTML = 'connections somehow closed';
                    }
                    status.innerHTML += '<br>code: ' + event.code + ' reason: ' + event.reason;
                };

                socket.onmessage = function(event) {
                    let message = JSON.parse(event.data);
                    console.log(message);

                    if (message.errors) {
                        return alert(JSON.stringify(message.errors));
                    }

                    status.innerHTML += `<b>${message.userId}</b>: ${message.msg}<br>`;
                };

                socket.onerror = function(event) {
                    status.innerHTML = "ошибка " + event.message;
                };
                document.forms["messages"].onsubmit = function(){
                    let message = {
                        userId:this.userId.value,
                        msg: this.msg.value
                    };
                    socket.send(JSON.stringify(message));
                    return false;
                }

//                function getRandomArbitrary(min, max) {
//                    return Math.round(Math.random() * (max - min) + min);
//                }
//               let form =  document.forms["messages"];
//
//                form.userId.value = getRandomArbitrary(1, 1024);
//                form.msg.value = `test #${getRandomArbitrary(1, 99999)} bleat`;

            }
        </script>
    </div>
</div>

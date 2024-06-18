<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
        form {
            width: 320px;
        }

        p {
            overflow: hidden;
        }

        label {
            float: left;
            width: 60px;
            height: 40px;
            line-height: 40px;
            text-align: right;
            margin-right: 10px;
        }

        input {
            float: left;
            height: 16px;
            padding: 10px;
            border: 1px solid silver;
            width: 228px;
        }

        .container {
            height: 750px;
            display: grid;
            align-items: center;
            justify-items: center;
        }

        .table {
            border-style: solid;
            padding: 30px;
            border-color: skyblue;
        }

        #submit {
            width: 100px;
            height: 40px;
            border: 1px solid gray;
            padding: 0px;
            background-color: silver;
        }
    </style>
</head>
<script>
    function redirect() {
        window.location.href = "https://www.baidu.com";
    }
</script>
<body>
    @if($_SERVER['REQUEST_METHOD'] != 'POST')
        <div class="container">
            <div class="table">
                <form id="form" method="post" action="/getform">
                <!-- <form id="form"> -->
                    <p>
                        <label for="username">用户名</label>
                        <input id="username" type="text" name="username" class=".input" value="" />
                    </p>
                    <p>
                        <label for="password">密码</label>
                        <input id="password" type="password" name="password" class=".input" value="" />
                    </p>
                    <p>
                        <label></label>
                        <input id="submit" type="submit" name="" value="提交" />
                    </p>
                </form>
            </div>
        </div>
    @endif
</body>
</html>
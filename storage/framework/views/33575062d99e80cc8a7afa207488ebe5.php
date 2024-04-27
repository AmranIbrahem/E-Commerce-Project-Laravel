<!DOCTYPE html>
<html>
<head>
    <title>إنشاء حساب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>إنشاء حساب</h2>
    <form id="registerForm">
        <label for="full_name">الاسم الكامل:</label>
        <input type="text" id="full_name" name="full_name">

        <label for="email">البريد الإلكتروني:</label>
        <input type="text" id="email" name="email">

        <label for="password">كلمة المرور:</label>
        <input type="password" id="password" name="password">

        <label for="confirm_password">تأكيد كلمة المرور:</label>
        <input type="password" id="confirm_password" name="confirm_password">

        <input type="submit" value="إنشاء حساب">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registerForm').submit(function(event) {
            event.preventDefault();

            var formData = {
                full_name: $('#full_name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                confirm_password: $('#confirm_password').val()
            };

            $.ajax({
                url: 'register.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
</body>
</html>
<?php /**PATH D:\Back\Store\resources\views/welcome.blade.php ENDPATH**/ ?>
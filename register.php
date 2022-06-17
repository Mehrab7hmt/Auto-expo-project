<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ثبت نام </title>
    <link rel="stylesheet" href="style-register.css">

    <style>
        @font-face {
    font-family: vazir;
    src: url(font/Vazir.woff);
  }

    </style>

</head>
<body>

<?php
    $error = array();
    if(sizeof($_POST)>0)
        if(isset($_POST['agree'])){
            $name = $_POST['fname'];
            $pass = hash('sha256',$_POST['pass']);
            $mail = $_POST['email'];
            $gender = $_POST['gender'];
            $db = @mysqli_connect('localhost','root','','mehrdad');
            $er = true;
            if(!$db)   
                $error[] =  'خطا در اتصال به دیتابیس';
            else{
                $sql = "insert into users values('$name','$pass','$mail','$gender')";
                $db->query($sql);
                if($db->affected_rows>0){
                    $error[] = 'اطلاعات با موفقیت وارد شد';
                    $er = false;
                }
                else  
                    echo $db->errno . $db->error;  
                    $error[] = 'مشکل در ذخیره اطلاعات';
            }
        }
        else
            $error[] = 'گزینه مربوط به قبول قوانین انتخاب نشده است';
?>
<?php if(sizeof($error)>0): ?>
    <?php if($er == true): ?>
        <div class="register-form error">
    <?php else: ?>
        <div class="register-form success">
        <?php endif; ?>
       <ul>
       <?php
            foreach($error as $e)
                echo  '<li>'.$e.'</li>';
       ?>
       </ul>
       
</div>
<?php  endif ?>


























    
<div class="plac-form">
<div class="form">
<form action="" method="post" class="register-form">
        <div class="mm">
            <label for="">نام کاربری :</label>
            <input type="text" name="fname" required class="inp">
        </div>
        <div class="mm">
            <label for="">کلمه عبور :</label>
            <input type="password" name="pass" required class="inp">
        </div>
        <div class="mm">
            <label for="">ایمیل :</label>
            <input type="email" name="email" required class="inp">
        </div>

        <div class="mm">
            <label for="">جنسیت :</label>
            <input type="radio" name="gender" value="1">مرد
            <input type="radio" name="gender" value="2">زن
        </div>
        <div class="mm">
            <input type="checkbox" name="agree" value="1">من با قوانین این وب سایت موافق هستم
        </div>
        <div class="mm">
            <input type="submit" value="ذخیره اطلاعات">
        </div>
    </form>

</div>
</div>





</body>
</html>
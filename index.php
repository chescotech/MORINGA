<!DOCTYPE html>
<html>
    <head>
        <title>CHESCO POS</title>
    </head>
    <body style="background-color: #3386FF">
    <center><img src="pos_logo.png" width="200px" height="200px"></center>
     <center><p class="login-box-msg" style="color: white;margin-top: -30px"><b>Please Enter Password to Login !!!</b></p> </center>
    <style>
        .block {
           
            width: 150px;
            border: 2px;
            background-color: #4CAF50;
            color: white;
            padding: 14px 28px;
            margin-bottom:8px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
        }

        .block:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
    <center>
        <div id='calc-contain'>

            <form name="calculator" action="login.php" method="post">

                <input type="password"  name="password"  style="font-size:27.5pt; border:2px; " required="" />
                <br><br><br>
                <input class="block" type="button" value=" 1 " onclick="calculator.password.value += '1'" />
                <input class="block" type="button" value=" 2 " onclick="calculator.password.value += '2'" />
                <input class="block" type="button" value=" 3 " onclick="calculator.password.value += '3'" />

                <br/>

                <input class="block" type="button" value=" 4 " onclick="calculator.password.value += '4'" />
                <input class="block" type="button" value=" 5 " onclick="calculator.password.value += '5'" />
                <input class="block" type="button" value=" 6 " onclick="calculator.password.value += '6'" />

                </br>

                <input class="block" type="button" value=" 7 " onclick="calculator.password.value += '7'" />
                <input class="block" type="button" value=" 8 " onclick="calculator.password.value += '8'" />
                <input  class="block" type="button" value=" 9 " onclick="calculator.password.value += '9'" />

                </br>

                <input class="block" type="button" value=" c " onclick="calculator.password.value = ''" />
                <input  class="block" type="button" value=" 0 " onclick="calculator.password.value += '0'" />
                <input name="login"  class="block" type="submit" value=" Login" />

                </br>


            </form>
            <div id="agh">
               <p  style="color: white"><b>Website : www.chescopos.com</b></p>                        
                         <p style="color: white"><b>Support : support@chesco-tech.com</b></p>
                         <p style="color: white"><b>Support Calls : 260963325972</b></p>
            </div>
        </div>
    </center>
</body>
</html>
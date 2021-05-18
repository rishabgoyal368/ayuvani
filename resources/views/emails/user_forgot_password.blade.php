<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <title>TimePass</title>
        <style type="text/css">
            body{font-family: Helvetica,sans-Serif;color: #77798c;font-size: 14px;}
        </style>
    </head>
    <body>        
        <table style="padding: 0;" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td>
                        <table style="margin: 0px auto 0px; text-align: center; box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1); border-radius: 4px;background-color:#fff9ed; padding: 20px;" width="500px" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="margin: 10px auto; text-align: center; box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.1); background-color: #fff; border-radius: 4px;" width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h1 style="font-weight:normal;margin:20px 0 0;color:#664b13;">Forgot Password</h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4 style="text-align:center; margin-bottom:0;color: #525252;"> Hello, {{ ucfirst($name)}} </h4>
                                                        <p style="letter-spacing:1px;line-height:30px;text-align:center; margin-bottom:30px; padding:10px; padding-left:20px;">
                                                          You're receiving this e-mail because you requested a password reset for your Postmates account.
                                                          <br>Please tap the button below to choose a new password.
                                                        </p>          
                                                        <a href="{{$set_password_url}}" style="padding:12px 25px;background-color:#ff8500;border:none;border-radius:2px;cursor:pointer; text-decoration: none;box-shadow: 0 3px 6px -1px rgba(0,0,0,.25);color: #fff;font-weight: bold; border-radius: 20px"> Reset Password</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:60px">
                                                    </td>
                                                </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
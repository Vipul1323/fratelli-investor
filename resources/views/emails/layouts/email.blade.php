<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>
        <meta name="color-scheme" content="light dark">
        <meta name="supported-color-schemes" content="light dark">
    </head>
    <body style="padding:0; margin:0; color:#60657b; font-family:Helvetica,Helvetica neue,Roboto,Verdana,Arial,Verdana,sans-serif!important; -webkit-text-size-adjust: none; font-size:'14px';">
        <table  style="-webkit-text-size-adjust: none; background-color:#F5F8FA;" width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td align="center">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width:200px; border: none; max-width:600px; border-collapse: collapse;">
                        <tr style="background:#ffffff;">
                            <td>
                                <a  style="color:white; text-decoration:none;" href="javascript:void(0);">
                                    <h1 style="text-align:center;margin:0px;background-color: #ffffff;margin: 0 0 0px;padding: 10px;">

                                        <img src="{{ asset('img/logo.png') }}" width="150" class="darkLogo" />

                                    </h1>
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width:200px; max-width:600px; border-collapse: collapse; background-color:#FFFFFF;" dir={{ isset($dir)?$dir:'ltr' }}>
                        <tr>
                            <td style="padding: 15px 20px 15px 20px;">@yield('content')</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width:200px; border: none; max-width:600px; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: center; background-color: #EAEAEA; color: #9d9d9d; padding: 15px;" colspan="2">
                                Copyright © <?php echo date('Y'); ?> by {{env('APP_NAME')}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
<!DOCTYPE html>
<html lang="en" xmlns="https://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>Registration Mail</title>
    <!--[if mso]> 
    <style> 
    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;} 
    div, td {padding:0;} 
    div {margin:0 !important;} 
    </style> 
    <noscript> 
    <xml> 
    <o:OfficeDocumentSettings> 
    <o:PixelsPerInch>96</o:PixelsPerInch> 
    </o:OfficeDocumentSettings> 
    </xml> 
    </noscript> 
    <![endif]-->
    <style>
        table,
        td,
        div,
        h1,
        a,
        p {
            font-family: Arial, sans-serif;
        }
        @media screen and (max-width: 530px) {
            .unsub {
                display: block;
                padding: 8px;
                margin-top: 14px;
                border-radius: 6px;
                background-color: #555555;
                text-decoration: none !important;
                font-weight: bold;
            }
            .col-lge {
                max-width: 100% !important;
            }
        }
        @media screen and (min-width: 531px) {
            .col-sml {
                max-width: 27% !important;
            }
            .col-lge {
                max-width: 73% !important;
            }
        }
    </style>
</head>
<body style="margin:0;padding:0;word-spacing:normal;background-color:#e7e7e7;">
    <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">
        <table role="presentation" style="width:100%;border:none;border-spacing:0;background-color: #eee;">
            <tr>
                <td align="center" style="padding:0;">
                    <!--[if mso]> 
                    <table role="presentation" align="center" style="width:600px;"> 
                    <tr> 
                    <td> 
                    <![endif]-->
                        <table role="presentation"
                            style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;
                                background-color: #fff;">
                            @include('emails.includes.mail_header')
                                <tr>
                                    <td style="padding:10px 30px 30px 30px;background-color:#ffffff;">
                                        <h1 style="margin-top:0;margin-bottom:4px;font-size:20px;line-height:32px;font-weight:normal;letter-spacing:-0.02em;">
                                            Dear {{ $user->name }}, Welcome to {{ env('APP_NAME') }}!</h1>
                                        <p style="margin:0;font-weight: normal;">
                                            Our mission is to deliver fresh and cheap market groceries to your doorstep and to reward you with promotions and
                                            discounts for using our app.
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px 30px 30px 30px;background-color:#ffffff;">
                                        <p style="margin:0;font-weight: normal; padding-bottom: 20px;">
                                            Enjoy 10% off your first order.
                                        </p>
                                        <a href="{{$androidStore}}" style="color: #363636; background-color: #BFBFBF; padding: 10px 25px 10px 25px; 
                                            border-radius: 5px; text-decoration: none; font-weight: normal; font-size: 16px;">
                                            ORDER NOW
                                        </a>
                                    </td>
                                </tr>
                            @include('emails.includes.mail_footer')
                        </table>
                    <!--[if mso]> 
                    </td> 
                    </tr> 
                    </table> 
                    <![endif]-->
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
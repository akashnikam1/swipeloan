<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SwipeLoan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <style type="text/css">
        @media  screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        @media  screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 20px 0 !important;">
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> 
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 30px 20px 30px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <img src="<?php echo e(asset('assets/images/app_logo.png')); ?>" width="125" height="130" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 10px;">
                <div style="background:#1AA0A0;background-color:#1AA0A0;margin:0 auto; max-width: 600px; padding: 10px 0">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                            style="background:#1AA0A0;background-color:#1AA0A0;width:100%">
                        <tbody>
                            <tr>
                                <td style="border:0 solid transparent;direction:ltr;font-size:0;padding:20px 0;
                                    padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;text-align:center">
                                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0;text-align:left;direction:ltr;
                                        display:inline-block;vertical-align:top;width:100%">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color:transparent;border:0 solid transparent;
                                                            vertical-align:top;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" style="font-size:0;padding:10px 25px;padding-top:0;padding-right:0;
                                                                        padding-bottom:0;padding-left:0;word-break:break-word">
                                                                        <table border="0" cellpadding="0" 
                                                                            cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="width:87px">
                                                                                        <img alt="Image" src="<?php echo e(asset('assets/images/email_icon.png')); ?>" 
                                                                                            style="border:0 solid transparent;border-radius:0;display:block;outline:0;text-decoration:none;height:auto;
                                                                                            width:100%;font-size:13px" width="87" height="auto">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>

        <?php echo $__env->yieldContent('content'); ?>

        <?php if(!empty($data['first_name']) && $data['first_name'] !== 'Admin'): ?>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
                                <p style="margin: 0;"><a href="https://swipeloan.in/" target="_blank" style="color: #FFA73B;">Visit Our Website</a></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php endif; ?>
    </table>
    <?php echo $__env->yieldContent('scriptJs'); ?>
</body>
</html><?php /**PATH /opt/lampp/htdocs/swipeloan/resources/views/layouts/emailApp.blade.php ENDPATH**/ ?>
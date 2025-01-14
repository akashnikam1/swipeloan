@extends('layouts.emailApp')
@section('content')
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p>
                            <span style="font-size:28px">Email Verification</span>
                        </p>
                        <p>
                            Dear {{ $data['first_name'] ?? '' }}{{ isset($data['last_name']) ? ' ' . $data['last_name'] : '' }},
                        </p>                        
                        <p style="margin: 0;">Your One Time Password (OTP) for Email Verification is below.</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 40px 30px;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <span id="otp" style="display: none">{{ $data['otp'] }}</span>
                                            <td align="center" style="border-radius: 3px;" bgcolor="#1AA0A0">
                                                <a href="javascript:void(0);" id="otpLink" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; 
                                                    color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; 
                                                        padding: 15px 25px; border-radius: 2px; border: 1px solid #1AA0A0; display: inline-block;" onclick="copyOTP()">{{ $data['otp'] }}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;">Enter this OTP in the Email Verification page and you will be verified instantly.</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                    <br/>  <p style="margin: 0;">Regards,<br>Team SwipeLoan</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection

@section('scriptJs')
    <script>
        function copyOTP() {
            var otp = document.getElementById('otp').textContent;
            navigator.clipboard.writeText(otp).then(function() {
                alert('OTP copied to clipboard!');
            }, function(err) {
                alert('Failed to copy OTP: ', err);
            });
        }
    </script>
@endsection
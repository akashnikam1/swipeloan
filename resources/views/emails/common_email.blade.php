@extends('layouts.emailApp')
@section('content')
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 10px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p>
                            Dear {{ $data['first_name'] ?? '' }}{{ isset($data['last_name']) ? ' ' . $data['last_name'] : '' }},
                        </p>
                    </td>
                </tr>
                @for ($i = 1; $i <= $data['lines_count']; $i++)
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">{{ $data['content_line' . $i] }}</p><br>
                        </td>
                    </tr>
                @endfor
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <br><p style="margin: 0;">Regards,<br>Team SwipeLoan</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
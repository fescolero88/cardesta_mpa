@extends('email.layout.index')
@section('content')
<tr>
    <td bgcolor="#ffffff" style="background-color:#ffffff;border-left-color:#e0e0e0;border-left-style:solid;border-left-width:1px;padding-left:30px;padding-right:30px">
        <br>

        <p>Dear {!! isset($mailInfo['to_name'])? ucwords($mailInfo['to_name']) : 'Dealer' !!},</p>

        <p>
            You have received a new request from Cardesta to check vehicle availability. <br />
            Here are the details:<br />
        </p>
        <table border="0" width="100%" height="100%" cellpadding="5" cellspacing="0" bgcolor="#f0f0f0">
            <thead>
                <tr>
                    <th colspan="2">  
                        User Details:
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{!! $mailInfo['user-name']?? '' !!}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{!! $mailInfo['user-email']?? '' !!}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{!! $mailInfo['user-phone']?? '' !!}</td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td>{!! $mailInfo['user-comment']?? '' !!}</td>
                </tr>
            </tbody>
        </table>
        <table border="0" width="100%" height="100%" cellpadding="5" cellspacing="0" bgcolor="#f0f0f0">
            <thead>
                <tr>
                    <th colspan="2">  
                        Car Details:
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Year</td>
                    <td>{!! $mailInfo['vehicle-year']?? '' !!}</td>
                </tr>
                <tr>
                    <td>Make</td>
                    <td>{!! $mailInfo['vehicle-make']?? '' !!}</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td>{!! $mailInfo['vehicle-model']?? '' !!}</td>
                </tr>
                <tr>
                    <td>Trim</td>
                    <td>{!! $mailInfo['vehicle-trim']?? '' !!}</td>
                </tr>
                <tr>
                    <td>Mileage</td>
                    <td>{!! $mailInfo['vehicle-mileage']?? '' !!}</td>
                </tr>
                <tr>
                    <td>VIN</td>
                    <td>{!! $mailInfo['vehicle-vin']?? '' !!}</td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endsection
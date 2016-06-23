<div style="width: 500px; height: auto; margin: 0 auto; position:relative; background: #F6F6F6; padding: 30px; border: 1px solid #d3d3d3;">
    <h3>Biorower - Password Reset Request</h3>
    <p style="font-size: 18px; ">
        Hello, {{ $user->first_name }}! <br><br>
        You've recently requested to reset password for email: {{ $user->email }}. <br><br>
        Please follow the link below to complete your request. <br>
    </p>
    <a href="{{ URL::to('/password/reset/') . '/' . $user->reset_password_code }}" style="margin: 0 auto;"><button style="background: #348EDA; color: #fff; border: none; border-radius: 5px; min-width: 100px; min-height: 50px; font-size: 13px; cursor: pointer;">Reset</button></a>

</div>

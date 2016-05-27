<div style="width: 500px; height: auto; margin: 0 auto; position:relative; background: #F6F6F6; padding: 30px; border: 1px solid #d3d3d3;">
    <h3>Biorower - Account info</h3>
    <p style="font-size: 18px; ">
        Hello, {{ $user->first_name }} ! <br><br>
        Your account has just been activated! <br>
        Click on the button below to login. <br>
        <a href="{{ URL::to('/login') }}" style="margin: 0 auto;"><button style="background: #348EDA; color: #fff; border: none; border-radius: 5px; min-width: 100px; min-height: 50px; font-size: 13px; cursor: pointer;">Login</button></a>

    </p>
</div>
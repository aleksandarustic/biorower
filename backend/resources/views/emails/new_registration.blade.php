<div style="width: 500px; height: auto; margin: 0 auto; position:relative; background: #F6F6F6; padding: 30px; border: 1px solid #d3d3d3;">
    <h3>Biorower - New Registration Request</h3>
    <p style="font-size: 18px; ">
        Hello, Admin ! <br><br>
        New registration request by {{ $user->first_name.' '.$user->last_name }}. <br>
        User email: {{ $user->email }} <br>
    </p>
    <a href="{{ URL::to('/approve/user/') . '/' . $user->id }}" style="margin: 0 auto;"><button style="background: #348EDA; color: #fff; border: none; border-radius: 5px; min-width: 100px; min-height: 50px; font-size: 13px; cursor: pointer;">Activate</button></a>
</div>
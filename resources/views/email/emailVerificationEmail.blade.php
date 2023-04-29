<h1>Verify Your OTP</h1>
@php($appname= \App\Models\BusinessSetting::where("key","business_name")->first()->value)
Please Find Your OTP Below:<br>
<h4>OTP :  {{ $data['otp'] }} </h4><br><hr>
Thanks<br>
Team {{$appname}}
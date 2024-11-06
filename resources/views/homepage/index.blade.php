@include('common.header')
<div>
    <a href="{{ route('user.login') }}" class="p-1"><div class="btn btn-success">Login</div></a>
    <a href="{{ route('user.register') }}" class="p-1"><div class="btn btn-primary">Register</div></a>
</div>
@include('common.footer')
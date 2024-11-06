@include('common.header')
<div class="card mx-auto col-md-4">
    <div class="card-body">
        <h5 class="card-title text-center">Hello, welcome!</h5>
        <p class="card-text text-center">Good to see you! <br />Fill up the following details to register.</p>
        <form method="POST" class="mt-4" action="{{ route('user.register') }}" role="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" value="{{ old('fullname') }}"
                    class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" placeholder="Bill..."
                    aria-label="Name" aria-describedby="invalidCheckFullName">
                @if($errors->has('fullname'))
                <div id="invalidCheckFullName" class="invalid-feedback">
                    {{ $errors->first('fullname') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"
                    placeholder="bill@gmail..." aria-label="Name" aria-describedby="invalidCheckEmail">
                @if($errors->has('email'))
                <div id="invalidCheckEmail" class="invalid-feedback">
                    {{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_no" class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" value="{{ old('phone_no') }}"
                    placeholder="0821..." aria-label="Name" aria-describedby="invalidCheckPhoneNo">
                @if($errors->has('phone_no'))
                <div id="invalidCheckPhoneNo" class="invalid-feedback">
                    {{ $errors->first('phone_no') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}"
                    placeholder="billxyz..." aria-label="Name" aria-describedby="invalidCheckUsername">
                @if($errors->has('username'))
                <div id="invalidCheckUsername" class="invalid-feedback">
                    {{ $errors->first('username') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="" value="{{ old('password') }}"
                    aria-label="Name" aria-describedby="invalidCheckPassword">
                @if($errors->has('password'))
                <div id="invalidCheckPassword" class="invalid-feedback">
                    {{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm-password"
                    class="form-control {{ $errors->has('confirm-password') ? 'is-invalid' : '' }}" value="{{ old('confirm-password') }}"
                    placeholder="" aria-label="Name" aria-describedby="invalidCheckConfirmPassword">
                @if($errors->has('confirm-password'))
                <div id="invalidCheckConfirmPassword" class="invalid-feedback">
                    {{ $errors->first('confirm-password') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}" value="{{ old('photo') }}"
                    placeholder="" aria-label="Name" aria-describedby="invalidCheckPhoto">
                @if($errors->has('photo'))
                <div id="invalidCheckPhoto" class="invalid-feedback">
                    {{ $errors->first('photo') }}</div>
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Daftar</button>
            </div>
            <p class="mb-4 mt-2 text-sm mx-auto">
                Sudah punya akun?
                <a href="{{ route('user.login') }}" class="text-primary text-gradient font-weight-bold">Masuk disini</a>
            </p>
        </form>
    </div>
</div>
@include('common.footer')
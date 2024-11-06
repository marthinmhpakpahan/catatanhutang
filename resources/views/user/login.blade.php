@include('common.header')
<div class="card mx-auto border-success" style="width: 25rem;">
    <div class="card-body text-center">
        <h4 class="card-title">Halo, selamat datang!</h4>
        <p class="card-text">Masukkan username dan password untuk masuk ke dalam website.</p>
        <form method="POST" class="mt-4" action="{{ route('user.login') }}" role="form">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email">
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password"
                    aria-label="Password">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-100 mt-4 mb-0">Masuk</button>
            </div>
            <p class="mb-4 mt-2 text-sm mx-auto">
                Belum punya akun?
                <a href="{{ route('user.register') }}" class="text-primary text-gradient font-weight-bold">Daftar sekarang!</a>
            </p>
        </form>
    </div>
</div>
@include('common.footer')
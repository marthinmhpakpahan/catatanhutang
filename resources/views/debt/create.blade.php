@include('common.header')
<h4 class="text-end text-danger">Welcome, {{ $username }} <a href="{{ route('user.logout') }}"><div class="btn btn-small btn-outline-danger">Logout</div></a></h4>
<div class="card mx-auto w-50 mt-4 border-success">
    <div class="card-body">
        <h3 class="card-title text-center text-success">Hello, welcome!</h3>
        <p class="card-text text-center text-success">Good to see you! <br />Fill up the following details to register.</p>
        <form method="POST" class="mt-4" action="{{ route('debt.create') }}" role="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label class="form-label">Nama Peminjam</label>
                <select class="form-select {{ $errors->has('debter_data') ? 'is-invalid' : '' }}" name="debter_data">
                    <option value="" {{ old("debter_data") == "" ? 'selected' : '' }}>Pilih nama peminjam</option>
                    @foreach ($debters as $debter)
                    <option data-fullname="{{ $debter->fullname }}" data-description="{{ $debter->description }}" value="{{ $debter->id }}" {{ old("debter_data") == $debter->id ? 'selected' : '' }}>{{ $debter->fullname }}</option>
                    @endforeach
                    <option value="create_new" {{ old("debter_data") == "create_new" ? 'selected' : '' }}>Buat Data Peminjam Baru</option>
                </select>
                @if($errors->has('debter_data'))
                <div id="invalidCheckDebterData" class="invalid-feedback">
                    {{ $errors->first('debter_data') }}</div>
                @endif
            </div>
            <div id="form-debter" class="mb-2 {{ old('debter_data') == 'create_new' ? '' : 'visually-hidden' }}">
                <label class="form-label form-debter-label">Form Peminjam Baru</label>
                <div class="card w-100 mb-2 border-warning">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label">Nama Peminjam</label>
                            <input type="text" name="debter_name"
                                class="form-control {{ $errors->has('debter_name') ? 'is-invalid' : '' }}"
                                value="{{ old('debter_name') }}" placeholder="" aria-label="Name"
                                aria-describedby="invalidCheckDebterName">
                            @if($errors->has('debter_name'))
                            <div id="invalidCheckDebterName" class="invalid-feedback">
                                {{ $errors->first('debter_name') }}</div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Photo</label>
                            <input type="file" name="debter_photo"
                                class="form-control {{ $errors->has('debter_photo') ? 'is-invalid' : '' }}"
                                value="{{ old('debter_photo') }}" placeholder="" aria-label="Name"
                                aria-describedby="invalidCheckDebterPhoto">
                            @if($errors->has('debter_photo'))
                            <div id="invalidCheckDebterPhoto" class="invalid-feedback">
                                {{ $errors->first('debter_photo') }}</div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Deskripsi</label>
                            <textarea type="text" name="debter_description" rows="5"
                                class="form-control {{ $errors->has('debter_description') ? 'is-invalid' : '' }}"
                                placeholder="" aria-label="Name"
                                aria-describedby="invalidCheckDebterDescription">{{ old('debter_description') }}</textarea>
                            @if($errors->has('debter_description'))
                            <div id="invalidCheckDebterDescription" class="invalid-feedback">
                                {{ $errors->first('debter_description') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Total Hutang (Rp.)</label>
                <input type="number" name="total" class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}"
                    value="{{ old('total') }}" placeholder="" aria-label="Name" aria-describedby="invalidCheckTotal">
                @if($errors->has('total'))
                <div id="invalidCheckTotal" class="invalid-feedback">
                    {{ $errors->first('total') }}</div>
                @endif
            </div>
            <div class="mb-2">
                <label class="form-label">Catatan</label>
                <textarea type="text" name="remarks" rows="5"
                    class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" placeholder=""
                    aria-label="Name" aria-describedby="invalidCheckRemarks">{{ old('remarks') }}</textarea>
                @if($errors->has('remarks'))
                <div id="invalidCheckRemarks" class="invalid-feedback">
                    {{ $errors->first('remarks') }}</div>
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-100 mt-4 mb-0">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        console.log("Create Debt Page!");
        $("[name='debter_data']").change(function() {
            var selected_value = this.value;
            if (selected_value != "") {
                $("#form-debter").removeClass("visually-hidden");
                $('input[name="debter_name"]').val("");
                $('input[name="debter_name"]').prop('disabled', false);
                $('textarea[name="debter_description"]').text("");
                $('textarea[name="debter_description"]').prop('disabled', false);
                $('input[name="debter_photo"]').prop('disabled', false);
                $('.form-debter-label').text("Form Peminjam Baru");
                if(selected_value != "create_new") {
                    var debter_fullname = $('option:selected',this).data('fullname');
                    var debter_description = $('option:selected',this).data('description');
                    $('input[name="debter_name"]').val(debter_fullname);
                    $('input[name="debter_name"]').prop('disabled', true);
                    $('textarea[name="debter_description"]').text(debter_description);
                    $('textarea[name="debter_description"]').prop('disabled', true);
                    $('input[name="debter_photo"]').prop('disabled', true);
                    $('.form-debter-label').text("Detail Peminjam");
                }
            } else {
                $("#form-debter").addClass("visually-hidden");
            }
            console.log(this.value);
        });
    });
</script>
@include('common.footer')
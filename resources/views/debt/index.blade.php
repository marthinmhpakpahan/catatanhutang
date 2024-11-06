@include('common.header')
<h4 class="text-end text-danger">Welcome, {{ $username }} <a href="{{ route('user.logout') }}">
        <div class="btn btn-small btn-outline-danger">Logout</div>
    </a></h4>
<div class="row mt-4">
    <div class="card border-success mb-3 col m-2" style="max-width: 15rem;">
        <div class="card-header text-success text-center"><b>Sudah Dibayar</b></div>
        <div class="card-body text-success text-center">
            <h2 class="card-title">{{ $dashboard["count_debt_paid"] }}</h2>
        </div>
    </div>
    <div class="card border-success mb-3 col m-2" style="max-width: 15rem;">
        <div class="card-header text-success text-center"><b>Total Terbayar</b></div>
        <div class="card-body text-success text-center">
            <h4 class="card-title">Rp. {{ number_format($dashboard["count_paid"], 0, ",", ".") }}</h4>
        </div>
    </div>
    <div class="card border-danger mb-3 col m-2" style="max-width: 15rem;">
        <div class="card-header text-danger text-center"><b>Belum Dibayar</b></div>
        <div class="card-body text-danger text-center">
            <h2 class="card-title">{{ $dashboard["count_debt_unpaid"] }}</h2>
        </div>
    </div>
    <div class="card border-danger mb-3 col m-2" style="max-width: 15rem;">
        <div class="card-header text-danger text-center"><b>Total Hutang</b></div>
        <div class="card-body text-danger text-center">
            <h4 class="card-title">Rp. {{ number_format($dashboard["count_debt_total"], 0, ",", ".") }}</h4>
        </div>
    </div>
    <div class="card border-primary mb-3 col m-2" style="max-width: 15rem;">
        <div class="card-header text-primary text-center"><b>Total Peminjam</b></div>
        <div class="card-body text-primary text-center">
            <h2 class="card-title">{{ $dashboard["count_debter"] }}</h2>
        </div>
    </div>
</div>
<a href="{{ route('debt.create') }}">
    <div class="btn btn-success btn-sm mt-4">Tambah Hutang Baru</div>
</a>
<table class="table table-bordered border border-primary mt-4 text-center">
    <thead>
        <tr class="table-primary border border-primary fw-bold">
            <td>Nama Peminjam</td>
            <td>Waktu Peminjaman</td>
            <td>Total Pinjaman</td>
            <td>Status</td>
            <td>Waktu Pembayaran</td>
            <td>Catatan</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody class="table-group-divider border-primary">
        @foreach ($debts as $debt)
        <tr class="{{ $debt->status ? 'table-success' : 'table-danger' }}">
            <td>{{ $debt->debter->fullname }}
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat Foto Profil">
                    <div data-photo="{{ request()->getSchemeAndHttpHost() .'/'.  $debt->debter->photo }}"
                        class="btn btn-sm btn-outline-danger btn-show-image" data-bs-toggle="modal"
                        data-bs-target="#modalDebterImage"><i class="fas fa-image"></i></div>
                </span>
            </td>
            <td>{{ $debt->created_at->format('d F Y, H:i') }}</td>
            <td>Rp. {{ number_format($debt->total, 0, ",", ".") }}</td>
            <td>{{ $debt->status ? "Sudah Lunas" : "Belum Lunas" }}</td>
            <td>{{ $debt->status ? $debt->modified_at->format('d F Y, H:i') : "-" }}</td>
            <td>{{ $debt->remarks }}</td>
            <td>
                @if (!$debt->status)
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tandai Sebagai Lunas">
                    <div data-url="{{ route('debt.mark_as_paid', $debt->id) }}"
                        data-fullname="{{ $debt->debter->fullname }}" data-total="{{ $debt->total }}"
                        data-created="{{ $debt->created_at }}"
                        class="btn btn-success btn-sm rounded-circle btn-tandai-lunas" data-bs-toggle="modal"
                        data-bs-target="#modalConfirmation"><i class="fas fa-check-circle"></i></div>
                </span>
                <a href="{{ route('debt.update', $debt->id) }}">
                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah data hutang"
                        data-url="{{ route('debt.update', $debt->id) }}"
                        class="btn btn-primary btn-sm rounded-circle btn-ubah-hutang"><i class="fas fa-edit"></i></div>
                </a>
                @endif
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus data hutang">
                    <div data-url="{{ route('debt.delete', $debt->id) }}" data-fullname="{{ $debt->debter->fullname }}"
                        data-total="{{ $debt->total }}" data-created="{{ $debt->created_at }}"
                        class="btn btn-danger btn-sm rounded-circle btn-hapus-hutang" data-bs-toggle="modal"
                        data-bs-target="#modalDeleteConfirmation"><i class="fas fa-trash"></i></div>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="modalDebterImage" data-bs-toggle="modal" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="p-2 border-success">
            <img class="img-debter-photo" src="" style="max-width: 30rem;"></img>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-center">
                <h1 class="modal-title fs-5 text-center text-white" id="staticBackdropLabel">Konfirmasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Apakah anda yakin hutang ini sudah lunas?</h4><br />
                <table>
                    <tr>
                        <td>Nama Peminjam</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td><span class="modal-debter-fullname"></span></td>
                    </tr>
                    <tr>
                        <td>Waktu Peminjaman</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td><span class="modal-debt-created-at"></span></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>Rp. <span class="modal-debt-total"></span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a class="modal-btn-confirm-paid" href=""><button type="button"
                        class="btn btn-success">Yakin!</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-center">
                <h1 class="modal-title fs-5 text-center text-white" id="staticBackdropLabel">Konfirmasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Apakah anda yakin ingin menghapus hutang ini?</h4><br />
                <table>
                    <tr>
                        <td>Nama Peminjam</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td><span class="modal-debter-fullname"></span></td>
                    </tr>
                    <tr>
                        <td>Waktu Peminjaman</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td><span class="modal-debt-created-at"></span></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>Rp. <span class="modal-debt-total"></span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a class="modal-btn-confirm-paid" href=""><button type="button"
                        class="btn btn-danger">Yakin!</button></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        console.log("Index Debt Page!");
        $(".btn-tandai-lunas").on("click", function() {
            var data_fullname = $(this).data("fullname");
            $(".modal-debter-fullname").text(data_fullname);
            var data_created = $(this).data("created");
            $(".modal-debt-created-at").text(data_created);
            var data_total = $(this).data("total");
            $(".modal-debt-total").text(data_total);
            var data_url = $(this).data("url");
            $(".modal-btn-confirm-paid").attr("href", data_url);
        });
        $(".btn-hapus-hutang").on("click", function() {
            var data_fullname = $(this).data("fullname");
            $(".modal-debter-fullname").text(data_fullname);
            var data_created = $(this).data("created");
            $(".modal-debt-created-at").text(data_created);
            var data_total = $(this).data("total");
            $(".modal-debt-total").text(data_total);
            var data_url = $(this).data("url");
            $(".modal-btn-confirm-paid").attr("href", data_url);
        });
        $(".btn-show-image").on("click", function() {
            var data_photo = $(this).data("photo");
            $(".img-debter-photo").attr("src", data_photo);
        });
    });
</script>
@include('common.footer')
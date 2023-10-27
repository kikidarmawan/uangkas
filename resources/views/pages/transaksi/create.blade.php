@extends('layouts.dashboard')
@section('title', 'Tambah Transaksi')
@push('vendor_css')
@endpush

@push('custom_css')
@endpush
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Transaksi</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <x-link :route="route('dashboard.index')" :title="'Dashboard'">Dashboard</x-link>
                            </li>

                            <li class="breadcrumb-item">
                                <x-link :route="route('dashboard.transaksi.index')" :title="'Transaksi'">Transaksi</x-link>
                            </li>
                            <li class="breadcrumb-item active">Tambah
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="">

            <!-- List DataTable -->
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tambah transaksi</h5>
                        </div>
                        <form action="{{ route('dashboard.transaksi.store') }}" method="post" class="form form-horizontal">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="nominal">Nominal</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">
                                                        Rp.
                                                    </span>
                                                    <input type="text" id="nominal"
                                                        class="form-control @error('nominal') is-invalid @enderror"
                                                        name="nominal" placeholder="Contoh: 1.0000.0000"
                                                        value="{{ old('nominal') }}">

                                                    @error('nominal')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="">Jenis Transaksi</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="demo-inline-spacing">
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('jns_trx') is-invalid @enderror"
                                                            type="radio" name="jns_trx" id="debit" value="debit"
                                                            checked="">
                                                        <label class="form-check-label" for="debit">Debit</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('js_trx') is-invalid @enderror"
                                                            type="radio" name="jns_trx" id="kredit" value="kredit">
                                                        <label class="form-check-label" for="kredit">Kredit</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="contact-icon">Tanggal Transaksi</label>
                                            </div>
                                            <div class="col-sm-9 col-lg-4">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">
                                                        <x-icon-feather icon="calendar" class="me-1" />
                                                    </span>
                                                    <input type="date" id="tanggal" class="form-control" name="tanggal"
                                                        value="{{ old('tanggal') ?? date('Y-m-d') }}">
                                                    @error('tanggal')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="pass-icon">Keterangan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea name="keterangan" id="" class="form-control" cols="30" rows="3">{{ old('keterangan') }}</textarea>
                                                @error('keterangan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <x-button type="submit" color="primary" title="Simpan Transaksi"
                                    id="simpan">Simpan</x-button>
                                <x-button type="reset" color="warning" title="Reset Form" id="reset">Reset</x-button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar bg-light-success p-50 mb-1">
                                <div class="avatar-content">
                                    <x-icon-feather icon="credit-card" class="font-medium-5" />
                                </div>
                            </div>
                            <h2 class="fw-bolder">
                                @currencyRupiah($dompet->saldo)
                            </h2>
                            <p class="card-text">Saldo Dompet</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ List DataTable -->
        </section>
        <!-- Dashboard Analytics end -->

    </div>
@endsection

@push('vendor_js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function() {

            $('#nominal').on('keyup', function() {
                let nominal = $(this).val();
                let nominalFormat = formatRupiah(nominal, 'Rp. ');
                $(this).val(nominalFormat);

            });

            $('#nominal').on('keydown', function() {
                let nominal = $(this).val();
                nominal = nominal.replace('Rp. ', '');
                $(this).val(nominal);
            });

            $('#nominal').on('keypress', function() {
                let nominal = $(this).val();
                nominal = nominal.replace('Rp. ', '');
                $(this).val(nominal);
            });

            $('#nominal').on('focusout', function() {
                let nominal = $(this).val();
                nominal = nominal.replace('Rp. ', '');
                $(this).val(nominal);
            });

            $('#nominal').on('focusin', function() {
                let nominal = $(this).val();
                nominal = nominal.replace('Rp. ', '');
                $(this).val(nominal);
            });
        });
    </script>
@endpush

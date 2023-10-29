@extends('layouts.dashboard')
@section('title', 'Dashboard')
@push('vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
@endpush

@push('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}"> --}}
@endpush
@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row match-height">
                <div class="col-12">
                    {{-- filter transaksi --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Periode</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.index') }}" method="get">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-1">
                                        <input type="date" class="form-control" value="{{ $startDate }}"
                                            name="startDate">
                                    </div>
                                    <div class="col-12 col-md-4 mb-1">
                                        <input type="date" class="form-control" value="{{ $endDate }}"
                                            name="endDate">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <x-button color="primary" type="submit" title="Filter data"
                                            id="filter">Filter</x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar bg-light-danger p-50 mb-1">
                                <div class="avatar-content">
                                    <x-icon-feather icon="upload" class="font-medium-5" />
                                </div>
                            </div>
                            <h2 class="fw-bolder">
                                @currencyRupiah($totalDebit)
                            </h2>
                            <p class="card-text">Total Pengeluaran</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar bg-light-success p-50 mb-1">
                                <div class="avatar-content">
                                    <x-icon-feather icon="download" class="font-medium-5" />
                                </div>
                            </div>
                            <h2 class="fw-bolder">
                                @currencyRupiah($totalCredit)
                            </h2>
                            <p class="card-text">Total Pemasukan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Daftar transaksi</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <x-icon-feather icon="info" class="me-1" />
                                Berikut adalah daftar transaksi yang telah dilakukan
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableTrx">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis</th>
                                            <th>Ref ID</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Saldo Akhir</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Trx</th>
                                            <th>Tanggal Input</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('vendor_js')
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
@endpush

@push('custom_js')
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            $('#tableTrx').DataTable({
                language: {
                    url: "{{ asset('app-assets/vendors/js/tables/datatable/Indonesian.json') }}"
                },
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    url: "{{ route('dashboard.index', ['startDate' => $startDate, 'endDate' => $endDate]) }}",
                    type: "GET",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },

                    {
                        data: 'jns_trx',
                        name: 'jns_trx',
                        className: 'text-center'
                    },

                    {
                        data: 'ref_id',
                        name: 'ref_id',
                        className: 'text-center'
                    },
                    {
                        data: 'debit',
                        name: 'debit',
                        className: 'text-center'
                    },
                    {
                        data: 'kredit',
                        name: 'kredit',
                        className: 'text-center'
                    },
                    {
                        data: 'saldo',
                        name: 'saldo',
                        className: 'text-center'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center'
                    },
                ]
            });
        });
    </script>
@endpush

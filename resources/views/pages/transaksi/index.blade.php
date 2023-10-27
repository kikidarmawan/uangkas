@extends('layouts.dashboard')
@section('title', 'Transaksi')
@push('vendor_css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
@endpush

@push('custom_css')
    <style type="text/css">
        /* table no wrap */

        table {
            /* table-layout: fixed;
                width: 100%;
                white-space: nowrap; */
        }
    </style>
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
                            <li class="breadcrumb-item active">Transaksi
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Daftar transaksi</h5>
                            <span class="float-right">
                                <x-button-link icon="plus" :route="route('dashboard.transaksi.create')" type='primary' title="Buat Transaksi">
                                    Tambah Transaksi
                                </x-button-link>
                            </span>
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
            $('#tableTrx').DataTable({
                language: {
                    url: "{{ asset('app-assets/vendors/js/tables/datatable/Indonesian.json') }}"
                },
                serverSide: true,
                processing: true,

                ajax: {
                    url: "{{ route('dashboard.transaksi.index') }}",
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

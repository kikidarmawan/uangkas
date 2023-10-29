@extends('layouts.dashboard')
@section('title', 'Laporan Transaksi Harian')
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
                    <h2 class="content-header-title float-start mb-0">Laporan Transaksi</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <x-link :route="route('dashboard.index')" :title="'Dashboard'">Dashboard</x-link>
                            </li>
                            <li class="breadcrumb-item active">Laporan Transaksi Harian
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
                            <h5 class="card-title">
                                Periode
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.report.transaksi.harian') }}" method="get">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="mb-1">
                                            <label for="startDate" class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="startDate" name="startDate"
                                                value="{{ $startDate }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="mb-1">
                                            <label for="endDate" class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="endDate" name="endDate"
                                                value="{{ $endDate }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <x-button type="submit" color="primary" title="Terapkan Filter" id="tampilkan">
                                            Tampilkan
                                        </x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Laporan transaksi harian</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <x-icon-feather icon="info" class="me-1" />
                                Berikut adalah laporan transaksi harian dari tanggal
                                {{ date('d/m/Y', strtotime($startDate)) }} sampai tanggal
                                {{ date('d/m/Y', strtotime($endDate)) }}
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableTrx">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kredit (Pemasukan)</th>
                                            <th>Debit (Pengeluaran)</th>
                                            <th>Selisih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ date('d/m/Y', strtotime($item['tanggal'])) }}</td>
                                                <td>
                                                    <span class="text-success">{{ Currency::rupiah($item['total_kredit']) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-danger">{{ Currency::rupiah($item['total_debit']) }}</span>
                                                </td>
                                                <td>
                                                    @if ($item['selisih'] > 0)
                                                        <span class="text-success">{{ Currency::rupiah($item['selisih']) }}
                                                        </span>
                                                    @elseif($item['selisih'] < 0)
                                                        <span
                                                            class="text-danger">{{ Currency::rupiah($item['selisih']) }}</span>
                                                    @else
                                                        <span
                                                            class="text-secondary">{{ Currency::rupiah($item['selisih']) }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
            });
        });
    </script>
@endpush

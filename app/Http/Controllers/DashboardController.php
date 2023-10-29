<?php

namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Repositories\DompetRiwayat\DompetRiwayatRepository;
use App\Repositories\Transaksi\TransaksiRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{

    public function __construct(
        protected TransaksiRepository $transaksiRepository,
        protected DompetRiwayatRepository $dompetRiwayatRepository
    ) {
    }
    public function index(Request $request)
    {

        $user = auth()->user();
        $dompetId = $user->dompet->id;
        $startDate = isset($request->startDate) ? $request->startDate : date('Y-m-d', strtotime('-1 month'));
        $endDate = isset($request->endDate) ? $request->endDate : date('Y-m-d');
        $totalDebit = $this->transaksiRepository->sumNominal('debit', $startDate, $endDate, $dompetId);
        $totalCredit = $this->transaksiRepository->sumNominal('kredit', $startDate, $endDate, $dompetId);

        if ($request->ajax()) {
            $query = $this->dompetRiwayatRepository->getDompetRiwayatByDompetIdAndFilterByDate($dompetId, $startDate, $endDate);
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('nominal', function ($row) {
                    if ($row['jns_trx'] == 'debit') {
                        return "<span class='text-danger'>-" . Currency::rupiah($row['debit']) . "</span>";
                    } else {
                        return "<span class='text-success'>+" . Currency::rupiah($row['kredit']) . "</span>";
                    }
                })
                ->editColumn('saldo', function ($row) {
                    return  '<span class="text-primary">' . Currency::rupiah($row['saldo']) . '</span>';
                })
                ->editColumn('jns_trx', function ($row) {
                    return $row['jns_trx'] == 'debit' ? '<span class="badge bg-light-danger">Debit</span>' : '<span class="badge bg-light-success">Kredit</span>';
                })
                ->rawColumns(['jns_trx', 'saldo', 'nominal'])
                ->toJson();
        }
        return view('pages.dashboard', [
            'totalDebit' => $totalDebit,
            'totalCredit' => $totalCredit,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}

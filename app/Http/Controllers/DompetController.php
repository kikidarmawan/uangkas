<?php

namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Repositories\Dompet\DompetRepository;
use App\Repositories\DompetRiwayat\DompetRiwayatRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DompetController extends Controller
{
    public function __construct(protected DompetRepository $dompetRepository, protected DompetRiwayatRepository $dompetRiwayatRepository)
    {
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $dompet = $user->dompet;
        $startDate = isset($request->startDate) ? $request->startDate : Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = isset($request->endDate) ? $request->endDate : date('Y-m-d');
        $mutations = $this->dompetRiwayatRepository->getDompetRiwayatByDompetIdAndFilterByDate($dompet->id, $startDate, $endDate);
        // group by month
        // $mutations = collect($mutations)->groupBy(function ($item) {
        //     return Carbon::parse($item['created_at'])->format('m');
        // })->toArray();
        // return $mutations;
        $totalDebit = collect($mutations)->where('jns_trx', 'debit')->sum('debit');
        $totalKredit = collect($mutations)->where('jns_trx', 'kredit')->sum('kredit');
        if ($request->ajax()) {
            // $query = $this->dompetRiwayatRepository->getDompetRiwayatByDompetId($dompet->id);
            return DataTables::of($mutations)
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
                ->rawColumns(['jns_trx', 'nominal', 'saldo'])
                ->toJson();
        }
        return view('pages.dompet.index', [
            'dompet' => $dompet,
            'totalDebit' => $totalDebit,
            'totalKredit' => $totalKredit,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Repositories\Dompet\DompetRepository;
use App\Repositories\DompetRiwayat\DompetRiwayatRepository;
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
        if ($request->ajax()) {
            $query = $this->dompetRiwayatRepository->getDompetRiwayatByDompetId($dompet->id);
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
                ->rawColumns(['jns_trx', 'nominal', 'saldo'])
                ->toJson();
        }
        return view('pages.dompet.index', [
            'dompet' => $dompet
        ]);
    }
}

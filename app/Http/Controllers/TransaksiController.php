<?php

namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Helpers\Random;
use App\Http\Requests\Transaksi\TransaksiCreateRequest;
use App\Repositories\Dompet\DompetRepository;
use App\Repositories\DompetRiwayat\DompetRiwayatRepository as DompetRiwayatDompetRiwayatRepository;
use App\Repositories\Transaksi\TransaksiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function __construct(
        protected TransaksiRepository $transaksiRepository,
        protected DompetRepository $dompetRepository,
        protected DompetRiwayatDompetRiwayatRepository $dompetRiwayatRepository
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            $query = $this->dompetRiwayatRepository->getDompetRiwayatByDompetId($user->dompet->id);
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
        return view('pages.transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $dompet = $this->dompetRepository->getDompetByUserId($user->id);
        return view('pages.transaksi.create', [
            'dompet' => $dompet
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiCreateRequest $request)
    {
        try {


            DB::beginTransaction();
            $user = auth()->user();
            $nominal = str_replace('.', '', $request->nominal);
            $refId = Random::refId();
            $dompet = $this->dompetRepository->getDompetByUserId($user->id);

            $data = [
                'nominal' => $nominal,
                'jns_trx' => $request->jns_trx,
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal,
                'user_id' => $user->id,
                'ref_id'    => $refId,
                'dompet_id' => $dompet->id
            ];

            $saldo = $dompet->saldo;
            $debit = 0;
            $kredit = 0;
            if ($request->jns_trx == 'debit') {
                if ($saldo < $nominal) {
                    return redirect()->back()->with('warning', 'Saldo tidak cukup')->withInput($request->all());
                }
                $debit = $nominal;
                $saldo = $saldo - $nominal;
            } else if ($request->jns_trx == 'kredit') {
                $kredit = $nominal;
                $saldo = $saldo + $nominal;
            } else {
                return redirect()->back()->with('warning', 'Jenis transaksi tidak valid')->withInput($request->all());
            }
            $trx = $this->transaksiRepository->createTransaksi($data);

            $this->dompetRepository->updateDompet(
                [
                    'saldo' => $saldo
                ],
                $dompet->id
            );

            $this->dompetRiwayatRepository->createDompetRiwayat([
                'dompet_id' => $dompet->id,
                'debit' => $debit,
                'kredit' => $kredit,
                'saldo' => $saldo,
                'tanggal' => $request->tanggal,
                'jns_trx' => $request->jns_trx,
                'keterangan' => $request->keterangan,
                'ref_id' => $trx->ref_id
            ]);

            DB::commit();

            return redirect()->route('dashboard.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

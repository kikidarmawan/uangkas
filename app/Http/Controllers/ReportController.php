<?php

namespace App\Http\Controllers;

use App\Helpers\DateFormat;
use App\Repositories\Transaksi\TransaksiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct(protected TransaksiRepository $transaksiRepository)
    {
    }

    public function dailyReport(Request $request)
    {
        $user = Auth::user();
        $dompetId = $user->dompet->id;
        $startDate = isset($request->startDate) ? $request->startDate : date('Y-m-d', strtotime('-1 week'));
        $endDate = isset($request->endDate) ? $request->endDate : date('Y-m-d');

        $data = $this->transaksiRepository->dailyReport($startDate, $endDate, $dompetId);

        return view('pages.report.transaksi.harian', compact('data', 'startDate', 'endDate'));
    }

    public function monthlyReport(Request $request)
    {
        $user = Auth::user();
        $dompetId = $user->dompet->id;
        $startDate = isset($request->startDate) ? $request->startDate : date('Y-m-d', strtotime('-1 week'));
        $endDate = isset($request->endDate) ? $request->endDate : date('Y-m-d');

        $data = $this->transaksiRepository->monthlyReport($startDate, $endDate, $dompetId);

        $data = collect($data)->map(function ($item) {
            $item['bulan'] = DateFormat::namaBulanIndonesia((string) $item['bulan']);

            return $item;
        })->toArray();

        return view('pages.report.transaksi.bulanan', compact('data', 'startDate', 'endDate'));
    }
}

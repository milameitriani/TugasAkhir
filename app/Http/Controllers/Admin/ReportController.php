<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Repositories\Order\Report\OrderReport;
use App\Http\Requests\Admin\Report\{ReportDateRequest, ReportMonthRequest, ReportPeriodRequest};

use PDF;

class ReportController extends Controller
{

    protected $orderReport;

    public function __construct(OrderReport $orderReport)
    {
        $this->orderReport = $orderReport;
    }

    public function date(ReportDateRequest $request): Response
    {
        $title = 'Laporan Per Hari';

        $dateTime = strtotime($request->date ?? 'today');
        $date = date('d-m-Y', $dateTime);

        $orders = $this->orderReport->byDate(date('Y-m-d', $dateTime));

        $pdf = PDF::loadView('admin.report.print', compact('title', 'date', 'orders'));

        return $pdf->stream();
    }

    public function month(ReportMonthRequest $request): Response
    {
        $title = 'Laporan Per Bulan';

        $year = $request->year ?? date('Y');
        $month = $request->month ? mktime(0,0,0,$request->month,1,$year) : strtotime('this month');

        $orders = $this->orderReport->byMonth(date('m', $month), $year);

        $date = 'Bulan '.date('m', $month).' Tahun '.date('Y', $month);

        $pdf = PDF::loadView('admin.report.print', compact('title', 'date', 'orders'));

        return $pdf->stream();
    }

    public function period(ReportPeriodRequest $request): Response
    {
        $title = 'Laporan Per Periode';

        $start = strtotime($request->start ?? 'today');
        $end = strtotime($request->end ?? 'today');

        $date = date('d-m-Y', $start).' - '.date('d-m-Y', $end);

        $orders = $this->orderReport->byPeriod(date('Y-m-d', $start), date('Y-m-d', $end));

        $pdf = PDF::loadView('admin.report.print', compact('title', 'date', 'orders'));

        return $pdf->stream();;
    }

    public function all(): Response
    {
        $title = 'Laporan Semua';
        $date = 'Semua';

        $orders = $this->orderReport->all();

        $pdf = PDF::loadView('admin.report.print', compact('title', 'date', 'orders'));

        return $pdf->stream();;
    }

}

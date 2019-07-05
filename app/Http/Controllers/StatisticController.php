<?php


namespace App\Http\Controllers;


use App\Classes\Filters\StatisticPaymentFilter;
use App\Classes\LogicalModels\PaymentsRepository;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public $payments;

    public function __construct(PaymentsRepository $paymentsRepository)
    {
        $this->payments = $paymentsRepository;
    }

    public function all()
    {
        $filterToday = StatisticPaymentFilter::create([
            'updated_from' => Carbon::now()->format('Y-m-d'),
            'updated_to' => Carbon::now()->format('Y-m-d'),
        ]);
        $filterCurrentMonth = StatisticPaymentFilter::create([
            'updated_from' => Carbon::now()->startOfMonth()->format('Y-m-d'),
            'updated_to' => Carbon::now()->endOfMonth()->format('Y-m-d'),
        ]);
        $filterPreviousMonth = StatisticPaymentFilter::create([
            'updated_from' => Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d'),
            'updated_to' => Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d'),
        ]);

        $allPayments = $this->payments->getStatistic();
        $todayPayments = $this->payments->getStatistic($filterToday);
        $currentMonth = $this->payments->getStatistic($filterCurrentMonth);
        $previousMonth = $this->payments->getStatistic($filterPreviousMonth);

        $top10 = $this->payments->top10ByMerchants();
        $top10Today = $this->payments->top10ByMerchants($filterToday);
        $top10currentMonth = $this->payments->top10ByMerchants($filterCurrentMonth);
        $top10previousMonth = $this->payments->top10ByMerchants($filterPreviousMonth);


        $filterToday->groupBy = 'route';
        $filterCurrentMonth->groupBy = 'route';
        $filterPreviousMonth->groupBy = 'route';
        $filterAll  = StatisticPaymentFilter::create([]);
        $filterAll->groupBy = 'route';

        $allPaymentsByRoutes = $this->payments->getStatistic($filterAll);
        $todayPaymentsByRoutes = $this->payments->getStatistic($filterToday);
        $currentMonthByRoutes = $this->payments->getStatistic($filterCurrentMonth);
        $previousMonthByRoutes = $this->payments->getStatistic($filterPreviousMonth);


        return view('payments.statistic')->with([
            'all' => $allPayments,
            'todayPayments' => $todayPayments,
            'previousMonth' => $previousMonth,
            'currentMonth' => $currentMonth,
            'top10' => $top10,
            'top10Today' => $top10Today,
            'top10currentMonth' => $top10currentMonth,
            'top10previousMonth' => $top10previousMonth,
            'allPaymentsByRoutes' => $allPaymentsByRoutes,
            'todayPaymentsByRoutes' => $todayPaymentsByRoutes,
            'currentMonthByRoutes' => $currentMonthByRoutes,
            'previousMonthByRoutes' => $previousMonthByRoutes
        ]);
    }
}
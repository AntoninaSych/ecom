<?php


namespace App\Http\Controllers;


use App\Classes\Filters\StatisticPaymentFilter;
use App\Classes\LogicalModels\PaymentsRepository;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public $payments;
    public $filterToday;
    public $filterCurrentMonth;
    public $filterPreviousMonth;

    public function __construct(PaymentsRepository $paymentsRepository)
    {
        $this->payments = $paymentsRepository;

    }

    public function all()
    {
        return view('payments.statistic');
    }

    public function overAll()
    { $this->setUpFilters();
        $allPayments = $this->payments->getStatistic();
        $todayPayments = $this->payments->getStatistic($this->filterToday);
        $currentMonth = $this->payments->getStatistic($this->filterCurrentMonth);
        $previousMonth = $this->payments->getStatistic($this->filterPreviousMonth);
        return view('payments.statistic.main-statistic')->with([
            'all' => $allPayments,
            'todayPayments' => $todayPayments,
            'previousMonth' => $previousMonth,
            'currentMonth' => $currentMonth
        ]);

    }

    public function topTen()
    {
        $this->setUpFilters();
        $top10 = $this->payments->top10ByMerchants();
        $top10Today = $this->payments->top10ByMerchants($this->filterToday);
        $top10currentMonth = $this->payments->top10ByMerchants($this->filterCurrentMonth);
        $top10previousMonth = $this->payments->top10ByMerchants($this->filterPreviousMonth);
        return view('payments.statistic.top-10-merchant')->with([
            'top10' => $top10,
            'top10Today' => $top10Today,
            'top10currentMonth' => $top10currentMonth,
            'top10previousMonth' => $top10previousMonth,

        ]);
    }

    public function byRoutes()
    {
        $this->setUpFilters();
        $allPaymentsByRoutes = $this->payments->getStatisticByRoute();
        $todayPaymentsByRoutes = $this->payments->getStatisticByRoute($this->filterToday);
        $currentMonthByRoutes = $this->payments->getStatisticByRoute($this->filterCurrentMonth);
        $previousMonthByRoutes = $this->payments->getStatisticByRoute($this->filterPreviousMonth);


        return view('payments.statistic.by-routes')->with([
            'allPaymentsByRoutes' => $allPaymentsByRoutes,
            'todayPaymentsByRoutes' => $todayPaymentsByRoutes,
            'currentMonthByRoutes' => $currentMonthByRoutes,
            'previousMonthByRoutes' => $previousMonthByRoutes
        ]);
    }


    private function setUpFilters()
    {
        $this->filterToday = StatisticPaymentFilter::create([
            'updated_from' => Carbon::now()->format('Y-m-d'),
            'updated_to' => Carbon::now()->format('Y-m-d'),
        ]);
        $this->filterCurrentMonth = StatisticPaymentFilter::create([
            'updated_from' => Carbon::now()->startOfMonth()->format('Y-m-d'),
            'updated_to' => Carbon::now()->endOfMonth()->format('Y-m-d'),
        ]);
        $this->filterPreviousMonth = StatisticPaymentFilter::create([
            'updated_from' => Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d'),
            'updated_to' => Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d'),
        ]);
    }
}
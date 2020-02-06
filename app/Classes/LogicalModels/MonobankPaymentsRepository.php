<?php


namespace App\Classes\LogicalModels;

use App\Models\MonobankPayments;
use Illuminate\Support\Facades\DB;

class MonobankPaymentsRepository
{
    public static function getList($start_date, $end_date)
    {
        $paymentsMono = DB::table('monobank_payments as mp')
            ->select(DB::raw("
            p.order_id as transactionId ,
           concat(concat(SUBSTR(p.card_num,1,6),'******'),SUBSTR(p.card_num,-4)) as PAN, p.phone,
         REPLACE(CAST(p.amount AS CHAR), '.', ',') as amount,
          p.id as txn_id,
        mp.ts,
        '' as prv_txn
            "))
            ->leftJoin('payments as p', 'mp.payment_id', '=', 'p.id')
             ->whereBetween('mp.ts', [$start_date, $end_date])
            ->orderBy('p.id')
            ->get();

        return $paymentsMono;
    }
}

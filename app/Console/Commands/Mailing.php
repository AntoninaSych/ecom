<?php

namespace App\Console\Commands;

use App\Classes\LogicalModels\MailPostmanRepository;
use App\Classes\LogicalModels\MerchMailingSetRepository;
use App\Classes\LogicalModels\PaymentsRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Mailing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing-merchants {type},{start_date=null},{end_date=null}{merchant_id=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mails to merchants by types of mailing  
    * php artisan mailing-merchants 1 2019-08-01 2019-08-18
     * php artisan mailing-merchants 3
     * php artisan mailing-merchants 1 2019-08-01 2019-08-18 33';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * php artisan mailing-merchants 1 2019-08-01 2019-08-18
     * php artisan mailing-merchants 2
     * php artisan mailing-merchants 1 2019-08-01 2019-08-18 33
     * @return mixed
     */
    public function handle()
    {
        // 1	Ежедневная
        // 3	Ежемесячная (1 числа каждого месяца за предыдущий),
//        $type = 1;
//        $this->info(    'start_date1=='.$this->argument('start_date'));
//        $this->info(    "type0=".$this->argument('type') );
//        $this->info(    'end_date2='.$this->argument('end_date'));
//return '';die();
        switch ($this->argument('type')) {
            case 1:
                $start_date = Carbon::now()->subDay()->startOfDay()->format('Y-m-d');
                $end_date = Carbon::now()->subDay()->endOfDay()->format('Y-m-d');
                break;
            case 3:
                $start_date = Carbon::now()->subMonth()->startOfMonth();
                $end_date = Carbon::now()->subMonth()->endOfMonth();
                break;
            default:
                return $this->error('Неверное значение type');

        }

        if ($this->argument('start_date') !== "null" && $this->argument('end_date') !== "null") {
            $start_date = Carbon::createFromFormat('Y-m-d', $this->argument('start_date'))->startOfDay();
            $end_date = Carbon::createFromFormat('Y-m-d', $this->argument('end_date'))->endOfDay();
        }

        $type = $this->argument('type');

        $settings = new   MerchMailingSetRepository();

        $merchants = $settings->getMerchantsByType($type);
        if ($this->argument('merchant_id') !== 'null') {
            $merchants = $settings->getMerchantById($this->argument('merchant_id'));
        }

        $files = [];
        //Создание файла
        foreach ($merchants as $merchant) {

            $fileName = $merchant->merchantName->name . '_' . Carbon::now()->format('Y-m-d_h-i-s') . '.csv';

            $filePath = public_path() . '/mailing/reestrs/';
            $files[] = [
                'path' => $filePath . $fileName,
                'merchantName' => $merchant->merchantName->name,
                'email' => $merchant->email
            ];
            $handle = fopen($filePath . $fileName, 'w') or die('Cannot open file:  ' . $fileName);

            $p = PaymentsRepository::getDataForReestr($merchant->merchant_id, $start_date, $end_date)->all();

            fputcsv($handle, ['Дата платежа', 'ID транзакции', '№ Заказа', 'PAN', 'Сумма', 'Комиссия'], ';');

            foreach ($p as $p1) {
                fputcsv($handle, get_object_vars($p1), ';');
            }
            fclose($handle);
        }
        //Конец создания файла

        foreach ($files as $file) {
            MailPostmanRepository::newLetter($file['merchantName'], $file['path'], $file['email']);
        }
    }
}

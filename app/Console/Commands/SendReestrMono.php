<?php

namespace App\Console\Commands;

use App\Classes\LogicalModels\MailPostmanRepository;
use App\Classes\LogicalModels\MonobankPaymentsRepository;
use App\Models\MailerPostman;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendReestrMono extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing-mono {start_date=null},{end_date=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * php artisan mailing-mono 2019-08-09 2019-08-09
     * php artisan mailing-mono
     * @return mixed
     */
    public function handle()
    {
        $p = new MonobankPaymentsRepository();

        if ($this->argument('start_date') !== "null" && $this->argument('end_date') !== "null") {
            $start_date = Carbon::createFromFormat('Y-m-d', $this->argument('start_date'))->startOfDay();
            $end_date = Carbon::createFromFormat('Y-m-d', $this->argument('end_date'))->endOfDay();
            $start_date = Carbon::createFromFormat('Y-m-d', $this->argument('start_date'))->startOfDay();
        } else {

            $start_date = Carbon::now()->subDay()->startOfDay()->format('Y-m-d');
            $end_date = Carbon::now()->subDay()->endOfDay()->format('Y-m-d');
        }

        $mails = config('mailing.mono.email'); //

        //Создание файла
        $fileName = 'mono'. '_' . Carbon::now()->format('Y-m-d_h-i-s') . '.csv';
        $filePath = public_path() . '/mailing/reestrs/mono/';

        $path = $filePath . $fileName;
        $handle = fopen($filePath . $fileName, 'w') or die('Cannot open file:  ' . $fileName);

        $monoPayments = $p->getList($start_date, $end_date);

        fputcsv($handle, ['Номер записи', 'Номер карты', 'Номер телефона', 'Сумма платежа', 'txn_id', 'Дата и время платежа', 'prv_txn'], ';');

        foreach ($monoPayments as $payment) {
            fputcsv($handle, get_object_vars($payment), ';');
        }
        fclose($handle);

        //Конец создания файла

        foreach ($mails as $email) {
            $letter = new MailerPostman();
            $letter->subject = "Данные из реестра (Монобанк).";
            $letter->body = view('email.mono');
            $letter->date_create = date('y-m-d h:m:i');
            $letter->code = "Mailing_mono_reestr_" . Str::random(40);
            $letter->attachments = $path;
            $letter->recipients = json_encode([
                'from' => [
                    'concord@concord.ua',
                    'Concord Bank'],
                'to' => [$email]]);
            MailPostmanRepository::newLetter($letter);
        }
    }
}

<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

use ParseCsv\Csv;
use SimpleXMLElement;

class ReestrController extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('reestrs.index');
    }

    public function getReestr()
    {
        $date = explode("-", $this->request->get('date_reestr'));
        $sig = $this->signature($date[2] . $date[1] . $date[0]);

        $client = new \GuzzleHttp\Client();

        $result = $client->get(
            env('URL_MONOBANK_REESTR') . '/journalByWithdrawalPan/csv?&bank=CB&year=' . $date[2] . '&month=' . $date[1] . '&date=' . $date[0] . '&sig=' . $sig

        );

        $response = $result->getBody()->getContents();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="text.csv";');


        print str_replace('EOF', '', $response);
        return;


    }

    public function signature($data)
    {
        $pkeyid = openssl_pkey_get_private(file_get_contents(base_path().env('MONOBANK_KEY_PATH')));

        $signature = null;
        openssl_sign($data, $signature, $pkeyid);
        openssl_free_key($pkeyid);
        return bin2hex($signature);
    }
}
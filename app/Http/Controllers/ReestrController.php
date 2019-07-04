<?php


namespace App\Http\Controllers;


use App\Classes\LogicalModels\Reestrs\MonobankRepository;
use Illuminate\Http\Request;


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
        $reestrKey = $this->request->get('type_reestr');
        $reestrDate = $this->request->get('date_reestr');

        switch ($reestrKey) {
            case 'mono':
                $reestr = new MonobankRepository();
                break;
            case 1:
//                echo "i равно 1";
                break;
            case 2:
//                echo "i равно 2";
                break;
        }

        return $reestr->getReestr($reestrDate);

    }


}
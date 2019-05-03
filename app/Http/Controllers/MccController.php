<?php

namespace App\Http\Controllers;


use App\Classes\LogicalModels\MccCodeRepository;
use App\Http\Requests\Mcc\UpdateMccRequest;
use Yajra\DataTables\Facades\DataTables;

class MccController extends Controller
{
    protected $codes;

    public function __construct(MccCodeRepository $codes)
    {
        $this->codes = $codes;
    }

    public function index()
    {
        $codes = $this->codes->getList();

        return view('mcc.index')->with(['codes' => $codes]);
    }

    public function edit(int $id)
    {
        $code = $this->codes->getOne($id);

        return view('mcc.edit')->with(['code' => $code]);
    }

    public function create()
    {
        return view('mcc.store');
    }

    public function update(UpdateMccRequest $request, int $id)
    {
        $this->codes->update($request, $id);

        return redirect()->back()->with('success', 'Mcc код  с ID  ' . $id . ' успешно обновлен.');
    }


    public function destroy(int $id)
    {

        $this->codes->destroy($id);
        return redirect()->back()->with('success', 'Mcc код  с ID  ' . $id . ' успешно удален.');
    }


    public function store(UpdateMccRequest $request)
    {

        $this->codes->store($request);
        return redirect()->back()->with('success', 'Mcc код успешно добавлен.');
    }

    /**
     * @return mixed
     * @throws \Exception
     * using for creating Datatable
     */
    public function anyData()
    {
        $codes = $this->codes->getList();
        return Datatables::of($codes)
            ->addColumn('id', function ($codes) {
                return $codes->id;
            })
            ->addColumn('name', function ($codes) {
                return $codes->name;
            })
            ->editColumn('code', function ($codes) {
                return $codes->code;
            })
            ->editColumn('applePay', function ($codes) {

                return ($codes->apple_pay) ? 'Активен' : 'Не активен';
            })
            ->editColumn('updated', function ($codes) {
                return $codes->updated_at;
            })
            ->addColumn('view_details', function ($codes) {
                return '<a class="btn btn-black" href="' . route('mcc.edit', ['id' => intval($codes->id)]) . '"><i class="fa fa-fw fa-edit"></i></a>';
            })
            ->addColumn('remove', function ($codes) {
                return '<a class="btn btn-danger" href="/mcc/destroy/' . $codes->id . '"><i class="fa fa-fw fa-remove"></i></a>';
            })
            ->rawColumns(['view_details', 'remove'])
            ->make(true);
    }

}

<?php


namespace App\Classes\LogicalModels;


use App\Classes\Filters\ExecuteFilter;

use App\Models\Reports;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ReportsRepository
{
    public function save(Reports $reports)
    {
        $reports->save();
    }

    public function list(): Collection
    {
        $reports = new Reports();
        $list = $reports->select()->orderBy('id', 'desc')->get();
        return $list;
    }

    public function remove(Reports $reports): void
    {
        $reports->delete();
    }

    public function getOne($id): Reports
    {
        $reports = new Reports();
        $report = $reports->select()->where('id', $id)->first();
        return $report;
    }


    /*
     *  $results = DB::select('select * from users where id = :id', ['id' => 1]);
     *
     */
    public function execute(Reports $report,   $params=null)
    {
        if(!is_null($params))
        {
        $report->query = str_replace("@", ":", $report->query);

        $results = DB::select($report->query,  $params);

        return $results;
        }

        $results = DB::select($report->query);
        return $results;
    }
}

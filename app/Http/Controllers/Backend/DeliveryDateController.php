<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\WeekDaysModel;
use App\Models\DeliveryDaysModel;

class DeliveryDateController extends Controller
{
    protected $flashData = [
        'status' => 0,
        'message' => 'Something went wrong.Try again later.',
    ];

    public function index(Request $request)
    {
        $weedays = WeekDaysModel::orderBy('id')->get();
        $days = DeliveryDaysModel::orderBy('day_date','asc')->get();

        if ($request->ajax()) {
            $users = Brand::select(['id', 'name', 'status'])
                ->bothInActive();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return ucwords($row->name);
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '1') {
                        return '<b class="text-success">ACTIVE</b>';
                    } else if ($row->status == 0) {
                        return '<b>IN-ACTIVE</b>';
                    }
                    
                })
                ->addColumn('actions', function ($row) {
                    if ($row->status == '1') {
                        $actions = '<a href="javascript:void(0);" title="Lock" class="btn btn-outline-dark changeStatus" data-rowurl="' . route('admin.masters.brands.updateStatus', [$row->id, 0]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-lock"></i></a> ';
                    } else if ($row->status == 0) {
                        $actions = '<a href="javascript:void(0);" title="Unlock" class="btn btn-outline-success changeStatus" data-rowurl="' . route('admin.masters.brands.updateStatus', [$row->id, 1]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-unlock-alt"></i></a> ';
                    }

                    $actions .= '<a title="Update" data-href="' . route('admin.masters.brands.edit', $row->id) . '" href="javascript:void(0)" class="btn btn-outline-info editRow"><i class="fa fa-fw fa-edit"></i></a> ';
                    $actions .= ' <a title="Delete" href="javascript:void(0);" data-rowurl="' . route('admin.masters.brands.updateStatus', [$row->id, 2]) . '" data-row="' . $row->id . '" class="btn removeRow btn-outline-danger"><i class="fa fa-fw fa-trash"></i></a>';

                    return $actions;
                })
                ->rawColumns(['actions','status'])
                ->make(true);
        }

        return view('backend.delivery_date',compact('weedays','days'));
    }

    public function saveWeekDay(Request $request)
    {
        WeekDaysModel::where('id',$request->weekId)->update(['status' => $request->statusValue]);
        return response()->json(['success' => true]);
    }

    public function removeDay(Request $request)
    {
        DeliveryDaysModel::where('id',$request->dayId)->delete();
        return response()->json(['success' => true]);
    }

    public function saveDate(Request $request)
    {
        if(!empty($request->day_date)){
            DeliveryDaysModel::insert(['day_date' => $request->day_date]);
        }
        return redirect()->back();
    }
}

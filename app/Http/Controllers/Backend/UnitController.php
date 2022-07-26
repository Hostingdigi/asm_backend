<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Unit;

class UnitController extends Controller
{
    protected $flashData = [
        'status' => 0,
        'message' => 'Something went wrong.Try again later.',
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Unit::select(['id', 'name', 'status'])
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
                        $actions = '<a href="javascript:void(0);" title="Lock" class="btn btn-outline-dark changeStatus" data-rowurl="' . route('admin.masters.units.updateStatus', [$row->id, 0]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-lock"></i></a> ';
                    } else if ($row->status == 0) {
                        $actions = '<a href="javascript:void(0);" title="Unlock" class="btn btn-outline-success changeStatus" data-rowurl="' . route('admin.masters.units.updateStatus', [$row->id, 1]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-unlock-alt"></i></a> ';
                    }

                    $actions .= '<a title="Update" data-href="' . route('admin.masters.units.edit', $row->id) . '" href="javascript:void(0)" class="btn btn-outline-info editRow"><i class="fa fa-fw fa-edit"></i></a> ';
                    $actions .= ' <a title="Delete" href="javascript:void(0);" data-rowurl="' . route('admin.masters.units.updateStatus', [$row->id, 2]) . '" data-row="' . $row->id . '" class="btn removeRow btn-outline-danger"><i class="fa fa-fw fa-trash"></i></a>';

                    return $actions;
                })
                ->rawColumns(['actions','status'])
                ->make(true);
        }

        return view('backend.units');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createClinic = Unit::create([
            'name' => trim($request->unit_name),
            'description' => ''
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been created.',
        ];

        $request->session()->flash('flashData', $this->flashData);

        return redirect()->route('admin.masters.units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'data' => Unit::select(['id', 'name'])->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $createClinic = Unit::where('id', $id)->update([
            'name' => trim($request->unit_name),
            'description' => '',
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been updated.',
        ];

        $request->session()->flash('flashData', $this->flashData);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request, $userId, $statusCode)
    {
        $result = Unit::where('id', trim($userId))
            ->update([
                'status' => trim($statusCode),
            ]);

        if ($result) {
            $this->flashData = [
                'status' => 1,
                'message' => $statusCode == 2 ? 'Successfully data has been removed' : 'Successfully status has been changed',
            ];

            $request->session()->flash('flashData', $this->flashData);
        }

        return response()->json([
            'status' => 1,
        ]);
    }

    public function checkDuplicate(Request $request)
    {
        $exists = true;

        $rowIdTrue = ($request->has('rowId') ? TRUE : FALSE);
        $rowId = ($request->has('rowId') ? trim($request->rowId) : '');

        if(Unit::where([
            ['name','=',trim($request->unit_name)],
            ['status','!=','2']
        ])
        ->when($rowIdTrue, function($query) use($rowId)
        {
            return $query->where('id','!=',$rowId);
        })
        ->count() > 0)
        {
            $exists = false;
        }
        return response()->json($exists);
    }
}

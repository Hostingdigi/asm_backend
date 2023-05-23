<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables, Str;
use App\Models\CommonDatas;

class DynamicPagesController extends Controller
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
            $users = CommonDatas::select(['id', 'key', 'value_1', 'value_3', 'status'])
                ->where('value_2','dynamic-page')
                ->bothInActive();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    return ucwords($row->value_3);
                })
                ->addColumn('content', function ($row) {
                    return '<a class="btn btn-sm btn-info text-white" data-tagret="">View</a>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '1') {
                        return '<b class="text-success">ACTIVE</b>';
                    } else if ($row->status == 0) {
                        return '<b>IN-ACTIVE</b>';
                    }
                    
                })
                ->addColumn('actions', function ($row) {
                    // if ($row->status == '1') {
                    //     $actions = '<a href="javascript:void(0);" title="Lock" class="btn btn-outline-dark changeStatus" data-rowurl="' . route('admin.masters.brands.updateStatus', [$row->id, 0]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-lock"></i></a> ';
                    // } else if ($row->status == 0) {
                    //     $actions = '<a href="javascript:void(0);" title="Unlock" class="btn btn-outline-success changeStatus" data-rowurl="' . route('admin.masters.brands.updateStatus', [$row->id, 1]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-unlock-alt"></i></a> ';
                    // }

                    $actions = '<a title="Update" data-href="' . route('admin.settings.mobile-application.dynamicPages.edit', $row->id) . '" href="javascript:void(0)" class="btn btn-outline-info editRow"><i class="fa fa-fw fa-edit"></i></a> ';
                    $actions .= ' <a title="Delete" href="javascript:void(0);" data-rowurl="' . route('admin.settings.mobile-application.dynamicPages.updateStatus', [$row->id, 2]) . '" data-row="' . $row->id . '" class="btn removeRow btn-outline-danger"><i class="fa fa-fw fa-trash"></i></a>';

                    return $actions;
                })
                ->rawColumns(['actions','status','content'])
                ->make(true);
        }

        return view('backend.brands');
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
        $slug = Str::slug($request->title);
        $slugCount = CommonDatas::where('key', $slug)->count();
        $slug .= ($slugCount > 0 ? '-'.$slugCount: '');

        CommonDatas::create([
            'key' => trim($slug),
            'value_1' => trim($request->dynamic_cnt),
            'value_3' => trim($request->title),
            'value_2' => 'dynamic-page',
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been created.',
        ];
        $request->session()->flash('flashData', $this->flashData);
        return redirect()->route('admin.settings.mobile-application',['tab'=>'dynamic_pages']);
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
            'url' => route('admin.settings.mobile-application.dynamicPages.update',$id),
            'data' => CommonDatas::find($id)
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
        $slug = Str::slug($request->title);
        $slugCount = CommonDatas::where('key', $slug)->count();
        $slug .= ($slugCount > 0 ? '-'.$slugCount: '');

        CommonDatas::where('id',$id)->update([
            'key' => trim($slug),
            'value_1' => trim($request->dynamic_cnt),
            'value_3' => trim($request->title),
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been updated.',
        ];
        $request->session()->flash('flashData', $this->flashData);
        return redirect()->route('admin.settings.mobile-application',['tab'=>'dynamic_pages']);
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
        $result = CommonDatas::where('id', trim($userId))
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
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CommonDatas;
use App\Models\Product;
use DataTables;
use Illuminate\Http\Request;
use Storage;

class SettingsController extends Controller
{
    protected $flashData = [
        'status' => 0,
        'message' => 'Something went wrong.Try again later.',
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = CommonDatas::select(['id', 'value_1', 'value_2', 'value_3', 'status'])->where('key','app-homepage-banner')
                ->orderBy('value_4', 'asc')->bothInActive();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('red_screen', function ($row) {
                    return ucwords($row->value_2);
                })
                ->addColumn('image', function ($row) {
                    return !empty($row->value_1) ? '<img class="img-thumbnail" width="75" height="75" src="' . Storage::url($row->value_1) . '" >' : '';
                })
                ->addColumn('resource', function ($row) {
                    if (!empty($row->value_2) && !empty($row->value_3)) {
                        $data = $this->getResourceData($row->value_2,['id' => $row->value_3]);
                    }
                    return $data[0]['name'] ?? '';
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
                        $actions = '<a href="javascript:void(0);" title="Lock" class="btn btn-outline-dark changeStatus" data-rowurl="' . route('admin.settings.application-data.updateStatus', [$row->id, 0]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-lock"></i></a> ';
                    } else if ($row->status == 0) {
                        $actions = '<a href="javascript:void(0);" title="Unlock" class="btn btn-outline-success changeStatus" data-rowurl="' . route('admin.settings.application-data.updateStatus', [$row->id, 1]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-unlock-alt"></i></a> ';
                    }

                    $actions .= '<a title="Update" data-href="' . route('admin.settings.application-data.edit', $row->id) . '" href="javascript:void(0)" class="btn btn-outline-info editRow"><i class="fa fa-fw fa-edit"></i></a> ';
                    $actions .= ' <a title="Delete" href="javascript:void(0);" data-rowurl="' . route('admin.settings.application-data.updateStatus', [$row->id, 2]) . '" data-row="' . $row->id . '" class="btn removeRow btn-outline-danger"><i class="fa fa-fw fa-trash"></i></a>';

                    return $actions;
                })
                ->rawColumns(['actions', 'status', 'image'])
                ->make(true);
        }

        return view('backend.settings');
    }

    public function storeBanner(Request $request)
    {
        $imageName = $request->has('banner_image') ? Storage::put('images', $request->banner_image) : null;
        CommonDatas::create([
            'key' => 'app-homepage-banner',
            'value_1' => $imageName,
            'value_2' => !empty($request->red_screen) ? $request->red_screen : null,
            'value_3' => !empty($request->resource) ? $request->resource : null,
            'value_4' => !empty($request->sorting) ? $request->sorting : CommonDatas::where('key', 'app-homepage-banner')->count() + 1,
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been created.',
        ];
        $request->session()->flash('flashData', $this->flashData);
        return redirect()->route('admin.settings.application-data');
    }

    public function getResourceData($screen, $resourceId = null)
    {
        $selectData = ['id', 'name'];
        $resourceId = $resourceId ?? [['id','!=',null]];
        switch ($screen) {
            case 'category':
                $data = Category::select($selectData)->where($resourceId)->activeOnly();
                break;
            case 'product':
                $data = Product::select($selectData)->where($resourceId)->activeOnly();
                break;
            case 'coupon':
                $data = [];
                break;
            case 'referral':
                $data = [];
                break;
            default:
                $data = [];
                break;
        }
        return $data;
    }

    public function getResource(Request $request)
    {
        return returnApiResponse(true, '', $this->getResourceData($request->screen));
    }

    public function editData(Request $request, $rowId)
    {
        $data = CommonDatas::select(['id', 'value_1 as image', 'value_2 as red_screen','value_3 as resource','value_4 as sorting'])->find($rowId);
        if ($data) {
            $data->image = Storage::url($data->image);
            $data->resourceList = $this->getResourceData($data->red_screen);
        }
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function updateData(Request $request)
    {
        $data = CommonDatas::find($request->updId);
        $imageName = $request->has('banner_image') ? Storage::put('images', $request->banner_image) : $data->value_1;
        CommonDatas::where('id',$request->updId)->update([
            'value_1' => $imageName,
            'value_2' => !empty($request->red_screen) ? $request->red_screen : null,
            'value_3' => !empty($request->resource) ? $request->resource : null,
            'value_4' => !empty($request->sorting) ? $request->sorting : $data->value_4,
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been updated.',
        ];
        $request->session()->flash('flashData', $this->flashData);
        return redirect()->route('admin.settings.application-data');
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

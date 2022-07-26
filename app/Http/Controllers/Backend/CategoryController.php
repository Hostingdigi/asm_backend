<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DataTables;
use Illuminate\Http\Request;
use Storage;

class CategoryController extends Controller
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
            $users = Category::select(['id', 'parent_id', 'name', 'image', 'banner_image', 'status'])->orderBy('id','desc')
                ->bothInActive();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('parent', function ($row) {
                    return !empty($row->parent_id) ? ucwords(Category::find($row->parent_id)->name) : '-';
                })
                ->addColumn('name', function ($row) {
                    return ucwords($row->name);
                })
                ->addColumn('image', function ($row) {
                    return !empty($row->image) ? '<img class="img-thumbnail" width="75" height="75" src="' . Storage::url($row->image) . '" >' : '';
                })
                ->addColumn('banner_image', function ($row) {
                    return !empty($row->banner_image) ? '<img class="img-thumbnail" width="75" height="75" src="' . Storage::url($row->banner_image) . '" >' : '';
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
                        $actions = '<a href="javascript:void(0);" title="Lock" class="btn btn-outline-dark changeStatus" data-rowurl="' . route('admin.masters.categories.updateStatus', [$row->id, 0]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-lock"></i></a> ';
                    } else if ($row->status == 0) {
                        $actions = '<a href="javascript:void(0);" title="Unlock" class="btn btn-outline-success changeStatus" data-rowurl="' . route('admin.masters.categories.updateStatus', [$row->id, 1]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-unlock-alt"></i></a> ';
                    }

                    $actions .= '<a title="Update" data-href="' . route('admin.masters.categories.edit', $row->id) . '" href="javascript:void(0)" class="btn btn-outline-info editRow"><i class="fa fa-fw fa-edit"></i></a> ';
                    $actions .= ' <a title="Delete" href="javascript:void(0);" data-rowurl="' . route('admin.masters.categories.updateStatus', [$row->id, 2]) . '" data-row="' . $row->id . '" class="btn removeRow btn-outline-danger"><i class="fa fa-fw fa-trash"></i></a>';

                    return $actions;
                })
                ->rawColumns(['actions', 'status', 'image','banner_image'])
                ->make(true);
        }

        $parent = Category::select(['id', 'name', 'status'])->where('parent_id', 0)
            ->bothInActive();
        return view('backend.categories', ['parent' => $parent]);
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
        $imageName = $bannerImage = '';
        if ($request->has('category_image')) {
            $imageName = Storage::put('images', $request->category_image);
        }

        if ($request->has('banner_image')) {
            $bannerImage = Storage::put('images', $request->banner_image);
        }

        $createClinic = Category::create([
            'parent_id' => !empty($request->parent) ? $request->parent : 0,
            'name' => trim($request->category_name),
            'long_name' => trim($request->long_name),
            'image' => $imageName,
            'banner_image' => $bannerImage,
            'description' => '',
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been created.',
        ];

        $request->session()->flash('flashData', $this->flashData);

        return redirect()->route('admin.masters.categories.index');
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
        $data = Category::select(['id', 'parent_id', 'name', 'long_name', 'image', 'banner_image'])->find($id);
        $data->image = !empty($data->image) ? asset('storage/'.$data->image) : '';
        $data->banner_image = !empty($data->banner_image) ? asset('storage/'.$data->banner_image) : '';
        return response()->json([
            'data' => $data
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
        $currentDetails = Category::find($id);

        $oldImageName = $currentDetails->image;
        $bannerImage = $currentDetails->banner_image;

        if ($request->has('category_image') && !empty($request->category_image)) {
            $imageName = Storage::put('images', $request->category_image);
            if (!empty($oldImageName) && !Storage::missing($oldImageName)) {
                Storage::delete($oldImageName);
            }
        } else {
            $imageName = $oldImageName;
        }

        if ($request->has('banner_image') && !empty($request->banner_image)) {
            $bannerImageName = Storage::put('images', $request->banner_image);
            if (!empty($bannerImage) && !Storage::missing($bannerImage)) {
                Storage::delete($bannerImage);
            }
        } else {
            $bannerImageName = $bannerImage;
        }

        $createClinic = Category::where('id', $id)->update([
            'parent_id' => !empty($request->parent) ? $request->parent : 0,
            'name' => trim($request->category_name),
            'long_name' => trim($request->long_name),
            'image' => $imageName,
            'banner_image' => $bannerImageName,
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
        $result = Category::where('id', trim($userId))
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

        $rowIdTrue = ($request->has('rowId') ? true : false);
        $rowId = ($request->has('rowId') ? trim($request->rowId) : '');

        if (Category::where([
            ['name', '=', trim($request->category_name)],
            ['status', '!=', '2'],
        ])
            ->when($rowIdTrue, function ($query) use ($rowId) {
                return $query->where('id', '!=', $rowId);
            })
            ->count() > 0) {
            $exists = false;
        }
        return response()->json($exists);
    }
}

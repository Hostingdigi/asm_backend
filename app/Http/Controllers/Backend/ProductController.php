<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Domains\Auth\Models\User, 
App\Models\Brand, App\Models\Unit, App\Models\ProductVariant, App\Models\Category, App\Models\Product;

class ProductController extends Controller
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
            $users = Product::latest()->bothInActive();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return !empty($row->category_id) ? ucwords(Category::find($row->category_id)->name) : '-';
                })
                ->addColumn('name', function ($row) {
                    return ucwords($row->name);
                })
                ->addColumn('image', function ($row) {
                    return !empty($row->cover_image) ? '<img width="65" height="65" src="'.url('img/'.$row->cover_image).'">' : '';
                })
                ->addColumn('varants', function ($row)  {
                    return $row->variants->count();
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
                        $actions = '<a href="javascript:void(0);" title="Lock" class="btn btn-outline-dark changeStatus" data-rowurl="' . route('admin.products.updateStatus', [$row->id, 0]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-lock"></i></a> ';
                    } else if ($row->status == 0) {
                        $actions = '<a href="javascript:void(0);" title="Unlock" class="btn btn-outline-success changeStatus" data-rowurl="' . route('admin.products.updateStatus', [$row->id, 1]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-unlock-alt"></i></a> ';
                    }

                    $actions .= '<a title="Update" href="' . route('admin.products.edit', $row->id) . '" class="btn btn-outline-info"><i class="fa fa-fw fa-edit"></i></a> ';
                    $actions .= ' <a title="Delete" href="javascript:void(0);" data-rowurl="' . route('admin.products.updateStatus', [$row->id, 2]) . '" data-row="' . $row->id . '" class="btn removeRow btn-outline-danger"><i class="fa fa-fw fa-trash"></i></a>';

                    return $actions;
                })
                ->rawColumns(['actions','status', 'image'])
                ->make(true);
        }

        return view('backend.products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sup = User::select(['id', 'name'])->role('supplier')->activeOnly();
        $brand = Brand::select(['id', 'name'])->activeOnly();
        $category = Category::select(['id', 'name'])->activeOnly();
        $units = Unit::select(['id', 'name'])->activeOnly();

        return view('backend.product_create',[
            'sup' => $sup,
            'brand'=> $brand,
            'units'=> $units,
            'category'=> $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productVariants = [];
        

        $coverImage = '';
        if ($request->hasFile('pro_image')) {
            $destinationPath = 'img/';
            $files = $request->file('pro_image'); // will get all files                   
            $coverImage = $files->getClientOriginalName(); //Get file original name
            $files->move($destinationPath , $coverImage); // move files to destination folder
            $ext = $files->getClientOriginalExtension();
        }

        $createClinic = Product::create([
            'code' => !empty($request->pro_code) ? $request->pro_code : '',
            'user_id' => $request->sup,
            'category_id' => $request->category,
            'brand_id' => !empty($request->brand) ? $request->brand : 1,
            'name' => trim($request->pro_name),
            'cover_image' => $coverImage,
            'description' => !empty($request->pro_desc) ? $request->pro_desc : '',
        ]);

        $productId = $createClinic->id;

        for($i=1;$i<=$request->var_rows;$i++){
            if($request->has('var_name_'.$i))
            {
                array_push($productVariants,[
                    'product_id' => $productId,
                    'name' => $request->input('var_name_'.$i),
                    'unit_id' => $request->input('var_unit_'.$i),
                    'price' => $request->input('var_price_'.$i),
                ]);
            }
        }

        ProductVariant::insert($productVariants);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been created.',
        ];

        $request->session()->flash('flashData', $this->flashData);

        return redirect()->route('admin.products.index');
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
        $sup = User::select(['id', 'name'])->role('supplier')->activeOnly();
        $brand = Brand::select(['id', 'name'])->activeOnly();
        $category = Category::select(['id', 'name'])->activeOnly();
        $product = Product::find($id);
        $units = Unit::select(['id', 'name'])->activeOnly();

        return view('backend.product_edit',[
            'sup' => $sup,
            'product' => $product,
            'units'=> $units,
            'brand'=> $brand,
            'category'=> $category,
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
        $currentProd = Product::find($id);

        $coverImage = trim($currentProd->cover_image);
        if ($request->hasFile('pro_image')) {
            $destinationPath = 'img/';
            $files = $request->file('pro_image'); // will get all files                   
            $coverImage = $files->getClientOriginalName(); //Get file original name
            $files->move($destinationPath , $coverImage); // move files to destination folder
            $ext = $files->getClientOriginalExtension();
            if(!empty($currentProd->cover_image)){
            unlink('img/'.$currentProd->cover_image);
            }
        }

        $createClinic = Product::where('id',$id)->update([
            'code' => !empty($request->pro_code) ? $request->pro_code : '',
            'category_id' => $request->category,
            'brand_id' => !empty($request->brand) ? $request->brand : 0,
            'name' => trim($request->pro_name),
            'cover_image' => $coverImage,
            'description' => !empty($request->pro_desc) ? $request->pro_desc : '',
        ]);

        ProductVariant::create($productVariants);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been created.',
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
        $result = Product::where('id', trim($userId))
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

        if(Product::where([
            ['name','=',trim($request->pro_name)],
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

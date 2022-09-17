<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Unit;
use DataTables;
use Illuminate\Http\Request;
use Storage;

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
                    return !empty($row->cover_image) ? '<img class="img-thumbnail" width="75" height="75" src="' . url('storage/'.$row->cover_image) . '">' : '';
                })
                ->addColumn('varants', function ($row) {
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
                ->rawColumns(['actions', 'status', 'image'])
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

        return view('backend.product_create', [
            'sup' => $sup,
            'brand' => $brand,
            'units' => $units,
            'category' => $category,
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

        if($request->hasFile('add_image') && count($request->add_image)>0)
        {
            foreach ($request->add_image as $key => $file) {
                echo $file->getClientOriginalName().' - ';
            }
        }

        $coverImage = $request->hasFile('pro_image') ? Storage::put('images',$request->file('pro_image')) : '';

        $createClinic = Product::create([
            'code' => !empty($request->pro_code) ? $request->pro_code : '',
            'user_id' => $request->sup,
            'category_id' => $request->category,
            'brand_id' => !empty($request->brand) ? $request->brand : null,
            'name' => trim($request->pro_name),
            'cover_image' => $coverImage,
            'description' => !empty($request->pro_desc) ? $request->pro_desc : '',
        ]);

        $productId = $createClinic->id;

        for ($i = 1; $i <= $request->var_rows; $i++) {
            if ($request->has('var_name_' . $i)) {
                array_push($productVariants, [
                    'product_id' => $productId,
                    'name' => $request->input('var_name_' . $i),
                    'unit_id' => $request->input('var_unit_' . $i),
                    'price' => $request->input('var_price_' . $i),
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
        $vars = $product->variants()->where('status', '!=', '2')->get();
        $addImages = $product->images()->orderBy('display_order','asc')->get();

        return view('backend.product_edit', [
            'sup' => $sup,
            'product' => $product,
            'units' => $units,
            'brand' => $brand,
            'category' => $category,
            'vars' => $vars,
            'addImages' => $addImages
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
        $productVariants = [];

        $variantIds = [];
        for ($i = 1; $i <= $request->var_rows; $i++) {
            if (!empty($request->input('row_id_' . $i))) {array_push($variantIds, $request->input('row_id_' . $i));}
        }

        $coverImage = $oldImageName = trim($currentProd->cover_image);
        if ($request->hasFile('pro_image')) {
            $coverImage = Storage::put('images',$request->pro_image);
            if (!empty($oldImageName) && !Storage::missing($oldImageName)) {
                Storage::delete($oldImageName);
            }
        }

        $createClinic = Product::where('id', $id)->update([
            'code' => !empty($request->pro_code) ? $request->pro_code : '',
            'category_id' => $request->category,
            'brand_id' => !empty($request->brand) ? $request->brand : null,
            'name' => trim($request->pro_name),
            'cover_image' => $coverImage,
            'description' => !empty($request->pro_desc) ? $request->pro_desc : '',
        ]);

        $productId = $id;

        ProductVariant::whereNotIn('id', $variantIds)->where('product_id', $id)->update(['status' => '2']);

        for ($i = 1; $i <= $request->var_rows; $i++) {

            if ($request->has('var_name_' . $i)) {
                if ($request->has('row_id_' . $i)) {
                    ProductVariant::where('id', $request->input('row_id_' . $i))->update([
                        'name' => $request->input('var_name_' . $i),
                        'unit_id' => $request->input('var_unit_' . $i),
                        'price' => $request->input('var_price_' . $i),
                    ]);
                } else {
                    ProductVariant::insert([
                        'product_id' => $productId,
                        'name' => $request->input('var_name_' . $i),
                        'unit_id' => $request->input('var_unit_' . $i),
                        'price' => $request->input('var_price_' . $i),
                    ]);
                }
            }
        }

        //upload additinal images
        if($request->hasFile('add_image') && count($request->add_image)>0)
        {
            foreach ($request->add_image as $key => $file) {
                ProductImage::create([
                    'product_id' => $id,
                    'file_name' => Storage::put('images',$file),
                    'display_order' => 1,
                ]);
            }
        }

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

    public function updateVariantStatus(Request $request)
    {
        ProductVariant::where([['id', '=', $request->variant], ['product_id', '=', $request->productId]])
            ->update(['status' => $request->status]);

        return response()->json([
            'status' => 1,
            'message' => 'Successfully status has been changed',
        ]);
    }

    public function checkDuplicate(Request $request)
    {
        $exists = true;

        $rowIdTrue = ($request->has('rowId') ? true : false);
        $rowId = ($request->has('rowId') ? trim($request->rowId) : '');

        if (Product::where([
            ['name', '=', trim($request->pro_name)],
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

    public function removeProImage(Request $request)
    {
        $image = ProductImage::where([
            ['id','=',$request->variant],
            ['product_id','=',$request->productId],
        ])->first();

        if (!empty($image->file_name) && !Storage::missing($image->file_name)) {
            Storage::delete($image->file_name);
        }

        $image->delete();

        return response()->json(['message' => 'Successfully image has been removed.']);
    }

    public function updateDisplayProImage(Request $request)
    {
        ProductImage::where([
            ['id','=',$request->variant],
            ['product_id','=',$request->productId],
        ])->update([
            'display_order' => $request->display
        ]);

        return response()->json(['message' => 'Successfully display order has been updated.']);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use DataTables;
use Illuminate\Http\Request;
use Storage;

class CouponsController extends Controller
{

    protected $flashData = [
        'status' => 0,
        'message' => 'Something went wrong.Try again later.',
    ];

    protected $couponTypes = [
        'common' => 'Common',
        'category' => 'Category Based',
        'supplier' => 'Supplier Based',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Coupon::where('nature','!=','referral')->latest()->bothInActive();

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('validity', function ($row) {
                    return \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') . ' - ' .
                    \Carbon\Carbon::parse($row->end_date)->format('d-m-Y');
                })
                ->addColumn('code', function ($row) {
                    return '<b>' . $row->code . '</b>';
                })
                ->addColumn('offer_value', function ($row) {
                    $amount = $row->coupon_type == 'amount' ? 'SGD ' : '';
                    $percentage = $row->coupon_type == 'percentage' ? ' %' : '';

                    return '<b>' . $amount . $row->offer_value . $percentage . '</b>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '1') {
                        return '<b class="text-success">ACTIVE</b>';
                    } else if ($row->status == 0) {
                        return '<b>IN-ACTIVE</b>';
                    }

                })
                ->addColumn('actions', function ($row) {
                    if ($row->nature == 'referral') {
                        $actions = '<a title="Update" href="' . route('admin.coupons.edit', $row->id) . '" class="btn btn-outline-info"><i class="fa fa-fw fa-eye"></i></a> ';
                    } else {
                        $actions = $row->status == '1' ? '<a href="javascript:void(0);" title="Lock" class="btn btn-outline-dark changeStatus" data-rowurl="' . route('admin.coupons.updateStatus', [$row->id, 0]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-lock"></i></a> ' :
                        '<a href="javascript:void(0);" title="Unlock" class="btn btn-outline-success changeStatus" data-rowurl="' . route('admin.coupons.updateStatus', [$row->id, 1]) . '" data-row="' . $row->id . '"><i class="fa fa-fw fa-unlock-alt"></i></a> ';

                        $actions .= '<a title="Update" href="' . route('admin.coupons.edit', $row->id) . '" class="btn btn-outline-info"><i class="fa fa-fw fa-edit"></i></a> ';
                        $actions .= ' <a title="Delete" href="javascript:void(0);" data-rowurl="' . route('admin.coupons.updateStatus', [$row->id, 2]) . '" data-row="' . $row->id . '" class="btn removeRow btn-outline-danger"><i class="fa fa-fw fa-trash"></i></a>';
                    }
                    return $actions;
                })
                ->rawColumns(['actions', 'status', 'offer_value', 'code'])
                ->make(true);
        }
        return view('backend.coupons');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $supplier = User::role('supplier')->activeOnly();
        $category = Category::select(['id', 'name'])->activeOnly();

        if ($request->ajax()) {
            return response()->json([
                'data' => Category::select(['id', 'name'])->whereIn('id', Product::select(['category_id'])->where('user_id', $request->supplier)->groupBy('category_id')->activeOnly()->pluck(['category_id'])->all())->activeOnly(),
            ]);
        }
        $couponTypes = $this->couponTypes;

        return view('backend.coupon_create', compact('supplier', 'category', 'couponTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Coupon::create([
            'coupon_type' => $request->coupon_type,
            'title' => $request->title,
            'code' => $request->cup_code,
            'offer_value' => $request->off_value,
            'description' => $request->pro_desc,
            'start_date' => $request->sdate,
            'end_date' => $request->edate,
            'image' => $request->has('image') ? Storage::put('images', $request->image) : '',
            'vendor_customization' => serialize([
                'coupon_for' => $request->coupon_for,
                'category' => $request->has('off_cat') ? $request->off_cat : '',
                'vendor' => [
                    'id' => $request->has('off_sup') ? $request->off_sup : '',
                    'category' => $request->has('off_sup_cat') ? $request->off_sup_cat : '',
                ],
            ]),
        ]);

        $this->flashData = [
            'status' => 1,
            'message' => 'Successfully data has been created.',
        ];
        $request->session()->flash('flashData', $this->flashData);

        return redirect()->route('admin.coupons.index');

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
    public function edit(Request $request, $id)
    {
        $data = Coupon::find($id);

        $supplier = User::role('supplier')->activeOnly();
        $category = Category::select(['id', 'name'])->activeOnly();

        if ($request->ajax()) {
            return response()->json([
                'data' => Category::select(['id', 'name'])->whereIn('id', Product::select(['category_id'])->where('user_id', $request->supplier)->groupBy('category_id')->activeOnly()->pluck(['category_id'])->all())->activeOnly(),
            ]);
        }

        if ($data->nature == 'referral') {
            $vendorCustomization = [
                'coupon_for' => 'referral'
            ];
            $couponTypes = $supplierCategory = [];
        } else {

            $vendorCustomization = unserialize($data->vendor_customization);
            $couponTypes = $this->couponTypes;
            $supplierCategory = $vendorCustomization['coupon_for'] == 'supplier' && !empty($vendorCustomization['vendor']['id']) ?
            Category::select(['id', 'name'])->whereIn('id', Product::select(['category_id'])->where('user_id', $vendorCustomization['vendor']['id'])->groupBy('category_id')->activeOnly()->pluck(['category_id'])->all())->activeOnly() : [];
        }

        return view('backend.coupon_edit', compact('supplier', 'category', 'data', 'vendorCustomization', 'couponTypes', 'supplierCategory'));
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
        $data = Coupon::find($id);
        $image = $data->image;
        Coupon::where('id', $id)->update([
            'coupon_type' => $request->coupon_type,
            'title' => $request->title,
            'code' => $request->cup_code,
            'offer_value' => $request->off_value,
            'description' => $request->pro_desc,
            'start_date' => $request->sdate,
            'end_date' => $request->edate,
            'image' => $request->has('image') ? Storage::put('images', $request->image) : $image,
            'vendor_customization' => serialize([
                'coupon_for' => $request->coupon_for,
                'category' => $request->has('off_cat') ? $request->off_cat : '',
                'vendor' => [
                    'id' => $request->has('off_sup') ? $request->off_sup : '',
                    'category' => $request->has('off_sup_cat') ? $request->off_sup_cat : '',
                ],
            ]),
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

    public function checkDuplicate(Request $request)
    {
        $exists = true;

        $rowIdTrue = ($request->has('rowId') ? true : false);
        $rowId = ($request->has('rowId') ? trim($request->rowId) : '');

        if (Coupon::where([
            ['status', '!=', '2'],
        ])->whereRaw("LOWER(code) = '" . trim(strtolower($request->cup_code)) . "'")
            ->when($rowIdTrue, function ($query) use ($rowId) {
                return $query->where('id', '!=', $rowId);
            })
            ->count() > 0) {
            $exists = false;
        }
        return response()->json($exists);
    }

    public function updateStatus(Request $request, $userId, $statusCode)
    {
        $result = Coupon::where('id', trim($userId))
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

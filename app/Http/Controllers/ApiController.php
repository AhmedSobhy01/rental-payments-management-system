<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\ActivityLog;
use App\Models\DueCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ApiController extends Controller
{
    protected $censor_length = 6;

    public function __construct(Request $request)
    {
        if ($request->has('lang')) LaravelLocalization::setLocale($request->lang);
    }

    protected function checkString($string)
    {
        return isset($string) && !empty($string);
    }

    public function translations(Request $request)
    {
        if ($request->has('lang')) App::setLocale($request->lang);

        $translations = [
            "Welcome" => __("app.Welcome"),
            "Please choose a tenant" => __("app.Please choose a tenant"),
            "Choose a tenant" => __("app.Choose a tenant"),
            "Get Data" => __("app.Get Data"),
            "Tenant Information" => __("app.Tenant Information"),
            "Name" => __("app.Name"),
            "Email Address" => __("app.Email Address"),
            "Phone Number" => __("app.Phone Number"),
            "Birthday" => __("app.Birthday"),
            "Nationality" => __("app.Nationality"),
            "National Card Number" => __("app.National Card Number"),
            "Passport Number" => __("app.Passport Number"),
            "Marital Status" => __("app.Marital Status"),
            "Contracts" => __("app.Contracts"),
            "Ended" => __("app.Ended"),
            "Rent Amount" => __("app.Rent Amount"),
            "Duration" => __("app.Duration"),
            "Address" => __("app.Address"),
            "Building Number" => __("app.Building Number"),
            "Floor" => __("app.Floor"),
            "Apartment" => __("app.Apartment"),
            "Nothing found" => __("app.Nothing found"),
            "Dues" => __("app.Dues"),
            "Summary" => __("app.Summary"),
            "Total Unpaid Dues" => __("app.Total Unpaid Dues"),
            "Total Paid Dues" => __("app.Total Paid Dues"),
            "Unpaid Dues" => __("app.Unpaid Dues"),
            "Amount Left" => __("app.Amount Left"),
            "Paid Amount" => __("app.Paid Amount"),
            "Amount After Discount" => __("app.Amount After Discount"),
            "Amount" => __("app.Amount"),
            "Discount" => __("app.Discount"),
            "Category" => __("app.Category"),
            "Note" => __("app.Note"),
            "Created At" => __("app.Created At"),
            "Paid Dues" => __("app.Paid Dues"),
        ];

        return response_ok_with_data($translations);
    }

    public function tenants(Request $request)
    {
        if ($request->has('lang')) App::setLocale($request->lang);

        $tenants = Tenant::select('id', 'name')->get()->map(function ($v) {
            return [
                'id' => $v->id,
                'name' => $v->name,
            ];
        });

        return response_ok_with_data($tenants);
    }

    public function tenant(Request $request)
    {
        $request->validate([
            'tenant' => 'required|integer|exists:tenants,id',
        ]);

        $dues_categories = DueCategory::all();

        $tenant = Tenant::with([
            'contracts' => fn ($q) => $q->latest('start_date'),
            'nationality',
            'dues' => fn ($q) => $q->latest()
        ])
            ->withCount([
                'dues AS total_unpaid_dues_amount' => fn ($q) => $q->select(DB::raw('(SUM(amount) - SUM(paid_amount) - SUM(discount)) / 100')),
                'dues AS total_paid_dues_amount' => fn ($q) => $q->select(DB::raw('SUM(paid_amount) / 100')),
            ])
            ->where('id', $request->tenant)
            ->get()
            ->map(function ($v) use ($dues_categories) {
                return [
                    'name' => $v->name,
                    'email' => Str::mask($v->email, '*', 8),
                    'phone' => Str::mask($v->phone, '*', 8),
                    'birthday' => $v->birthday,
                    'nationality' => $v->nationality->name,
                    'national_card_no' => Str::mask($v->national_card_no, '*', 8),
                    'passport_no' => Str::mask($v->passport_no, '*', 8),
                    'marital_status' => $v->married ? __('app.Married') : __('app.Not Married'),
                    'unpaid_dues_count' => $v->dues->filter(fn ($v) => $v->amount != ($v->paid_amount + $v->discount))->count(),
                    'total_unpaid_dues_amount' => formatCurrency($v->total_unpaid_dues_amount),
                    'total_paid_dues_amount' => formatCurrency($v->total_paid_dues_amount),
                    'dues_by_category' => $dues_categories->map(function ($x) use ($v) {
                        return [
                            'name' => $x->name,
                            'total_unpaid' => formatCurrency($v->dues->filter(fn ($v) => ($v->amount_left > 0) && $v->due_category_id == $x->id)->sum('amount_left')),
                        ];
                    }),
                    'contracts' => $v->contracts->map(function ($v) {
                        return [
                            'valid' => now() < $v->end_date,
                            'title' => dateDiff(now(), $v->end_date),
                            'start_date' => formatDate($v->start_date),
                            'end_date' => formatDate($v->end_date),
                            'duration' => $v->duration . ' ' . __('app.years'),
                            'rent_amount' => formatCurrency($v->rent_amount),
                            'address' => $v->apartment->building->address,
                            'building_no' => $v->apartment->building->number,
                            'floor' => $v->apartment->floor,
                            'apartment' => $v->apartment->number,
                        ];
                    }),
                    'dues' => [
                        "unpaid" => $v->dues->filter(fn ($v) => !$v->status)->map(function ($v) {
                            return [
                                'amount' => formatCurrency($v->amount),
                                'amount_with_discount' => formatCurrency($v->amount_with_discount),
                                'amount_left' => formatCurrency($v->amount_left),
                                'paid_amount' => formatCurrency($v->paid_amount),
                                'discount' => formatCurrency($v->discount),
                                'note' => $this->checkString($v->note) ? $v->note : "-",
                                'status' => $v->status,
                                'status_name' => $v->status ? __('app.Paid') : __('app.Unpaid'),
                                'created_at' => formatDateTime($v->created_at),
                                'category' => $v->category->name,
                            ];
                        }),
                        "paid" => $v->dues->filter(fn ($v) => $v->status)->map(function ($v) {
                            return [
                                'amount' => formatCurrency($v->amount),
                                'amount_with_discount' => formatCurrency($v->amount_with_discount),
                                'amount_left' => formatCurrency($v->amount_left),
                                'paid_amount' => formatCurrency($v->paid_amount),
                                'discount' => formatCurrency($v->discount),
                                'note' => $this->checkString($v->note) ? $v->note : "-",
                                'status' => $v->status,
                                'status_name' => $v->status ? __('app.Paid') : __('app.Unpaid'),
                                'created_at' => formatDateTime($v->created_at),
                                'category' => $v->category->name,
                            ];
                        }),
                    ],
                ];
            })
            ->first();

        if (!$tenant) return response_not_found();

        ActivityLog::create([
            'agent' => $request->userAgent(),
            'ip' => $request->ip(),
            'tenant_id' => $request->tenant,
            'user_id' => auth()->id(),
        ]);

        return response_ok_with_data($tenant);
    }
}
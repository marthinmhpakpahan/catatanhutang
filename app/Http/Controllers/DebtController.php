<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Debt;
use App\Models\Debter;
use App\Models\User;

class DebtController extends Controller
{
    public function index(Request $request) {
        if(!Auth::check()) {
            return redirect('/user/login');
        }

        if($request->method() == "GET") {
            $auth_username = Auth::user()->fullname;
            $user_id = Auth::id();
            $count_paid = Debt::where("user_id", $user_id)->where("status", 1)->sum('total');
            $count_debt_paid = Debt::where("user_id", $user_id)->where("status", 1)->count();
            $count_debt_unpaid = Debt::where("user_id", $user_id)->where("status", 0)->count();
            $count_debt_total = Debt::where("user_id", $user_id)->sum('total');
            $count_debter = Debter::where("user_id", $user_id)->count();

            $debts = Debt::where("user_id", Auth::id())->get();

            return view('debt.index', [
                "title" => "Catatan Hutang - List Debter",
                "username" => $auth_username,
                "debts" => $debts,
                "dashboard" => [
                    "count_paid" => $count_paid,
                    "count_debt_paid" => $count_debt_paid,
                    "count_debt_unpaid" => $count_debt_unpaid,
                    "count_debt_total" => $count_debt_total,
                    "count_debter" => $count_debter
                ]
            ]);
        } else {
        }
    }

    public function create(Request $request) {
        if(!Auth::check()) {
            return redirect('/user/login');
        }
        
        $user_id = Auth::id();
        if($request->method() == "GET") {            
            $auth_username = Auth::user()->fullname;
            $user_id = Auth::id();
            $debters = Debter::where("user_id", $user_id)->get();

            return view('debt.create', [
                "title" => "Catatan Hutang - Create New Debt",
                "username" => $auth_username,
                "debters" => $debters
            ]);
        } else {
            $debter_id = 0;
            if($request->debter_data == "create_new") {
                $credentials = $request->validate([
                    'debter_data' => 'required',
                    'total' => 'required',
                    'remarks' => 'required',
                    'debter_name' => 'required',
                    'debter_photo' => 'required',
                    'debter_description' => 'required'
                ]); 
                $debter_id = Debter::create([
                    "user_id" => $user_id,
                    "fullname" => $request->debter_name,
                    "photo" => CommonFunctions::uploadFiles($request->file('debter_photo'), "DEBTER_PHOTO"),
                    "description" => $request->debter_description
                ])->id;

                if($debter_id) {
                    $result = Debt::create([
                        "user_id" => $user_id,
                        "debter_id" => $debter_id,
                        "total" => $request->total,
                        "status" => false,
                        "remarks" => $request->remarks
                    ]);

                    return redirect('/debt')->with('success', 'Berhasil menambahkan hutang baru!');
                }
            } else {
                $credentials = $request->validate([
                    'debter_data' => 'required',
                    'total' => 'required',
                    'remarks' => 'required'
                ]);

                $result = Debt::create([
                    "user_id" => $user_id,
                    "debter_id" => $request->debter_data,
                    "total" => $request->total,
                    "status" => false,
                    "remarks" => $request->remarks
                ]);

                return redirect('/debt')->with('success', 'Berhasil menambahkan hutang baru!');
            }
        }
    }

    public function updateGET($debt_id) {
        if(!Auth::check()) {
            return redirect('/user/login');
        }

        $debt = Debt::where("id", $debt_id)->first();
        
        $user_id = Auth::id();
        $auth_username = Auth::user()->fullname;
        $user_id = Auth::id();
        $debters = Debter::where("user_id", $user_id)->get();

        return view('debt.update', [
            "title" => "Catatan Hutang - Create New Debt",
            "username" => $auth_username,
            "debters" => $debters,
            "debt" => $debt
        ]);
    }

    public function updatePOST(Request $request) {
        if(!Auth::check()) {
            return redirect('/user/login');
        }

        $debt_id = $request->debt_id;
        $debt = Debt::where("id", $debt_id)->first();
        
        $user_id = Auth::id();
        $debter_id = 0;
        if($request->debter_data == "create_new") {
            $credentials = $request->validate([
                'debter_data' => 'required',
                'total' => 'required',
                'remarks' => 'required',
                'debter_name' => 'required',
                'debter_photo' => 'required',
                'debter_description' => 'required'
            ]); 
            $debter_id = Debter::create([
                "user_id" => $user_id,
                "fullname" => $request->debter_name,
                "photo" => CommonFunctions::uploadFiles($request->file('debter_photo'), "DEBTER_PHOTO"),
                "description" => $request->debter_description
            ])->id;

            if($debter_id) {
                $debt->debter_id = $debter_id;
                $debt->total = $request->total;
                $debt->remarks = $request->remarks;
                $result = $debt->save();

                return redirect('/debt')->with('success', 'Berhasil mengubah data hutang!');
            }
        } else {
            $credentials = $request->validate([
                'debter_data' => 'required',
                'total' => 'required',
                'remarks' => 'required'
            ]);

            $debt->debter_id = $request->debter_data;
            $debt->total = $request->total;
            $debt->remarks = $request->remarks;
            $result = $debt->save();

            return redirect('/debt')->with('success', 'Berhasil mengubah data hutang!');
        }
    }

    public function mark_as_paid($debt_id) {
        $debt = Debt::where('id', $debt_id)->first();
        $debt->status = 1;
        $debt->save();

        return redirect('/debt')->with('success', 'Berhasil mengubah data hutang!');
    }

    public function delete($debt_id) {
        $debt = Debt::where('id', $debt_id)->delete();

        return redirect('/debt')->with('success', 'Berhasil menghapus data hutang!');
    }
}

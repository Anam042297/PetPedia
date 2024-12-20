<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Yajra\DataTables\Facades\DataTables;

class UserTableController extends Controller
{
    //data table function
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'user')->get();


            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('users.destroy', $row->id);
                    $action = '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button">  <i class="fas fa-trash-alt"></i></button>';

                    return $action;
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.userTable');
    }
    //delete function
    public function destroy($id)
    {
        //  dd(123);
        $user = User::find($id);
        // dd($user);
        if (!$user) {
            return response()->json(['error' => 'user not found ".'], 404);
        }
        $user->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}

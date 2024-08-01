<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use DataTables;

class UserTableController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'user')->get();


            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('users.destroy', $row->id);
                    $action = '<button data-href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete_button"> Delete</button>';

                    return $action;
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.userTable');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
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

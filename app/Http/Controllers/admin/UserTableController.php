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
                    $editUrl = route('users.edit', $row->id);
                    $deleteUrl = route('users.destroy', $row->id);
                    $buttons = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>';
                    $buttons .= ' <form action="' . $deleteUrl . '" method="POST" style="display: inline;">';
                    $buttons .= csrf_field();
                    $buttons .= method_field('DELETE');
                    $buttons .= '<button type="submit" class="btn btn-sm btn-danger">Delete</button></form>';
                    return $buttons;
                })
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
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('usertable')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('usertable')->with('success', 'User deleted successfully.');
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function store(Request $request)
    {
        #validasi input di bagian server
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        #sudah pasti valid datanya
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();
        return redirect('/user');
    }
    public function list()
    {
        $users = User::all();
        return view('user/list', [
            'users' => $users
        ]);
    }

    public function add()
    {
        return view('user/add');
    }

    public function edit($id)
    {
        #fungsi find adalah untuk mencari data berdasarkan primary key nya
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        #kondini dimana data usernya ada
        return view('user/edit', [
            'user' => $user
        ]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $user = User::find($request->id);
        if ($user == null) {
            abort(404);
        }
        #user ada
        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->password !== null) {
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        }
        $user->save();
        return redirect('/user');
    }

    public function delete($id)
    {
        #fungsi find adalah untuk mencari data berdasarkan primary key nya
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        #kondini dimana data usernya ada
        $user->delete();
        return redirect('/user');
    }
}

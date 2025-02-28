<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function list()
    {
        $kategori = Kategori::all();
        return view('kategori/list', [
            'kategori' => $kategori
        ]);
    }

    public function add()
    {
        return view('kategori/add');
    }

    public function store(Request $request)
    {
        #validasi input di bagian server
        $request->validate([
            'code' => 'required',
            'name' => 'required|string'
        ]);
        #sudah pasti valid datanya
        $kategori = new Kategori();
        $kategori->code = $request->code;
        $kategori->name = $request->name;
        $kategori->save();
        return redirect('/kategori');
    }


    public function edit($id)
    {
        #fungsi find adalah untuk mencari data berdasarkan primary key nya
        $kategori = Kategori::find($id);
        if ($kategori == null) {
            abort(404);
        }
        #kondini dimana data usernya ada
        return view('kategori/edit', [
            'kategori' => $kategori
        ]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
        ]);
        $kategori = Kategori::find($request->id);
        if ($kategori == null) {
            abort(404);
        }
        #user ada
        $kategori->code = $request->code;
        $kategori->name = $request->name;
    
        $kategori->save();
        return redirect('/kategori');
    }

    public function delete($id)
    {
        #fungsi find adalah untuk mencari data berdasarkan primary key nya
        $kategori = Kategori::find($id);
        if ($kategori == null) {
            abort(404);
        }
        #kondini dimana data usernya ada
        $kategori->delete();
        return redirect('/kategori');
    }
}

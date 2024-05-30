<?php
//php make:controller ProdukController --resource

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\JenisProduk;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index untuk produk
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jenis_produk = DB::table('jenis_produk')->get();
        return view('admin.produk.create', compact('jenis_produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([//validasi data
            'kode'=>'required|unique:produk|max:10',
            'nama'=>'required|max:45',
            'harga_beli'=>'required|numeric',
            'harga_jual'=>'required|numeric',
            'stok'=>'required|numeric',
            'min_stok'=>'required|numeric',
            'foto'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],
        [
            'kode.max'=> 'Kode Maksimal 10 Karakter',
            'kode.required'=> 'Kode wajib diisi',
            'kode.unique'=> 'Kode tidak Boleh Sama',
            'nama.required'=> 'Nama Wajib diisi',
            'nama.max'=>'Nama Maksimal 45 karakter',
            'foto.max'=> 'Foto Maksimal 2 MB',
            'foto.mimes' => 'File ekstensi hanya bisa jpg, png, jpeg, gif, svg',
            'foto.image' => 'File harus berbentuk gambar',
        ]
    );
        //proses upload foto
        //jika file foto ada yang terupload
        if(!empty($request->foto)){
            //maka proses berikut yang dijalankan
            $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/image'), $fileName);
        }else {
            $fileName = '';
        }
        //tambah data produk
        DB::table('produk')->insert([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_jual'=>$request->harga_jual,
            'harga_beli'=>$request->harga_beli,
            'stok'=>$request->stok,
            'min_stok'=>$request->min_stok,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$fileName,
            'jenis_produk_id'=>$request->jenis_produk_id,
        ]);
        Alert::success('Tambah Produk', 'Berhasil Menambahkan Produk');
        return redirect('admin/produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama as jenis')
        ->where('produk.id', $id)
        ->get();
        return view('admin.produk.detail', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //jenis_produk
        $jenis_produk = DB::table('jenis_produk')->get();
        $produk = DB::table('produk')->where('id', $id)->get();
        return view('admin.produk.edit', compact('jenis_produk', 'produk'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //foto lama
        $fotoLama = DB::table('produk')->select('foto')->where('id',$id)->get();
        foreach($fotoLama as $fl){
            $fotoLama = $fl->foto;
        }
        //jika fotonya sudah ada yang terupload
        if(!empty($request->foto)){
            //maka proses selanjutnya
            if(!empty($fotoLama->foto)) unlink(public_path('admin/image'.$fotoLama->foto));
            $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('admin/image'), $fileName);
            //hapus foto lama
        }else{
            $fileName = $fotoLama;
        }
        DB::table('produk')->where('id', $id)->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'harga_jual'=>$request->harga_jual,
            'harga_beli'=>$request->harga_beli,
            'stok'=>$request->stok,
            'min_stok'=>$request->min_stok,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$fileName,
            'jenis_produk_id'=>$request->jenis_produk_id,
        ]);
        //Alert::success('Update Produk', 'Berhasil Update Produk');
        return redirect('admin/produk')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data
        DB::table('produk')->where('id', $id)->delete();
        return redirect ('admin/produk');
    }
}

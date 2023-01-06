<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = DB::connection('mysql')->table('books')->get();
        return response()->json($query, 200);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();
        $this->validate($request, [
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'ukuran_buku' => 'required',
            'sinopsis' => 'required',
            'image_link' => 'required'
        ]);

        $request['created_at'] = $timestamp;
        $request['updated_at'] = $timestamp;

        $trans = DB::connection('mysql')->table('books')->insert($request->all());
        return response()->json("Berhasil menambahkan data buku!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show_id($id)
    {
        //
        $trans = DB::connection('mysql')->table('books')->where('id', $id)->first();
        return response()->json($trans);
    }

    public function show_kategori($nama_kategori)
    {
        //
        // $trans = DB::select('SELECT * FROM books WHERE kategori = ?', [$nama_kategori]);
        $trans = DB::connection('mysql')->table('books')->where('kategori', $nama_kategori)->get();
        return response()->json($trans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();
        $request['updated_at'] = $timestamp;
        $trans = DB::connection('mysql')->table('books')->where('id', $id)->update($request->all());
        return response()->json("Berhasil mengupdate data buku!",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $trans = DB::connection('mysql')->table('books')->where('id', $id)->delete();
        return response()->json("Berhasil hapus data buku!",200);
    }

    public function detail(){
        $id = 1;
        $test = "Tersedia";
        $book = DB::connection('mysql')->table('books')->where('id', $id)->get('status');
        if($book[0]->status == 0) $test = "Tidak tersedia";
        return response()->json($test, 200);
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\log_peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = DB::connection('db_history')->table('log_peminjaman')->get();
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
            'id_buku' => 'required',
            'id_peminjam' => 'required',
            'status' => 'required',
        ]);

        $request['created_at'] = $timestamp;
        $request['updated_at'] = $timestamp;

        $trans = DB::connection('db_history')->table('log_peminjaman')->insert($request->all());
        return response()->json("Berhasil menambahkan log!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\log_peminjaman  $log_peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show_id($id)
    {
        //
        $trans = DB::connection('db_history')->table('log_peminjaman')->where('id', $id)->first();
        return response()->json($trans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\log_peminjaman  $log_peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();
        $request['updated_at'] = $timestamp;
        $trans = DB::connection('db_history')->table('log_peminjaman')->where('id', $id)->update($request->all());
        return response()->json("Berhasil mengupdate log!",200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\log_peminjaman  $log_peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $trans = DB::connection('db_history')->table('log_peminjaman')->where('id', $id)->delete();
        return response()->json("Berhasil hapus log!",200);
    }

    public function detail(){
		$data = DB::table(DB::raw('db_history.log_peminjaman AS peminjaman_table'))
			->join(DB::raw('db_user.users AS user_table'),'peminjaman_table.id_peminjam','=', 'user_table.id')
            ->join(DB::raw('db_book.books AS book_table'), 'peminjaman_table.id_buku','=','book_table.id')
			->select(	'peminjaman_table.id AS id',
						'peminjaman_table.status AS kegiatan', 
						'book_table.judul AS judul_buku', 
						'user_table.nama AS peminjam', 
                        'peminjaman_table.created_at AS tanggal'
						)
            ->orderBy('id')
			->get();

		return response()->json($data);
	}

    public function detail_id($id){
		$data = DB::table(DB::raw('db_history.log_peminjaman AS peminjaman_table'))
			->join(DB::raw('db_user.users AS user_table'),'peminjaman_table.id_peminjam','=', 'user_table.id')
            ->join(DB::raw('db_book.books AS book_table'), 'peminjaman_table.id_buku','=','book_table.id')
			->select(	'peminjaman_table.id AS id',
						'peminjaman_table.status AS kegiatan', 
						'book_table.judul AS judul_buku', 
						'user_table.nama AS peminjam', 
                        'peminjaman_table.created_at AS tanggal'
						)
            ->where('peminjaman_table.id','=',$id)
			->get();

		return response()->json($data);
	}
}

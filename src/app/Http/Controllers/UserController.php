<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
		$query = DB::connection('db_user')->table('users')->get();
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
			'nim' => 'required',
			'nama' => 'required',
			'jurusan' => 'required',
			'fakultas' => 'required',
			'alamat' => 'required',
			'no_telepon' => 'required',
		]);

		$request['created_at'] = $timestamp;
		$request['updated_at'] = $timestamp;

		$trans = DB::connection('db_user')->table('users')->insert($request->all());
		return response()->json("Berhasil menambahkan user baru!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show_id($id)
	{
		//
		$trans = DB::connection('db_user')->table('users')->where('id', $id)->first();
		return response()->json($trans);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
		$timestamp = \Carbon\Carbon::now()->toDateTimeString();
		$request['updated_at'] = $timestamp;
		$trans = DB::connection('db_user')->table('users')->where('id', $id)->update($request->all());
		return response()->json("Berhasil mengupdate data user!",200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
		$trans = DB::connection('db_user')->table('users')->where('id', $id)->delete();
		return response()->json("Berhasil hapus data user!",200);
	}
}

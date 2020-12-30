<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaoDienController extends Controller
{
    private $base;
    const table = 'dao_dien';
    const id = 'ma_dao_dien';
    const ten_dao_dien = 'ten_dao_dien';

    /**
     * NhaCungCapController constructor.
     * @param $base
     */
    public function __construct()
    {
        $this->base = new BaseController(self::table, self::id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->base->index();
        return response()->json($this->base->getMessage(), $this->base->getStatus());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($listObj = $request->get('listObj')) {
                $count = count($listObj);
                if ($count > 0) {
                    foreach ($listObj as $obj) {
                        DB::table('tai_khoan')->insert($obj);
                    }
                    return response()->json('Thêm mới thành công', 201);
                } else {
                    return response()->json('Thêm mới thất bại', 200);
                }
            } else {
                $arr_value = $request->all();
                if (count($arr_value) > 0) {
                    DB::table('tai_khoan')->insert($arr_value);
                    return response()->json("Thêm mới thành công", 201);
                }
                return response()->json('Thêm mới thất bại', 200);
            }
        } catch (\Throwable $e) {
            report($e);
            return response()->json($e, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($ncc = DB::table('tai_khoan')->where('ma_tai_khoan', '=', $id)->get()) {
            return response()->json($ncc, 200);
        } else {
            return response()->json("Không tìm thấy", 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

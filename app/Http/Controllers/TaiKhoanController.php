<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaiKhoanController extends Controller
{
    private $base;
    const table = 'tai_khoan';
    const id = 'ma_tai_khoan';
    const ho_ten = 'ho_ten';

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
        if (DB::table('tai_khoan')->where('ma_tai_khoan', '=', $id)->update($request->all())) {
            $ncc = DB::table('tai_khoan')->where('ma_tai_khoan', '=', $id)->get();
            return response()->json($ncc, 200);
//            return response()->json("Chỉnh sửa thành công");
        } else {
            return response()->json("Chỉnh sửa thất bại",200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            if ($listId = $request->get('listId')) {
                if (count($listId) > 0 && DB::table('tai_khoan')->whereIn('ma_tai_khoan', $listId)->delete()) {
                    return response()->json('Xóa thành công', 200);
                } else {
                    return response()->json('Xóa thất bại', 200);
                }
            } else {
                $id = $request->get("id");
                if ($ncc = DB::table('tai_khoan')->where('ma_tai_khoan', '=', $id)->delete()) {
                    return response()->json('Xóa thành công', 200);
                }
                return response()->json('Xóa thất bại', 200);
            }
        } catch (\Throwable $e) {
            report($e);
            return response()->json($e, 500);
        }
    }
}

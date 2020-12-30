<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChiTietHoaDonNhapController extends Controller
{
    private $base;
    const table = 'chi_tiet_hoa_don_nhap';
    const id = 'id';
    const ma_HDN = 'ma_HDN';
    const ma_CD = 'ma_CD';
    const gia_nhap = 'gia_nhap';
    const so_luong = 'so_luong';

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
        //
        $objs = null;
            $code = null;
            $objs = DB::table(self::table)
                ->join(ThongTinCDController::table, self::table . '.' . self::ma_CD, '=', ThongTinCDController::table . '.' . ThongTinCDController::id)
                ->select(self::table . '.*', ThongTinCDController::table . '.' . ThongTinCDController::ten_CD)
                ->get();
            $code = 200;
            return response()->json(['data' => $objs], $code);
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
        //
        try {
            $arr_value = $request->all();
            if (count($arr_value) > 0) {
                $validator = Validator::make($arr_value, [
                    self::ma_HDN => 'required',
                    self::ma_CD => 'required',
                    self::gia_nhap => 'required',
                    self::so_luong => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()->all()], 400);
                }
                if ($arr_value[self::gia_nhap] < 1) {
                    return response()->json(['error' => 'Giá nhập phải lớn hơn 0'], 400);
                }
                if ($arr_value[self::so_luong] < 1) {
                    return response()->json(['error' => 'Số lượng phải lớn hơn 0'], 400);
                }
                $obj = DB::table(self::table)
                    ->select(self::table . '.*')
                    ->where(self::ma_CD, '=', $arr_value[self::ma_CD])
                    ->where(self::ma_HDN, '=', $arr_value[self::ma_HDN])
                    ->get();
                if (count($obj) > 0) {
                    return response()->json(['error' => 'Thêm mới thất bại. Có 1 row đã tồn tại mã phiếu nhập và mã sản phẩm'], 400);
                }
                DB::table(self::table)->insert($arr_value);
                return response()->json(['success' => 'Thêm mới thành công'], 201);
            } else {
                return response()->json(['error' => 'Thêm mới thất bại. Không có dữ liệu'], 400);
            }
        } catch (\Throwable $e) {
            return response()->json(['error' => $e], 500);
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
        //
        $obj = DB::table(self::table)
            ->join(ThongTinCDController::table, self::table . '.' . self::ma_CD, '=', ThongTinCDController::table . '.' . ThongTinCDController::id)
            ->select(self::table . '.*', ThongTinCDController::table . '.' . ThongTinCDController::ten_CD)
            ->where(self::table . '.' . self::id, '=', $id)
            ->get();
        if ($obj) {
            return response()->json(['data' => $obj], 200);
        } else {
            return response()->json(['error' => 'Không tìm thấy'], 200);
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
        $this->base->update($request, $id);
        return response()->json($this->base->getMessage(), $this->base->getStatus());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->base->destroy($request);
        return response()->json($this->base->getMessage(), $this->base->getStatus());
        //
    }
}

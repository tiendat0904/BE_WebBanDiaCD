<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ThongTinCDController extends Controller
{
    private $base;
    const table = 'thong_tin_cd';
    const id = 'ma_CD';
    const ma_tem_ban_quyen = 'ma_tem_ban_quyen';
    const ma_loai_CD = 'ma_loai_CD';
    const ten_CD = 'ten_CD';
    const ma_dao_dien = 'ma_dao_dien';
    const mo_ta = 'mo_ta';
    const khu_vuc = 'khu_vuc';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->base = new BaseController(self::table, self::id);
    }

    public function index()
    {
        $objs = null;
        $code = null;
        $objs = DB::table(self::table)
            ->join(TemBanQuyenController::table, TemBanQuyenController::table . '.' . TemBanQuyenController::id, '=', self::table . '.' . self::ma_tem_ban_quyen)
            ->join(DaoDienController::table, DaoDienController::table . '.' . DaoDienController::id, '=', self::table . '.' . self::ma_dao_dien)
            ->join(LoaiCDController::table, LoaiCDController::table . '.' . LoaiCDController::id, '=', self::table . '.' . self::ma_loai_CD)
            ->select(self::table . '.*',self::table . '.' . self::id, TemBanQuyenController::table . '.' . TemBanQuyenController::ten_tem_ban_quyen . ' as ten_ban_quyen', DaoDienController::table . '.' . DaoDienController::ten_dao_dien . ' as ten_dao_dien', LoaiCDController::table . '.' . LoaiCDController::the_loai . ' as the_loai')
            ->orderBy(self::id)
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
        $validator = Validator::make($request->all(), [
            self::ma_dao_dien => 'required',
            self::ma_loai_CD => 'required',
            self::ma_tem_ban_quyen => 'required',
            self::ten_CD => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        $this->base->store($request);
        return response()->json($this->base->getMessage(), $this->base->getStatus());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->base->show($id);
            return response()->json($this->base->getMessage(), $this->base->getStatus());
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
    }
}

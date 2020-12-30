<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HoaDonNhapController extends Controller
{
    private $base;
    const table = 'hoa_don_nhap';
    const id = 'ma_HDN';
    const ma_nhan_vien = 'ma_nhan_vien';
    const ma_nha_phat_hanh = 'ma_nha_phat_hanh';
    const ngay_nhap = 'ngay_nhap';
    const ghi_chu = 'ghi_chu';
    const tong_tien = 'tong_tien';

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
            ->join(NhaPhatHanhController::table, NhaPhatHanhController::table . '.' . NhaPhatHanhController::id, '=', self::table . '.' . self::ma_nha_phat_hanh)
            ->join(TaiKhoanController::table, self::table . '.' . self::ma_nhan_vien, '=', TaiKhoanController::table . '.' . TaiKhoanController::id)
            ->select(self::table . '.*', NhaPhatHanhController::table . '.' . NhaPhatHanhController::ten_nha_phat_hanh . ' as ten_nha_phat_hanh', TaiKhoanController::table . '.' . TaiKhoanController::ho_ten . ' as ten_nhan_vien')
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
        //
        date_default_timezone_set(BaseController::timezone);
        $validator = Validator::make($request->all(), [
            self::ma_nha_phat_hanh => 'required',
            self::ma_nhan_vien => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        $obj = [];
        $obj[self::ma_nhan_vien] = $request->ma_nhan_vien;
        $obj[self::ma_nha_phat_hanh] = $request->ma_nha_phat_hanh;
        $obj[self::ngay_nhap] = date('Y-m-d');
        DB::table(self::table)->insert($obj);
        return response()->json(['success' => 'Thêm mới thành công'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = DB::table(self::table)
            ->join(NhaPhatHanhController::table, NhaPhatHanhController::table . '.' . NhaPhatHanhController::id, '=', self::table . '.' . self::ma_nha_phat_hanh)
            ->join(TaiKhoanController::table, self::table . '.' . self::ma_nhan_vien, '=', TaiKhoanController::table . '.' . TaiKhoanController::id)
            ->select(self::table . '.*',self::table . '.' . self::id, NhaPhatHanhController::table . '.' . NhaPhatHanhController::ten_nha_phat_hanh . ' as ten_nha_phat_hanh', TaiKhoanController::table . '.' . TaiKhoanController::ho_ten . ' as ten_nhan_vien')
            ->where(self::table . '.' . self::id, '=', $id)
            ->orderBy(self::id)
            ->first();
        if ($obj) {
            return response()->json([
                'data' => $obj
            ], 200);
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
        $pn = DB::table(self::table)->where(self::id, '=', $id)->first();
            if (DB::table(self::table)->where(self::id, '=', $id)->update($request->all())) {
                return response()->json(['success' => 'Cập nhật thành công'], 201);
            } else {
                return response()->json(['error' => 'Cập nhật thất bại'], 400);
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
            if ($listId = $request->get(BaseController::listId)) {
                DB::table(ChiTietHoaDonNhapController::table)->whereIn(ChiTietHoaDonNhapController::ma_HDN, $listId)
                    ->delete();
            } else {
                $id = $request->get(BaseController::key_id);
                DB::table(ChiTietHoaDonNhapController::table)->where(ChiTietHoaDonNhapController::ma_HDN, $id)
                    ->delete();
            }
        } catch (\Throwable $e) {
            report($e);
        }
        $this->base->destroy($request);
        return response()->json($this->base->getMessage(), $this->base->getStatus());
    }
}

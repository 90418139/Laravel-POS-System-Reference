<?php

namespace App\Http\Controllers;

use App\Merchandise;
use App\Transaction;
use Illuminate\Support\Facades\Validator;

class MerchandiseController extends Controller
{

    // 商品管理清單檢視
    public function ManageListPage()
    {
        // 每頁資料量
        $row_per_page = 10;
        // 撈取商品分頁資料
        $MerchandisePaginate =  Merchandise::OrderBy('created_at', 'desc')->paginate($row_per_page);

        // 設定商品圖片網址
        foreach ($MerchandisePaginate as $item){
            if(!is_null($item->photo)){
                $item->photo = url($item->photo);
            }
        }
        $binding = [
            'title' => 'Manage Product',
            'MerchandisePaginate' => $MerchandisePaginate,
        ];

        return view('merchandise.manage-merchandise', $binding);
    }

    // 新增商品
    public function CreateProcess()
    {
        $merchandise_data = [
            'status'       => 'C',    // 建立中
            'class'        => ' ',       //商品類別
            'name'         => 'item',     // 商品名稱
            'introduction' => 'item',     // 商品介紹
            'price'        => 0,      // 價格
        ];
        $Merchandise = Merchandise::create($merchandise_data);

        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }

    // 商品編輯
    public function ItemEditPage($merchandise_id)
    {
        // 撈取商品資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);

        // 設定商品照片網址
        if (!is_null($Merchandise->photo)) {
            $Merchandise->photo = url($Merchandise->photo);
        }

        // 網站title/商品資料包成一包
        $binding = [
            'title' => 'Edit Product',
            'Merchandise' => $Merchandise,
        ];

        return view('merchandise.edit-merchandise', $binding);
    }

    // 商品資料更新處理
    public function ItemUpdateProcess($merchandise_id){
        // 撈取商品資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [
            // 商品狀態
            'status' => 'required|in:C,S',
            // 商品類別
            'class' => 'required|max:20',
            // 商品名稱
            'name' => 'required|max:80',
            // 商品介紹
            'introduction' => 'required|max:2000',
            // 商品照片
            'photo' => 'file|image|max:10240',
            // 商品價格
            'price' => 'required|integer|min:0',
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()){
            // 資料驗證錯誤
            return redirect('/merchandise/' . $Merchandise->id . '/edit')->withErrors($validator)->withInput();
        }

        if (isset($input['photo'])){
            // 有上傳圖片
            $photo = $input['photo'];
            // 檔案副檔名
            $file_extension = $photo->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = uniqid() . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'img/' . $file_name;
            // 檔案存放目錄為對外公開 public 目錄下的相對位置
            $file_path = public_path($file_relative_path);
            $photo->move('img/', $file_name);
            // 設定圖片檔案相對位置
            $input['photo'] = $file_relative_path;
        }

        $Merchandise->update($input);

        // 重新導向到商品編輯頁面
        return redirect('/merchandise/manage');
    }

    // 商品清單檢視
    public function OrderList()
    {
        // 撈取商品分頁資料
        $merchandise = Merchandise::all();
        $class = Merchandise::where('status', 'S')->groupBy('class')->get();

        $binding = [
            'title' => trans('Order'),
            'table' => '0',
            'class' => $class,
            'merchandise'=> $merchandise,
        ];

        return view('merchandise.order-merchandise', $binding);
    }

    // 商品送出
    public function Order(){
        $input = request()->all();
        $items = explode(',', $input['item']);
        $qtys = explode(',', $input['qty']);
        $prices = explode(',', $input['price']);


        for($i=0;$i<count($items)-1;$i++){
            $transaction_data = [
                'user_id'        => $input['user'],
                'merchandise_id' => $items[$i],
                'price'          => $prices[$i] / $qtys[$i],
                'buy_count'      => $qtys[$i],
                'total_price'    => $prices[$i],
            ];
            Transaction::create($transaction_data);

        }
        session(['SeriaNnumber' => session('SeriaNnumber') + 1]);
        return redirect('/');

    }
}

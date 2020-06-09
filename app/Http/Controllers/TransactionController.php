<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    // 製造完成標記
    public function MakeFinish(){
        $input = request()->all();

        $idlist = explode(',',$input['id']);
        //print_r($idlist);
        for($i = 0; $i < count($idlist) - 1; $i++){
            $post = Transaction::findOrFail($idlist[$i]);
            $post->complete = 'O';
            $post->save();
        }


        return redirect('/make');
    }

    // 製造清單
    public function MakeList(){
        $TableList = Transaction::groupBy('user_id')->get();
        $MakeList = Transaction::all();
        $binding = [
            'title' => '商品製作列表',
            'TableList' => $TableList,
            'MakeList' => $MakeList,
        ];

        return view('merchandise.make-merchandise',$binding);
    }

    public function ListPage(){
        $user_id = session()->get('user_id');

        // 每頁資料量
        $row_per_page = 10;
        // 撈取商品分頁資料
        $TransactionPaginate =  Transaction::where('user_id', $user_id)->OrderBy('created_at', 'desc')->with('Merchandise')->paginate($row_per_page);

        // 設定商品圖片網址
        foreach ($TransactionPaginate as $item){
            if(!is_null($item->Merchandise->photo)){
                $item->Merchandise->photo = url($item->Merchandise->photo);
            }
        }

        $binding = [
            'title' => '交易紀錄',
            'TransactionPaginate' => $TransactionPaginate,
        ];

        return view('transaction.list-transaction', $binding);
    }
}

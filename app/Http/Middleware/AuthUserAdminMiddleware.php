<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthUserAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 預設不允許存取
        $is_allow_access = false;
        // 取得會員編號
        $user_id = Auth::user()->id;

        if (!is_null($user_id)){
            // session 有會員編號 取得會員資料
            $User = User::findOrFail($user_id);

            if ($User->type == 'A'){
                // 是管理者 允許存取
                $is_allow_access = true;
            }

        }

        if (!$is_allow_access){
            // 若不允許存取 重新導向至首頁
            return redirect()->to('/');
        }

        return $next($request);
    }
}

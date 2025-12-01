<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLogs;
use Illuminate\Support\Facades\Hash;

class WeightLogsController extends Controller
{
    public function index()
    {
        view('weight_logs');
    }

    public function create(RegisterStep1Request $request)
    {
        $data=$request->validated();
        $data['password']=Hash::make($data['password']);
        $user=User::create($data);
        $user_id=$user->id;
        return redirect('/register/step2')->with(['user_id'=>$user_id]);
    }

    public function store(RegisterStep2Request $request)
    {
        $weight_data=$request->validated();
        WeightLogs::create([
            'user_id'=>$weight_data['user_id'],
            'date'=>$weight_data['date'],
            'weight'=>$weight_data['weight'],
        ]);
        WeightTarget::create([
            'user_id'=>$weight_data['user_id'],
            'target_weight'=>$weight_data['target_weight'],
        ]);
        return redirect('/login')->with('success','アカウント登録が完了しました。ログインしてください。');
    }

    public function login(LoginRequest $request)
    {
        
    }
}

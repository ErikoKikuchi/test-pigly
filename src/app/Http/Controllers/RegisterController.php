<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(RegisterStep1Request $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        session(['user_id' => $user->id]);
        return redirect('/register/step2');
    }

    public function store(RegisterStep2Request $request)
    {
        $weight_data = $request->validated();
        WeightLog::create([
            'user_id' => $weight_data['user_id'],
            'date' => $weight_data['date'],
            'weight' => $weight_data['weight'],
        ]);
        WeightTarget::create([
            'user_id' => $weight_data['user_id'],
            'target_weight' => $weight_data['target_weight'],
        ]);
        $response = redirect('/login')->with('success', 'アカウント登録が完了しました。');
        return $response;
    }
}

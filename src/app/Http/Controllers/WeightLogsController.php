<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep2Request;
use App\Http\Requests\WeightCreateRequest;
use App\Http\Requests\WeightDetailRequest;
use Illuminate\Http\Request;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;

class WeightLogsController extends Controller
{
    public function index()
    {
            //認証に成功した場合の処理
            $userId=Auth::id();
            $weight_data=WeightLog::where('user_id',$userId)->paginate(8)->WithQuerystring();
            $weight_target=WeightTarget::where('user_id',$userId)->first('target_weight');
            $weight_difference=$weight_data->last()->weight - $weight_target->target_weight;
            $weight_latest=$weight_data->last()->weight;
            return view('weight_logs')->with(['weight_data'=>$weight_data,'weight_target'=>$weight_target,'weight_difference'=>$weight_difference,
            'weight_latest'=>$weight_latest]);
        }
    public function show()
    {
        return view('goal_setting');
    }
    public function save(RegisterStep2Request $request)
    {
        $weight_update=$request->validated();
        $user_id=auth()->id();
        WeightTarget::update(
            ['user_id'=>$user_id],
            ['target_weight'=>$weight_update['target_weight']]
        );
        return redirect('/weight_logs')->with('success','目標体重を変更しました。');
    }
    public function search(Request $request)
    {
        $userId=Auth::id();
        $date_from=$request->input('date');
        $date_end=$request->input('date_end');
        $weight_data=WeightLog::where('user_id',$userId)
            ->whereBetween('date',[$date_from,$date_end])
            -> paginate(8)->WithQuerystring();
        $weight_counts= $weight_data->count();
        $weight_target = WeightTarget::where('user_id', $userId)->first('target_weight');
        $weight_difference = $weight_data->last()->weight - $weight_target->target_weight;
        $weight_latest = $weight_data->last()->weight;
        return view('weight_logs')->with([
            'weight_data'=>$weight_data,
            'date_from'=>$date_from,
            'date_end'=>$date_end,
            'weight_counts'=> $weight_counts,
            'weight_target' => $weight_target,
            'weight_difference' => $weight_difference,
            'weight_latest' => $weight_latest
        ]);
    }
    public function create()
    {
        return view('weight_logs_create');
    }
    public function store(WeightCreateRequest $request)
    {
        $user_id=auth()->id();
        $request->validated();
        WeightLog::create([
            'user_id'=>$user_id,
            'date'=>$request->date,
            'weight'=>$request->weight,
            'calories'=>$request->calories,
            'exercise_time'=>$request->exercise_time,
            'exercise_content'=>$request->exercise_content,
        ]);
        return redirect('/weight_logs')->with('success','体重記録を追加しました。');
    }
    public function edit($weightLogId){
        $log=WeightLog::find($weightLogId);
        return view('weight_detail',compact('log'));
    }
    public function update(WeightDetailRequest $request,$weightLogId){
        $user_id = auth()->id();
        $validated = $request->validated();
        $log = WeightLog::where('id',$weightLogId)
                        ->where('user_id',$user_id)
                        ->firstOrFail();
        $log->update($validated + [
            'user_id'=>$user_id
        ]);
        return redirect('/weight_logs')->with('success', '体重記録を更新しました。');
    }
    public function destroy($weightLogId){
        WeightLog::find($weightLogId)->delete();
        return redirect('/weight_logs');
    }
}

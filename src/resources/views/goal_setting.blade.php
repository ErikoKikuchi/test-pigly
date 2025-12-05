@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}" />
@endsection

@section('content')
<div class="background-image">
    <div class="goal-setting">
        <h1 class="goal-setting__title">目標体重設定</h1>
        <form class="goal-setting__form" action="/weight_logs/goal_setting" method="post">
            @csrf
            <div class="goal-setting__input-group">
                <input type="number" id="target_weight" name="target_weight" class="goal-setting__input" placeholder="50.0" step="0.1">kg
            </div>
            <div class="goal-setting__button-group">
                <a class="back__button" href="/weight_logs">戻る</a>
                <button type="submit" class="goal-setting__button">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
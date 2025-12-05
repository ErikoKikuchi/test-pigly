@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_detail.css') }}" />
@endsection

@section('content')
<div class="weight_detail">
    <div class="weight_detail-content">
        <h2 class="weight_detail-title">Weight Log</h2>
        <form class="weight-detail__form" action="{{url('/weight_logs/' .$log->id .'/update')}}" method="post">
            @csrf
            @method('PATCH')
            <div class="weight_detail-content__date">
                <label class="weight_detail-content__label" for="date">日付</label>
                <input class="weight_detail-content__input" type="text" id="date" name="date" value="{{\Carbon\Carbon::today()->format('Y/m/d')}}">
            </div>
            <div class="error-message">
                @foreach ($errors->get('date') as $message)
                <p class="weight_detail-form__error-message">{{ $message }}</p>
                @endforeach
            </div>
            <div class="weight_detail-content__weight">
                <label class="weight_detail-content__label" for="weight">体重</label>
                <div class="input__wrapper">
                    <input class="weight_detail-content__input" type="text" id="weight" name="weight" value="{{$log->weight}}">kg
                </div>
            </div>
            <div class="error-message">
                @foreach ($errors->get('weight') as $message)
                <p class="weight_detail-form__error-message">{{ $message }}</p>
                @endforeach
            </div>
            <div class="weight_detail-content__calories">
                <label class="weight_detail-content__label" for="calories">摂取カロリー</label>
                <div class="input__wrapper">
                    <input class="weight_detail-content__input" type="text" id="calories" name="calories" value="{{$log->calories}}">cal
                </div>
            </div>
            <div class="error-message">
                @foreach ($errors->get('calories') as $message)
                <p class="weight_detail-form__error-message">{{ $message }}</p>
                @endforeach
            </div>
            <div class="weight_detail-content__exercise-time">
                <label class="weight_detail-content__label" for="exercise_time">運動時間</label>
                <input class="weight_detail-content__input" type="text" id="exercise_time" name="exercise_time" value="{{$log->exercise_time_short}}">
            </div>
            <div class="error-message">
                @foreach ($errors->get('exercise_time') as $message)
                <p class="weight_detail-form__error-message">{{ $message }}</p>
                @endforeach
            </div>
            <div class="weight_detail-content__exercise-content">
                <label class="weight_detail-content__label" for="exercise_content">運動内容</label>
                <textarea class="weight_detail-content__textarea" type="text" id="exercise_content" name="exercise_content" placeholder="運動内容を追加"></textarea>
            </div>
            <div class="error-message">
                @foreach ($errors->get('exercise_content') as $message)
                <p class="weight_detail-form__error-message">{{ $message }}</p>
                @endforeach
            </div>
            <div class="button-group">
                <a class="back-button" href="/weight_logs" id="close">戻る</a>
                <button class="update-button" type="submit">更新</button>
            </div>
        </form>
        <form class="delete-button" action="{{url('/weight_logs/' .$log->id .'/delete')}}" method="post">
            @csrf
            @method('delete')
            <input class="delete-icon" src="{{asset('ごみ箱.png')}}" type="image" name="delete">
        </form>
    </div>
</div>
@endsection
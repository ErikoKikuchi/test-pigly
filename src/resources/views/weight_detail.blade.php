@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_detail.css') }}" />
@endsection

@section('content')
<div class="modal" id="modal">
    <div class="modal-content">
        <h2 class="modal-title">Weight Log</h2>
        <form class="weight-logs__create-form" action="{{url('/weight_logs/' .$log->id .'/update')}}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content__date">
                <label class="modal-content__label" for="date">日付</label>
                <input class="modal-content__input" type="text" id="date" name="date" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
    </div>
    <div class="error-message">
        @foreach ($errors->get('date') as $message)
        <p class="register-form__error-message">{{ $message }}</p>
        @endforeach
    </div>
    <div class="modal-content__weight">
        <label class="modal-content__label" for="weight">体重</label>
        <input class="modal-content__input" type="text" id="weight" name="weight" value="{{$log->weight}}">kg
    </div>
    <div class="error-message">
        @foreach ($errors->get('weight') as $message)
        <p class="register-form__error-message">{{ $message }}</p>
        @endforeach
    </div>
    <div class="modal-content__calories">
        <label class="modal-content__label" for="calories">摂取カロリー</label>
        <input class="modal-content__input" type="text" id="calories" name="calories" value="{{$log->calories}}">cal
    </div>
    <div class="error-message">
        @foreach ($errors->get('calories') as $message)
        <p class="register-form__error-message">{{ $message }}</p>
        @endforeach
    </div>
    <div class="modal-content__exercise-time">
        <label class="modal-content__label" for="exercise_time">運動時間</label>
        <input class="modal-content__input" type="text" id="exercise_time" name="exercise_time" value="{{$log->exercise_time}}">
    </div>
    <div class="error-message">
        @foreach ($errors->get('exercise_time') as $message)
        <p class="register-form__error-message">{{ $message }}</p>
        @endforeach
    </div>
    <div class="modal-content__exercise-content">
        <label class="modal-content__label" for="exercise_content">運動内容</label>
        <textarea class="modal-content__input" type="text" id="exercise_content" name="exercise_content" placeholder="運動内容を追加"></textarea>
    </div>
    <div class="error-message">
        @foreach ($errors->get('exercise_content') as $message)
        <p class="register-form__error-message">{{ $message }}</p>
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
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}" />
@endsection

@section('content')
<div class="weight-data">
    <div class="success-message">
        @if (session('success'))
        <p class="success-message__text">{{ session('success') }}</p>
        @endif
    </div>
    <div class="weight-management">
        <div class="weight-goal">
            <p class="weight-goal__label">目標体重</p>
            <span class="weight-goal__contents">
                {{$weight_target->target_weight}}
            </span>
            <p class="weight-unit">kg</p>
        </div>
        <div class="weight-gap">
            <p class="weight-gap__label">目標まで</p>
            <span class="weight-gap__contents">
                @if ($weight_difference > 0)
                <p class="weight-gap--over">- {{ abs($weight_difference) }} </p>
                <p class="weight-unit">kg</p>
                @elseif ($weight_difference < 0)
                    <p class="weight-gap--under">+ {{ abs($weight_difference) }} </p>
                    <p class="weight-unit">kg</p>
                    @else
                    <p class="weight-gap--achieved">±0</p>
                    <p class="weight-unit">kg</p>
                    @endif
            </span>
        </div>
        <div class="weight-latest">
            <p class="weight-goal__label">最新体重</p>
            <span class="weight-goal__contents">
                {{$weight_latest}}
            </span>
            <p class="weight-unit">kg</p>
        </div>
    </div>
    <div class="weight-record">
        <div class="weight-record__top">
            <form class="search-form" action="/weight_logs/search" method="get">
                <input class="date-search" type="date" name="date" id="date" placeholder="年/月/日">～
                <input class="date-search" type="date" name="date_end" id="date_end" placeholder="年/月/日">
                <button class="search-button" type="submit">検索</button>
            </form>
            @if(!empty($date_from) || !empty($date_end))
            <div class="search-term">
                <p class>{{$date_from}}~{{$date_end}}の検索結果</p>
                <p class>{{$weight_counts}}件</p>
            </div>
            <div class="close__search-item">
                <a class="close__search-item--link" href="/weight_logs">クリア</a>
            </div>
            @endif
            <!-- データ追加ボタン -->
            <button id="open" class="create-button">データ追加</button>
            <!--モーダル-->
            <div class="modal" id="modal">
                <div class="modal-content">
                    <h2 class="modal-title">Weight Logを追加</h2>
                    <form class="weight-logs__create-form" action="/weight_logs/create" method="post">
                        @csrf
                        <div class="modal-content__date">
                            <label class="modal-content__label" for="date">日付</label>
                            <p class="modal-content__alert">必須</p>
                            <input class="modal-content__input" type="text" id="date" name="date" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
                        </div>
                        <div class="error-message">
                            @foreach ($errors->get('date') as $message)
                            <p class="register-form__error-message">{{ $message }}</p>
                            @endforeach
                        </div>
                        <div class="modal-content__weight">
                            <label class="modal-content__label" for="weight">体重</label>
                            <p class="modal-content__alert">必須</p>
                            <input class="modal-content__input" type="text" id="weight" name="weight" placeholder="50.0">kg
                        </div>
                        <div class="error-message">
                            @foreach ($errors->get('weight') as $message)
                            <p class="register-form__error-message">{{ $message }}</p>
                            @endforeach
                        </div>
                        <div class="modal-content__calories">
                            <label class="modal-content__label" for="calories">摂取カロリー</label>
                            <p class="modal-content__alert">必須</p>
                            <input class="modal-content__input" type="text" id="calories" name="calories" placeholder="1200">cal
                        </div>
                        <div class="error-message">
                            @foreach ($errors->get('calories') as $message)
                            <p class="register-form__error-message">{{ $message }}</p>
                            @endforeach
                        </div>
                        <div class="modal-content__exercise-time">
                            <label class="modal-content__label" for="exercise_time">運動時間</label>
                            <p class="modal-content__alert">必須</p>
                            <input class="modal-content__input" type="text" id="exercise_time" name="exercise_time" placeholder="00:00">
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
                            <button class="create-button" type="submit">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="weight-record__contents">
            <table class="weight-record__inner">
                <thead>
                    <tr class="weight-record__row">
                        <th class="weight-record__header">日付</th>
                        <th class="weight-record__header">体重</th>
                        <th class="weight-record__header">食事摂取カロリー</th>
                        <th class="weight-record__header">運動時間</th>
                        <th class="weight-record__header"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weight_data as $data)
                    <tr class="weight-record__row">
                        <td class="weight-record__item">
                            {{$data->date}}
                        </td>
                        <td class="weight-record__item">
                            {{$data->weight}}
                        </td>
                        <td class="weight-record__item">
                            {{$data->calories}}
                        </td>
                        <td class="weight-record__item">
                            {{$data->exercise_time_short}}
                        </td>
                        <td>
                            <a class="record_detail" href="{{route('weight_logs.edit',['weightLogId'=>$data->id])}}"><img src="{{ asset('鉛筆.png') }}" alt=" " class="pencil"></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$weight_data->links()}}
        </div>
    </div>
</div>
</div>
@endsection
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('open').addEventListener('click', function(e) {
            e.preventDefault(); // デフォルト動作を防ぐ
            document.getElementById('modal').style.display = 'flex';
        });

        document.getElementById('close').addEventListener('click', function(e) {
            e.preventDefault(); // デフォルト動作を防ぐ
            document.getElementById('modal').style.display = 'none';
        });

        // モーダル外をクリックしたら閉じる(オプション)
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    });
</script>
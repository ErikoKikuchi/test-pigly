@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_detail.css') }}" />
@endsection

@section('content')
<div class="weight-management">
    <div class="weight-goal">
        <p class="weight-goal__label">目標体重</p>
        <span class="weight-goal__contents">
            {{$target_weight}} kg
        </span>
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
    <div class="weight-record">
        <div class ="weight-record__top">
            <form class="search-form" action="" method="get"></form>
        </div>

</div>
</div>

@endsection
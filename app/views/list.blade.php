@extends('layouts.master')

@section('content')
    <div class="row ctr-filter">
        <div class="columns small-1 text-right">
            Filter:
        </div>
        <div class="columns small-11">
            <a href="#" class="button tiny radius">Clear Filter</a>
            {{ Form::text('filter', null, array('id'=>'filter', 'class'=>'text-center', 'placeholder'=>'Refine names on this page here')) }}
        </div>
    </div>

    <div class="row filter-row">
        <div class="columns small-12 text-center">
            <span id="name-count-val"></span> <span id="name-count-label">Names begin with:</span> <span id="name-count-letter" class="letter">{{{ $letter }}}</span>
        </div>
    </div>

    <div class="row">
    @foreach ($names as $name)
        <div class="columns small-3 text-center man-name left searchable @if ($name->name == $highlight) highlight @endif" data-index="{{ $name->name }}">
            {{ $name->name }}
        </div>
    @endforeach
    </div>

    <style id="filter-style"></style>
@stop

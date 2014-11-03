@extends('layouts.master')

@section('content')
    <div class="row ctr-filter">
        <div class="columns small-12">
            <i class="icon-help-circled"></i>
            <a href="#" class="button tiny radius">Clear Filter</a>
            {{ Form::text('filter', null, array('id'=>'filter', 'class'=>'text-center placeholder-fix', 'placeholder'=>'Filter the \''.strtoupper($letter).'\' names on this page')) }}
        </div>
    </div>

    <div class="row ctr-filter-help">
        <div class="columns small-12">
            By typing some letters in the <a href="">filter box</a>, you can narrow the list of names beginning with <span class="letter">{{{ $letter }}}</span>. As you type into the field, the names that do not match your filter will be removed from the display.
        </div>
    </div>

    <div class="row filter-row">
        <div class="columns small-12 text-center">
            <span id="name-count-val"></span> of {{{ $totalNames }}} <span id="name-count-label">Names begin with:</span> <span id="name-count-letter" class="letter">{{{ $letter }}}</span>
        </div>
    </div>

    @if ($names)
    <div class="row bordered name-list">
    @foreach ($names as $name)
        <div class="columns small-3 text-center man-name left searchable @if ($name->name == $highlight) highlight @endif" data-index="{{ strtolower($name->name) }}">
            {{ $name->name }}
        </div>
    @endforeach
    </div>
    @endif

    <style id="filter-style"></style>
@stop

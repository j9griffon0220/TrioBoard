@extends('layouts.board_base')
@section('board_content')
<h1>スレッド一覧</h1>
{{-- スレッド表示 --}}

<a href="{{ route('threads.create') }}">スレッド新規作成</a>
@endsection

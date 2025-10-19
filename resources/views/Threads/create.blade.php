@extends('layouts.board_base')
@section('board_content')
<h1>新規スレッド作成</h1>

<form action="{{ route('threads.store') }}" method="POST">
    @csrf
    <label for="">スレッドタイトル：</label>
    <input type="text" name="title" />
    <button type="submit">スレッド作成</button>
</form>
@endsection

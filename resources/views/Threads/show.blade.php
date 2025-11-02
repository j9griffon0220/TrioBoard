@extends('layouts.board_base')

{{-- livewireのpost-listをコンポーネントとして使う --}}
@section('board_content')

{{-- livewireコンポーネントに selectedthreadを渡す --}}
<livewire:post-list :selectedthread="$selectedthread  />

@endsection

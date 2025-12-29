{{-- 402 Payment Required（支払いが必要） --}}
{{-- 使わないエラーページはデフォルトのまま --}}
@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))

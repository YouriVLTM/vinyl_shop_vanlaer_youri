@extends('errors.minimal')
@section('title', __($exception->getMessage() ?: 'Forbidden'))
@section('code', '403')

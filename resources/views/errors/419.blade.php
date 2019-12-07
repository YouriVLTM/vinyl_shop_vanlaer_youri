@extends('errors.minimal')
@section('title', __($exception->getMessage() ?: 'Page expired'))
@section('code', '419')

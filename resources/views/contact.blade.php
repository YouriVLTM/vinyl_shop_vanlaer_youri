@extends('layouts.template')

@section('title', 'Welcome to The Vinyl Shop')

@section('css_after')
    <style>
        button > span{
            display: none;
        }
    </style>
@endsection

@section('main')

    <h1>Contact Us</h1>
    @include('shared.alert')

    @if (!session()->has('success'))
        <form action="/contact-us" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name"
                       class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                       placeholder="Your name"
                       required
                       value="{{ old('name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>

                <input type="email" name="email" id="email"
                       class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                       placeholder="Your email"
                       required
                       value="{{ old('email') }}">
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <select name="contact" id="contact"
                        class="form-control {{ $errors->first('contact') ? 'is-invalid' : '' }}"
                        placeholder="Your contact"
                        required
                        >
                    <option value="" {{ old('contact') == "" ? 'selected' : '' }}>Select a contact</option>
                    <option value="info" {{ old('contact') == "info" ? 'selected' : '' }}>Info</option>
                    <option value="billing" {{ old('contact') == "billing" ? 'selected' : '' }}>Billing</option>
                    <option value="support" {{ old('contact') == "support" ? 'selected' : '' }}>Support</option>
                </select>


                <div class="invalid-feedback">{{ $errors->first('contact') }}</div>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" rows="5"
                          class="form-control {{ $errors->first('message') ? 'is-invalid' : '' }}"
                          required
                          minlength="10">{{ old('message') }}</textarea>
                <div class="invalid-feedback">{{ $errors->first('message') }}</div>
            </div>
            <button type="submit" class="btn btn-success">Send Message</button>
        </form>
    @endif
@endsection
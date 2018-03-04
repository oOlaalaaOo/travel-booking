<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
    {{-- Fontawesome --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    
    <style type="text/css">
        :root {
          --input-padding-x: .75rem;
          --input-padding-y: .75rem;
        }
        .form-label-group {
          position: relative;
          margin-bottom: 1rem;
        }

        .form-label-group > input,
        .form-label-group > label {
          padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group > label {
          position: absolute;
          top: 0;
          left: 0;
          display: block;
          width: 100%;
          margin-bottom: 0; /* Override default `<label>` margin */
          line-height: 1.5;
          color: #495057;
          border: 1px solid transparent;
          border-radius: .25rem;
          transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
          color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
          color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
          color: transparent;
        }

        .form-label-group input::-moz-placeholder {
          color: transparent;
        }

        .form-label-group input::placeholder {
          color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
          padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
          padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown) ~ label {
          padding-top: calc(var(--input-padding-y) / 3);
          padding-bottom: calc(var(--input-padding-y) / 3);
          font-size: 12px;
          color: #777;
        }
    </style>
    @yield('more_styles')

    <title>Travel Booking Project</title>
  </head>
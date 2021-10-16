@extends('layouts.common')
@section('title', "404")
@section('content')

    <main class="main">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="demo1.html">Home</a></li>
                    <li>Error 404</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content error-404">
            <div class="container">
                <div class="banner">
                    <div class="banner-content text-center">
                        <h2 class="banner-title">
                            <span class="text-secondary">Oops!!!</span> {{$message}}
                        </h2>

                        <a href="/" class="btn btn-dark btn-rounded btn-icon-right">Go Back Home<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
@endsection

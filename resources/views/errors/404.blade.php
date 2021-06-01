@extends('layouts.master')

@section('style')
	@parent
@endsection

@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Error 404</h1>
                </div>
            </div>
        </section>
    </div>
    <section class="container main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="error_404">
                    <div>
                        <h2>404</h2>
                        <h3>Page not Found</h3>
                    </div>
                    <div class="clearfix"></div><br>
                    <a href="{{ route('home') }}" class="button large color margin_0">Home Page</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
	@parent
@endsection

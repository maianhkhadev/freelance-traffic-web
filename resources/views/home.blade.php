@extends('layouts.default')

@section('content')
  <div class="page page-home">
    <div class="container">
      <section class="section-introduce">
        <div class="section-content">
          <div class="row">
            <div class="col-xl-6">
              <h2 class="section-title">About this website</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat., quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="col-xl-6">
              <div class="video-container">
                <video autoplay muted loop>
                  <source src="http://fadigital.com.vn/wp-content/themes/fa/video/FA-Clip.mp4" type="video/mp4">
                  <p>Your browser does not support the video element.</p>
                </video>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-slider">

        <div class="section-header">
          <div class="row">
            <div class="col-xl-6 mx-auto">
              <h2 class="section-title">Creative showcase</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
        </div>

        <div class="section-content">
          <div class="slide"></div>
          <div class="slide"></div>
          <div class="slide"></div>
          <div class="slide"></div>
        </div>
      </section>
    </div>
  </div>
@endsection

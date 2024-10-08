@extends('layouts/contentLayoutMaster')

@section('title', 'Sliders')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/nouislider.min.css')) }}">
@endsection
@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sliders.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/core/colors/palette-noui.css')) }}">
@endsection

@section('content')
<!-- Bootstrap Sliders -->
<section id="bootstrap-slider">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header">
          <h4 class="card-title">Default Bootstrap 4 slider</h4>
        </div>
        <div class="card-body">
          <div class="mb-1">
            <label class="form-label" for="basic-range">Default</label>
            <input type="range" class="form-range" id="basic-range" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="disabled-range">Disabled</label>
            <input type="range" class="form-range" id="disabled-range" disabled />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Bootstrap Sliders -->

<!-- NoUI Horizontal Sliders -->

<!-- Slider values section -->
<section id="sliders-values">
  <div class="row match-height">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Slider Values</h4>
        </div>
        <div class="card-body">
          <h5 class="mb-2">Handles</h5>
          <div id="sliders-handles" class="my-1"></div>
          <h5 class="my-2">Snapping between steps</h5>
          <div id="sliders-snap" class="my-1"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Slider values section -->

<!-- Slider behavior section -->
<section id="sliders-behavior">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Slider behavior</h4>
        </div>
        <div class="card-body">
          <h5 class="mb-2">Tap</h5>
          <div id="tap" class="my-1"></div>

          <h5 class="my-2">Drag</h5>
          <div id="drag" class="my-1"></div>

          <h5 class="my-2">Fixed dragging</h5>
          <div id="drag-fixed" class="my-1"></div>

          <h5 class="my-2">Combined options</h5>
          <div id="combined" class="my-1"></div>

          <h5 class="my-2">Hover</h5>
          <div id="hover" class="my-1"></div>
          <span class="hover_val" id="hover-val"></span>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Slider behavior section -->

<!-- Slider Scales / Pips and Steps section -->
<section id="sliders-scales-pips">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="text-uppercase">Slider Scales / Pips</h4>
        </div>
        <div class="card-body">
          <div id="pips-range" class="mt-1 mb-3"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Slider Scales / Pips and Steps section -->

<!-- Slider Colors - Handles section -->
<section id="sliders-colors-handles">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Slider Colors - Handles</h4>
        </div>
        <div class="card-body">
          <h5 class="my-2">Default / Primary Color Slider</h5>
          <div id="default-color-slider" class="mt-md-1 mt-3 mb-4"></div>

          <h5 class="my-2">Success Color Slider</h5>
          <div id="success-color-slider" class="circle-filled sliders-success mt-md-1 mt-3 mb-4"></div>

          <h5 class="my-2">Secondary Color Slider</h5>
          <div id="secondary-color-slider" class="circle-filled sliders-secondary mt-md-1 mt-3 mb-4"></div>

          <h5 class="my-2">Warning Color Slider</h5>
          <div id="warning-color-slider" class="sliders-warning mt-md-1 mt-3 mb-4"></div>

          <h5 class="my-2">Danger Color Slider</h5>
          <div id="danger-color-slider" class="circle-filled sliders-danger mt-md-1 mt-3 mb-4"></div>

          <h5 class="my-2">Info Color Slider</h5>
          <div id="info-color-slider" class="square sliders-info mt-md-1 mt-3 mb-4"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Slider Colors - Handles section -->

<!-- Slider With Input Starts-->
<section id="sliders-input">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Slider With Input</h4>
        </div>
        <div class="card-body">
          <div class="my-1" id="sliders-with-input"></div>
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12 sliders-select d-sm-flex d-block">
              <select class="form-select me-1 mt-2 d-inline-block" id="sliders-select">
                <option value="-20">-20</option>
                <option value="-19">-19</option>
                <option value="-18">-18</option>
                <option value="-17">-17</option>
                <option value="-16">-16</option>
                <option value="-15">-15</option>
                <option value="-14">-14</option>
                <option value="-13">-13</option>
                <option value="-12">-12</option>
                <option value="-11">-11</option>
                <option value="-10">-10</option>
                <option value="-9">-9</option>
                <option value="-8">-8</option>
                <option value="-7">-7</option>
                <option value="-6">-6</option>
                <option value="-5">-5</option>
                <option value="-4">-4</option>
                <option value="-3">-3</option>
                <option value="-2">-2</option>
                <option value="-1">-1</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                <option value="32">32</option>
                <option value="33">33</option>
                <option value="34">34</option>
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
              </select>
              <input
                class="form-control d-inline-block mt-2"
                type="number"
                min="-20"
                max="40"
                step="1"
                id="sliders-input-number"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Slider With Input Ends-->

<!-- Vertical Sliders section -->
<section id="vsliders">
  <div class="row">
    <!-- Default Vertical Slider starts -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Vertical Default</h4>
        </div>
        <div class="card-body text-center">
          <div id="sliders-vertical"></div>
        </div>
      </div>
    </div>
    <!-- Default Vertical Slider ends -->

    <!-- Connect to Upper Vertical Slider starts -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Connect to upper</h4>
        </div>
        <div class="card-body text-center">
          <div id="connect-upper"></div>
        </div>
      </div>
    </div>
    <!-- Connect to Upper Vertical Slider ends -->
    <!-- Tooltip Vertical Slider starts -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tooltips</h4>
        </div>
        <div class="card-body text-center">
          <div id="sliders-tooltips" class="me-2"></div>
        </div>
      </div>
    </div>
    <!-- Tooltip Vertical Slider ends -->

    <!-- Limit Vertical Slider starts -->
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Limit</h4>
        </div>
        <div class="card-body text-center">
          <div id="vertical-limit"></div>
        </div>
      </div>
    </div>
    <!-- Limit Vertical Slider ends -->
  </div>
</section>
<!--/ Vertical Sliders section -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/extensions/wNumb.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/nouislider.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-sliders.js')) }}"></script>
@endsection

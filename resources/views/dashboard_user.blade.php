@extends('layouts.admin')
@section('content_layout')

<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">Bảng Thống kê</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">Xin chào {{ Auth::user()->fullname }}</li>
          </ol>
          <div class="state-information d-none d-sm-block">
            <div class="state-graph">
              <div id="header-chart-1"></div>
              <div class="info">Balance $ 2,317</div>
            </div>
            <div class="state-graph">
              <div id="header-chart-2"></div>
              <div class="info">Item Sold 1230</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end row -->

    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-xl-6">
          <div class="card m-b-30">
            <div class="card-body">

              <h4 class="mt-0 header-title">Tổng kết đánh giá cuối năm</h4>

              <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                <li class="list-inline-item">
                  <h5 class="mb-0">60</h5>
                  <p class="text-muted">Cộng sự</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">300</h5>
                  <p class="text-muted">Số đánh giá</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">2</h5>
                  <p class="text-muted">Chưa hoàn thành</p>
                </li>
              </ul>

              {{-- chart here --}}
              <canvas id="doughnutChart" height="300" width="470" style="width: 470px; height: 300px;"></canvas>

            </div>
          </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
          <div class="card m-b-30">
            <div class="card-body">

              <h4 class="mt-0 header-title">Thống kê 1</h4>

              <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                <li class="list-inline-item">
                  <h5 class="mb-0">45410</h5>
                  <p class="text-muted">Activated</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">4442</h5>
                  <p class="text-muted">Pending</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">3201</h5>
                  <p class="text-muted">Deactivated</p>
                </li>
              </ul>

              <canvas id="lineChart" height="300" width="470" style="width: 470px; height: 300px;"></canvas>

            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->


      <div class="row">
        <div class="col-xl-6">
          <div class="card m-b-30">
            <div class="card-body">

              {{-- chọn 3 cá nhân trong 1 đơn vị hoặc chọn 10 người giỏi nhất trong user --}}
              <h4 class="mt-0 header-title">Tổng kết cá nhân tốt</h4>

              <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                <li class="list-inline-item">
                  <h5 class="mb-0">5484</h5>
                  <p class="text-muted">Activated</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">964984</h5>
                  <p class="text-muted">Pending</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">98498</h5>
                  <p class="text-muted">Deactivated</p>
                </li>
              </ul>

              {{-- chart here --}}

            </div>
          </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
          <div class="card m-b-30">
            <div class="card-body">

              <h4 class="mt-0 header-title">Tổng kế 4</h4>

              <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                <li class="list-inline-item">
                  <h5 class="mb-0">86541</h5>
                  <p class="text-muted">Activated</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">2541</h5>
                  <p class="text-muted">Pending</p>
                </li>
                <li class="list-inline-item">
                  <h5 class="mb-0">102030</h5>
                  <p class="text-muted">Deactivated</p>
                </li>
              </ul>

              {{-- chart here --}}

            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>
    <!-- end page content-->

  </div> <!-- container-fluid -->

</div> <!-- content -->

<script>
  window.onload = function() {
    this.doughnutChart();
    this.lineChart();
  };
</script>
@endsection
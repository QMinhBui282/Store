@extends('layouts.admin')
@if(Auth::user()->role_id && Auth::user()->role_id == 4)
@section('content-header', 'Thống kê')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-lg-12 col-md-4 order-0">
                <div class="row">
                <form method="GET" action="{{ route('home') }}">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="interval" class="form-label">Khoảng thời gian</label>
                                <select class="form-control" id="interval" name="interval">
                                    <option value="day" {{ request('interval') == 'day' ? 'selected' : '' }}>Ngày</option>
                                    <option value="month" {{ request('interval') == 'month' ? 'selected' : '' }}>Tháng</option>
                                    <option value="year" {{ request('interval') == 'year' ? 'selected' : '' }}>Năm</option>
                                </select>
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary">Lọc</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(102, 102, 255, 1);transform: ;msFilter:;"><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle><path d="M13 13h2v-2.99h2.99v-2H15V5.03h-2v2.98h-2.99v2H13V13z"></path><path d="M10 17h8a1 1 0 0 0 .93-.64L21.76 9h-2.14l-2.31 6h-6.64L6.18 4.23A2 2 0 0 0 4.33 3H2v2h2.33l4.75 11.38A1 1 0 0 0 10 17z"></path></svg>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        

                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class=" mb-1">Đã bán</span>
                                <h3 class="card-title mb-2">{{ number_format(($income))}}{{ config('settings.currency_symbol') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(255, 102, 102, 1);transform: ;msFilter:;"><path d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-2 9h-2v-4h2v4zM5 7a1.001 1.001 0 0 1 0-2h13v2H5z"></path></svg>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <span>Công nợ khách hàng</span>
                                <h3 class="card-title text-nowrap mb-1">{{ number_format(($incomecus))}}{{ config('settings.currency_symbol') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(102, 102, 255, 1);transform: ;msFilter:;"><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle><path d="m14 13.99 4-5h-3v-4h-2v4h-3l4 5z"></path><path d="M17.31 15h-6.64L6.18 4.23A2 2 0 0 0 4.33 3H2v2h2.33l4.75 11.38A1 1 0 0 0 10 17h8a1 1 0 0 0 .93-.64L21.76 9h-2.14z"></path></svg>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <span>Nhập hàng</span>
                                <h3 class="card-title text-nowrap mb-1">{{ number_format(($incomep))}}{{ config('settings.currency_symbol') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(255, 102, 102, 1);transform: ;msFilter:;"><path d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-2 9h-2v-4h2v4zM5 7a1.001 1.001 0 0 1 0-2h13v2H5z"></path></svg>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block mb-1">Công nợ nhà cung cấp</span>
                                <h3 class="card-title text-nowrap mb-2">{{ number_format(($incomepur))}}{{ config('settings.currency_symbol') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Chart.js Canvas -->
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="salesChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar', // Change to 'line' or 'pie' or other types as needed
        data: {
            labels: ['Đã bán', 'Công nợ khách hàng', 'Nhập hàng', 'Công nợ nhà cung cấp'],
            datasets: [{
                label: 'Thống kê',
                data: [{{ $income }}, {{ $incomecus }}, {{ $incomep }}, {{ $incomepur }}],
                backgroundColor: [
                    'rgba(102, 102, 255, 0.2)',
                    'rgba(255, 102, 102, 0.2)',
                    'rgba(102, 102, 255, 0.2)',
                    'rgba(255, 102, 102, 0.2)'
                ],
                borderColor: [
                    'rgba(102, 102, 255, 1)',
                    'rgba(255, 102, 102, 1)',
                    'rgba(102, 102, 255, 1)',
                    'rgba(255, 102, 102, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            
        }
    });
});
</script>

@endsection
@endif
@if(Auth::user()->role_id && Auth::user()->role_id != 4)
@section('content')
<div class="content-wrapper">
    <h3 class="card-title mb-2">Xin chào {{ auth()->user()->role->name }} {{ auth()->user()->last_name }}</h3>
</div>
@endsection
@endif

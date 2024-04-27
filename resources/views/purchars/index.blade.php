@extends('layouts.admin')

@section('title', 'Danh sách nhập hàng')
@section('content-header', 'Danh sách nhập hàng')
@section('search')
        <form class="d-flex" action="{{ route('purchars.index') }}" method="GET" enctype="multipart/form-data">
@endsection
@section('content-actions')
    <a href="{{route('cargo.index')}}" class="btn btn-primary"><i class='bx bx-barcode-reader'></i> Nhập hàng</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5 px-4">
                <form action="{{route('purchars.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary" type="submit">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Người tạo</th>
                    <th>Nhà phân phối</th>
                    <th>Tổng giá trị</th>
                    <th>Số tiền đã thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Tiền nợ</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                ?>
                @foreach ($purchars as $purchar)
                <tr>
                    <td>{{$purchar->id}}</td>
                    <td>{{$purchar->user->last_name}}</td>
                    <td><a href="{{ route('purchars.show', $purchar) }}">{{$purchar->getSupplierName()}}</a></td>
                    <td>{{number_format($purchar->total()-$purchar->receivedDiscount())}} {{ config('settings.currency_symbol') }}</td>
                    <td>{{$purchar->formattedReceivedAmount()}} {{config('settings.currency_symbol') }}</td>
                    <td>
                        @if($purchar->receivedAmount() == 0)
                            <span class="badge bg-label-danger me-1">NỢ</span>
                        @elseif($purchar->receivedAmount() < $purchar->total()-$purchar->receivedDiscount())
                            <span class="badge bg-label-warning me-1">Một phần</span>
                        @elseif($purchar->receivedAmount() == $purchar->total()-$purchar->receivedDiscount())
                            <span class="badge bg-label-success me-1">TRẢ ĐỦ</span>
                        @elseif($purchar->receivedAmount() > $purchar->total()-$purchar->receivedDiscount())
                            <span class="badge bg-label-info me-1">Dư</span>
                        @endif
                    </td>
                    <td> {{number_format($purchar->total() - $purchar->receivedAmount())}} {{config('settings.currency_symbol')}}</td>
                    <td>{{$purchar->created_at}}</td>
                </tr>
                
                @endforeach 
                @foreach ($purcharss as $purchar)
                <?php $i++ ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{$i}} đơn</th>
                    <th>{{ number_format($total) }} {{ config('settings.currency_symbol') }}</th>
                    <th>{{ number_format($receivedAmount) }} {{ config('settings.currency_symbol') }}</th>
                    <th></th>
                    <th>{{ number_format($total-$receivedAmount) }} {{ config('settings.currency_symbol') }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $purchars->render() }}
    </div>
</div>
@endsection


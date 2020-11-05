@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">لیست نظرات

                        @if($list=='all')

                        @elseif('awaiting')
                            در انتظار تایید
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.product_reviews.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>کاربر</th>
                                    <th>نظر</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productReviews as $key=>$productReview)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$productReview->user->name}}</th>
                                        <th>{{\Illuminate\Support\Str::limit($productReview->review,50)}}</th>

                                        <th>
                                            @include('admin.product_reviews.actions',['productReview'=>$productReview])
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div id="reviewShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="myModalLabel">ویرایش نظر</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-ui dt-sl">
                                                    <form class="form-account" method="post" action="" style="max-width: 100%">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="row">

                                                            <div class="col-12 mb-2">
                                                                <div class="form-row-title">
                                                                    <h4>
                                                                        نظر کاربر
                                                                    </h4>
                                                                </div>
                                                                <div class="form-row">
                                                                    <input type="hidden" name="review">
                                                                    <textarea name="review"
                                                                              rows="10"
                                                                              class="form-control p-2"
                                                                              placeholder=""></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-2">
                                                                <div class="form-row-title">
                                                                    <h4>
                                                                        امتیاز
                                                                    </h4>
                                                                </div>
                                                                <div class="form-row" id="question_text">
                                                                    <input name="rate"
                                                                           min="1"
                                                                           max="5"
                                                                           type="number"
                                                                           class="form-control p-2 text-right"
                                                                           placeholder="" value="">
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-2">
                                                                <div class="form-row-title">
                                                                    <h4>
                                                                        وضعیت
                                                                    </h4>
                                                                </div>
                                                                <div class="form-row" id="question_text">
                                                                    <select name="status"
                                                                           type="number"
                                                                           class="form-control p-2 text-right">
                                                                        <option value="0">در انتظار تایید</option>
                                                                        <option value="1">تایید شده</option>
                                                                        <option value="-1">رد شده</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 pr-4 pl-4">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-primary btn-submit-form">
                                                                    ویرایش و ثبت
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->

        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    </div>
@endsection
@section('script')
    <script>
        $('#reviewShow').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var review = button.data('review');
            var action = button.data('action');
            var modal = $(this);

            modal.find('form').attr('action',action);
            modal.find('textarea[name=review]').text(review.review);
            modal.find('input[name=rate]').val(review.rate);
            modal.find('select[name=status]').find('option[value='+review.status+']').attr('selected','selected');
        })
    </script>
@endsection
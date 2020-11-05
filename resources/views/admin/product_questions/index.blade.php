@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">لیست پرسش و پاسخ

                        @if($list=='all')

                        @elseif('awaiting')
                            در انتظار تایید

                        @elseif('failed')
                            رد شده
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.product_questions.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>کاربر</th>
                                    <th>پرسش / پاسخ</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productQuestions as $key=>$productQuestion)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$productQuestion->user->name}}</th>
                                        <th>{{\Illuminate\Support\Str::limit($productQuestion->content,50)}}</th>

                                        <th>
                                            @include('admin.product_questions.actions',['productQuestion'=>$productQuestion])
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div id="questionShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="myModalLabel">ویرایش پرسش/پاسخ</h5>
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
                                                                        پرسش / پاسخ
                                                                    </h4>
                                                                </div>
                                                                <div class="form-row">
                                                                    <input type="hidden" name="review">
                                                                    <textarea name="content"
                                                                              rows="10"
                                                                              class="form-control p-2"
                                                                              placeholder=""></textarea>
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
        $('#questionShow').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var question = button.data('question');
            var action = button.data('action');
            var modal = $(this);

            modal.find('form').attr('action',action);
            modal.find('textarea[name=content]').text(question.content);
            modal.find('select[name=status]').find('option[value='+question.status+']').attr('selected','selected');
        })
    </script>
@endsection
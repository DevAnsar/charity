@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                             aria-labelledby="nav-home-tab">
                            <cart
                                    img_env="{{env('IMG')}}"
                                    @delete-product="deleteProductInBasket"
                                    @get-set-basket="BasketChange"
                                    authenticated="{{auth()->check()}}"
                            ></cart>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
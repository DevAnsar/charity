@extends('store.profile.master')
@section('profile-content')

    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div
                        class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2 px-res-1">
                    <h2>آدرس ها</h2>
                </div>
                <div class="dt-sl">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card-horizontal-address text-center px-4">
                                <button class="checkout-address-location" data-toggle="modal"
                                        data-target="#modal-location">
                                    <strong>ایجاد آدرس جدید</strong>
                                    <i class="mdi mdi-map-marker-plus"></i>
                                </button>
                            </div>
                        </div>

                        @foreach($addresses as $key=>$address)
                            <div class="col-lg-6 col-md-12">
                                <div class="card-horizontal-address">
                                    <div class="card-horizontal-address-desc">
                                        <h4 class="card-horizontal-address-full-name">
                                            {{$address->receiver}}
                                        </h4>
                                        <p>
                                            {{$address->state}}
                                            ،
                                            {{$address->city}}
                                            ،
                                            {{$address->address}}
                                        </p>
                                    </div>
                                    <div class="card-horizontal-address-data">
                                        <ul class="card-horizontal-address-methods float-right">
                                            <li class="card-horizontal-address-method">
                                                <i class="mdi mdi-email-outline"></i>
                                                کدپستی : <span>
                                                {{$address->postal_code}}
                                            </span>
                                            </li>
                                            <li class="card-horizontal-address-method">
                                                <i class="mdi mdi-cellphone-iphone"></i>
                                                تلفن همراه : <span>
                                                {{$address->mobile}}
                                            </span>
                                            </li>
                                        </ul>

                                        <div class="card-horizontal-address-actions">
                                            <button class="btn-note" data-toggle="modal"
                                                    data-target="#modal-location-edit"
                                                    data-address_id="{{$address->id}}"
                                                    data-receiver="{{$address->receiver}}"
                                                    data-mobile="{{$address->mobile}}"
                                                    data-postal_code="{{$address->postal_code}}"
                                                    data-address="{{$address->address}}"
                                            >
                                                ویرایش
                                            </button>
                                            <button class="btn-note" data-toggle="modal"
                                                    data-target="#remove-location"
                                                    data-address="{{$address->id}}"
                                            >حذف
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>


                <!-- Start Modal location new -->
                <div class="modal fade" id="modal-location" role="dialog" aria-labelledby="exampleModalCenterTitle"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg send-info modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                    <i class="now-ui-icons location_pin"></i>
                                    افزودن آدرس جدید
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-ui dt-sl">

                                            <form class="form-account" method="post"
                                                  action="{{route('site.profile.addresses.new')}}">
                                                @csrf
                                                @method('post')
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 mb-2">
                                                        <div class="form-row-title">
                                                            <h4>
                                                                نام و نام خانوادگی
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                            <input class="input-ui pr-2 text-right" type="text"
                                                                   name="receiver"
                                                                   placeholder="نام تحویل گیرنده را وارد نمایید"
                                                                   required
                                                                   autofocus
                                                                   autocomplete="receiver"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-2">
                                                        <div class="form-row-title">
                                                            <h4>
                                                                شماره موبایل
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                            <input class="input-ui pl-2 dir-ltr text-left" type="number"
                                                                   name="mobile"
                                                                   placeholder="09xxxxxxxxx"
                                                                   required
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-2">
                                                        <div class="form-row-title">
                                                            <h4>
                                                                استان
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="custom-select-ui">
                                                                <select class="right" name="state_id" required>

                                                                    <option value="1">
                                                                        تهران
                                                                    </option>
                                                                    <option value="esfahan">
                                                                        اصفهان
                                                                    </option>
                                                                    <option value="shiraz">
                                                                        شیراز
                                                                    </option>
                                                                    <option value="tabriz">
                                                                        تبریز
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-2">
                                                        <div class="form-row-title">
                                                            <h4>
                                                                شهر
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="custom-select-ui">
                                                                <select class="right" name="city_id" required>
                                                                    <option value="2">
                                                                        بجنورد
                                                                    </option>
                                                                    <option value="garme">
                                                                        گرمه
                                                                    </option>
                                                                    <option value="shirvan">
                                                                        شیروان
                                                                    </option>
                                                                    <option value="mane">
                                                                        مانه و سملقان
                                                                    </option>
                                                                    <option value="esfarayen">
                                                                        اسفراین
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <div class="form-row-title">
                                                            <h4>
                                                                آدرس پستی
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                    <textarea class="input-ui pr-2 text-right" name="address"
                                                              placeholder=" آدرس تحویل گیرنده را وارد نمایید"
                                                              required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <div class="form-row-title">
                                                            <h4>
                                                                کد پستی
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                            <input name="postal_code"
                                                                   class="input-ui pl-2 dir-ltr text-left placeholder-right"
                                                                   type="number"
                                                                   required
                                                                   placeholder=" کد پستی را بدون خط تیره بنویسید">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pr-4 pl-4">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-primary btn-submit-form">
                                                            ثبت آدرس
                                                        </button>
                                                        <button type="button" class="btn-link-border float-left mt-2">
                                                            انصراف
                                                            و بازگشت
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <!-- Google Map Start -->
                                        <div class="goole-map">
                                            <div id="map" style="height:440px"></div>
                                        </div>
                                        <!-- Google Map End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal location new -->

                <!-- Start Modal location edit -->
                @include('store.address_actions.edit')
                <!-- End Modal location edit -->


                <!-- Start Modal remove-location -->
                <div class="modal fade" id="remove-location" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action=""
                                  method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-header">
                                    <h5 class="modal-title mb-3" id="exampleModalLabel">آیا مطمئنید که
                                        این آدرس حذف شود؟</h5>
                                </div>
                                <div class="modal-footer">


                                    <button type="button"
                                            class="remodal-general-alert-button remodal-general-alert-button--cancel"
                                            data-dismiss="modal">خیر
                                    </button>

                                    <button type="submit"
                                            class="remodal-general-alert-button remodal-general-alert-button--approve">
                                        بله
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal remove-location -->
                @yield('address-content')
            </div>
        </div>
    </div>

@endsection
@section('script')
    <!-- google map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAq7MrCR1A2qIShmjbtLHSKjcEIEBEEwM"></script>
    <script>
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);
        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 11,

                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(23.761226, 90.420766), // New York

                // How you would like to style the map.
                // This is where you would paste any style found on Snazzy Maps.
                styles: [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#444444"
                    }]
                },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{
                            "color": "#f2f2f2"
                        }]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{
                            "saturation": -100
                        },
                            {
                                "lightness": 45
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "simplified"
                        }]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{
                            "color": "#314453"
                        },
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [{
                            "lightness": "-12"
                        },
                            {
                                "saturation": "0"
                            },
                            {
                                "color": "#4bc7e9"
                            }
                        ]
                    }
                ]
            };

            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen below in the <body>
            var mapNew = document.getElementById('map');
            var mapEdit = document.getElementById('map-edit');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapNew, mapOptions);
            var mapEdit = new google.maps.Map(mapEdit, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(23.761226, 90.420766),
                map: map,
                title: 'Snazzy!'
            });
        }
    </script>

    <script>
        $('#remove-location').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let address_id = button.data('address');
            let modal = $(this);

            modal.find('form').attr('action', "/profile/address/" + address_id + "/delete");

        });

        $('#modal-location-edit').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let address_id = button.data('address_id');
            let receiver = button.data('receiver');
            console.log('receiver', receiver);
            let mobile = button.data('mobile');
            let postal_code = button.data('postal_code');
            let address = button.data('address');

            let modal = $(this);

            modal.find('form').attr('action', "/profile/address/" + address_id + "/update");
            modal.find('input[name=receiver]').val(receiver);
            modal.find('input[name=mobile]').val(mobile);
            modal.find('input[name=postal_code]').val(postal_code);
            modal.find('textarea[name=address]').text(address);

        })
    </script>
@endsection
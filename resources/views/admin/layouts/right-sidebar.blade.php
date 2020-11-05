<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">
            <form action="{!! route('site.logout') !!}" method="post">
                @csrf
                @method('post')
                <button type="submit"  class="dropdown-item text-danger" href="#">
                    <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                    Logout
                </button>
            </form>
        </h6>

        <div class="p-4">
            <div class="mb-2">
                {{--<img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">--}}
            </div>
            <div class="custom-control custom-switch mb-3">
                {{--<input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />--}}
                {{--<label class="custom-control-label" for="light-mode-switch">Light Mode</label>--}}
            </div>

        </div>

    </div>
    <!-- end slimscroll-menu-->
</div>
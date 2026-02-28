<footer class="footer px-4 d-flex flex-row justify-content-start">
    {{--
      This "powered by phpVMS" must be kept visible. as-per the the license
      If you want to remove the attribution, a license can be purchased
      https://docs.phpvms.net/#license
      --}}
    <div class="p-3">
        powered by <a href="http://www.phpvms.net" target="_blank">phpvms</a>
    </div>
    <div class="p-3">
        Apex and accompanying Modules by <a href="https://cardinalhorizon.com/">Cardinal Horizon</a>.
    </div>
    @if(check_module('DisposableSpecial') || check_module('DisposableBasic'))
        <div class="p-3">
            <a href="https://github.com/FatihKoz/" target="_blank" class="menu-link px-2">
                Disposable @if(check_module('DisposableSpecial')) Extended Pack @elseif(check_module('DisposableBasic')) Basic Pack @endif
            </a>
        </div>
    @endif
</footer>

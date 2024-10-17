<footer class="footer py-4  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    by
                    @php
                        $company = \App\Models\Company::first();
                    @endphp
                    <a href="javascript:void(0);" class="font-weight-bold text-primary"
                        >{{ $company->name }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<x-app-layout>
    <!-- Form step -->
    <link href="{{ asset('AppealLab/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AppealLab/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">

    <style>
        .content-body .container {
            margin-top: 40px !important;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <div class="card-title">
                            <div class="text-center">
                                <img class="mg5" src="{{ asset('AppealLab/images/walmart-logo.png') }}" width="60px" alt="">
                                <h3>Connect to your Selected Marketplace</h3>
                                <p style="font-size: 16px; color: gray;">we help you to connect securely with multiple plateform</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                <strong>Error!</strong>  {{ Session::get('error') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                <strong>Success!</strong>  {{ Session::get('success') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>
                        @endif


                        <form method="post" action="{{ route('dashboard.marketplace.walmart.integration') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Store Name</label>
                                        <input type="text" name="clientName" id="clientName" value="{{ old('clientName') }}" class="form-control">
                                        @error('clientName')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Client ID</label>
                                        <input type="text" name="clientID" id="clientID" value="{{ old('clientID') }}" class="form-control">
                                        @error('clientID')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="text-label">Client Secret</label>
                                        <input type="text" name="clientSecretID" id="clientSecretID" value="{{ old('clientSecretID') }}" class="form-control">
                                        @error('clientSecretID')
                                        <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary shadow btn-lg btn-submit">Connect</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .sw-theme-default {
        border: 1px solid white;
    }
</style>


<script src="{{ asset('AppealLab/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('AppealLab/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>




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
        <div class="page-titles">
            <!-- <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Wizard</a></li>
            </ol> -->
        </div>
        <div class="card-header justify-content-center">
            <div class="card-title">
                <div class="text-center">
                    <img class="mg5" src="{{ asset('AppealLab/images/walmart-logo.png') }}" width="60px" alt="">
                    <h3>Connect to your Selected Marketplace</h3>
                    <p style="font-size: 16px; color: gray;">we help you to connect securely with multiple plateform</p>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">

            <div class="col-xl-12 col-xxl-12">
                <div class="card">

                    <div class="card-body">
                        <div id="smartwizard" class="form-wizard order-create">
                            <ul class="nav nav-wizard">
                                <li><a class="nav-link" href="#wizard_Service">
                                        <span>1</span>
                                    </a></li>
                                <li><a class="nav-link" href="#wizard_Time">
                                        <span>2</span>
                                    </a></li>
                                <!-- <li><a class="nav-link" href="#wizard_Details">
                                    <span>3</span>
                                </a></li>
                                <li><a class="nav-link" href="#wizard_Payment">
                                    <span>4</span>
                                </a></li> -->
                            </ul>
                            <div class="tab-content" style="margin-top: 30px;">
                                <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <p>Step 1: Navigate to walmart Seller Centrol</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <p>a) Login to Walmart Developer Portal</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <a href="{{ url('dashboard') }}" class="btn btn-primary shadow btn-xs">Go to Dashboard</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <p>b Get the Production keys (My API Key) in keys section</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <p>Step 2: Copy and Paste the Credentials</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group">
                                                <p>Copy and paste the Client ID and Client Secret from the Walmart developerr centerr to the corresponding fields:</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="wizard_Time" class="tab-pane" role="tabpanel">
                                    <h4 id="result"></h4>
                                    <form id="resetForm" name="resetForm">
                                        <input type="hidden" id="token" value="{{ csrf_token() }}">

                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <label class="text-label">WelCome StoreFront Name</label>
                                                    <input type="text" name="clientName" id="clientName" class="form-control">
                                                    <span style="color: red;" class="testing" id="name"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <label class="text-label">Client ID</label>
                                                    <input type="text" name="clientID" id="clientID" class="form-control">
                                                    <span style="color: red;" id="id"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="form-group">
                                                    <label class="text-label">Client Secret</label>
                                                    <input type="text" name="clientSecretID" id="clientSecretID" class="form-control">
                                                    <span style="color: red;" id="secret"></span>
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

<script>
    $(document).ready(function(){
        $('.btn-submit').click(function(e){
            e.preventDefault();

            var _token = $('#token').val();
            var clientName = $('#clientName').val();
            var clientID = $('#clientID').val();
            var clientSecretID = $('#clientSecretID').val();

            $.ajax({

                url: "walmart/add",
                type: "post",
                data: {

                    "_token": _token,
                    "clientName": clientName,
                    "clientID": clientID,
                    "clientSecretID": clientSecretID

                },

                success:function(response){

                    if(response.success)
                    {
                        document.getElementById("resetForm").reset();
                        $('#result').html(response.success)
                        $('#secret').hide();

                        // top.location.href="../";//redirection
                    }
                    else
                    {
                        $('#result').html(response.error);
                        $('span').hide();s
                    }
                },
                error:function(response){

                    $('#name').html(response.responseJSON.errors.clientName);
                    $('#id').html(response.responseJSON.errors.clientID);
                    $('#secret').html(response.responseJSON.errors.clientSecretID);
                }

            });

        });
    });
</script>

<script>
    $(document).ready(function(){
        // SmartWizard initialize
        $('#smartwizard').smartWizard();
        $('#result').html(response.success)
    });
</script>


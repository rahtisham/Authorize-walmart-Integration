<x-app-layout>

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Orders</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                @if(\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Appeal Lab!</strong> {{ \Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Orders</h4>
                    </div>

                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="{{ route('dashboard.order-status-check') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="clientName" value="Muhammad Ahtisham" class="form-control input-default " placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="clientID" value="3db5b332-a208-4dec-bafe-153f7c026e78" class="form-control input-rounded" placeholder="Client ID">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="clientSecretID" value="Up_Q9FXoQaFO3EjUePvpCKoSDbW5XlHjBmU1qeSwTEpH0inL37aSuRiZ7HvHOT9GEfaxM7-I_rzf7t54OVd-HA" class="form-control input-rounded" placeholder="Client Secret">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

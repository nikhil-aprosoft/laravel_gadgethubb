<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Delivery Management</title>
    <x-admin.head />
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <x-admin.aside-menu />
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <x-admin.navbar />
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="app-ecommerce">
                            <!-- Notification Section -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Tabs Navigation -->
                            <ul class="nav nav-tabs mb-4" id="crudTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="create-tab" data-bs-toggle="tab" href="#create"
                                        role="tab" aria-controls="create" aria-selected="true">Create</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="read-tab" data-bs-toggle="tab" href="#read"
                                        role="tab" aria-controls="read" aria-selected="false">View</a>
                                </li>                            
                            </ul>

                            <!-- Tabs Content -->
                            <div class="tab-content" id="crudTabsContent">
                                <!-- Create Tab -->
                                <div class="tab-pane fade show active" id="create" role="tabpanel"
                                    aria-labelledby="create-tab">
                                    <form id="create-form" action="{{ route('deliveries.store') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Create Delivery</h5>
                                             
                                                <div class="mb-3">
                                                    <label for="from" class="form-label">From</label>
                                                    <input type="number" class="form-control" id="from"
                                                        name="from" placeholder="Enter 'From' value" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="to" class="form-label">To</label>
                                                    <input type="number" class="form-control" id="to"
                                                        name="to" placeholder="Enter 'To' value" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cost" class="form-label">Cost</label>
                                                    <input type="number" class="form-control" id="from"
                                                        name="cost" placeholder="Enter  Cost" required />
                                                </div>
                                                <button type="submit" class="btn btn-primary">Create Delivery</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Read Tab -->
                                <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Delivery List</h5>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>To</th>
                                                        <th>From</th>
                                                        <th>Cost</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($deliveries as $index => $delivery)
                                                        <tr>
                                                            <!-- Use $index to auto-increment the row number -->
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $delivery->to }}</td>
                                                            <td>{{ $delivery->from }}</td>
                                                            <td>{{ $delivery->cost }}</td>

                                                            <td>
                                                                <form action="{{ route('deliveries.destroy', $delivery) }}"      method="POST" style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

</body>

</html>

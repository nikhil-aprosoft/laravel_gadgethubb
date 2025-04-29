<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Category</title>
    <x-admin.head />
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidebar -->
            <x-admin.aside-menu />

            <div class="layout-page">
                <!-- Navbar -->
                <x-admin.navbar />

                <!-- Content -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="app-ecommerce">
                            @if (session('success'))
                            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
                                <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body">
                                            {{ session('success') }}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                            <!-- Alerts -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
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
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                                <h4 class="mb-1">Add a new Category</h4>
                                <div class="d-flex gap-2">
                                    <button type="button" id="discard-button" class="btn btn-outline-primary">Discard</button>
                                    <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Add Category
                                    </button>
                                </div>
                            </div>
                            <!-- Form Header -->
                                <!-- Categories Table -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parentCategories as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#{{ $item->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ url('admin/delete-parent-category/' . $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal for Each Category -->
                                            <div class="modal fade" id="{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ url('admin/update-parent-categories/' . $item->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel{{ $item->id }}">Edit Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
                                                                    <label>Category Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>

                            <!-- Add Category Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('create-parent-categories') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="name" id="ecommerce-category-title" required>
                                                    <label for="ecommerce-category-title">Category Name</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /.app-ecommerce -->
                    </div> <!-- /.container -->
                </div> <!-- /.content-wrapper -->
            </div> <!-- /.layout-page -->
        </div> <!-- /.layout-container -->

        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div> <!-- /.layout-wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>
</body>

</html>

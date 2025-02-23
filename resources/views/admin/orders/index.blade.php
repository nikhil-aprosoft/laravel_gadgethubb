 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8" />
     <meta name="viewport"
         content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
     <title>All Orders</title>
     <script src="{{ asset('admin_asset/vendor/libs/datatables-bs5/datatables-bootstrap5.css') }}"></script>
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

                 <!-- Content wrapper -->
                 <div class="content-wrapper">
                     <!-- Content -->
                     <div class="container-xxl flex-grow-1 container-p-y">
                         <!-- Order List Widget -->
                         <div class="card mb-6">
                             <div class="card-widget-separator-wrapper">
                                 <div class="card-body card-widget-separator">
                                     <div class="row gy-4 gy-sm-1">
                                         <div class="col-sm-6 col-lg-3">
                                             <div
                                                 class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                                 <div>
                                                     <h4 class="mb-0">{{ $pendingPayments }}</h4>
                                                     <p class="mb-0">Pending Payment</p>
                                                 </div>
                                                 <div class="avatar me-sm-6">
                                                     <span
                                                         class="avatar-initial rounded bg-label-secondary text-heading">
                                                         <i class="ri-calendar-2-line ri-24px"></i>
                                                     </span>
                                                 </div>
                                             </div>
                                             <hr class="d-none d-sm-block d-lg-none me-6">
                                         </div>
                                         <div class="col-sm-6 col-lg-3">
                                             <div
                                                 class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                                                 <div>
                                                     <h4 class="mb-0">{{ $completedOrders }}</h4>
                                                     <p class="mb-0">Completed</p>
                                                 </div>
                                                 <div class="avatar me-lg-6">
                                                     <span
                                                         class="avatar-initial rounded bg-label-secondary text-heading">
                                                         <i class="ri-check-double-line ri-24px"></i>
                                                     </span>
                                                 </div>
                                             </div>
                                             <hr class="d-none d-sm-block d-lg-none">
                                         </div>
                                         <div class="col-sm-6 col-lg-3">
                                             <div
                                                 class="d-flex justify-content-between align-items-start border-end pb-4 pb-sm-0 card-widget-3">
                                                 <div>
                                                     <h4 class="mb-0">{{ $refundedOrders }}</h4>
                                                     <p class="mb-0">Refunded</p>
                                                 </div>
                                                 <div class="avatar me-sm-6">
                                                     <span
                                                         class="avatar-initial rounded bg-label-secondary text-heading">
                                                         <i class="ri-wallet-3-line ri-24px"></i>
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-sm-6 col-lg-3">
                                             <div class="d-flex justify-content-between align-items-start">
                                                 <div>
                                                     <h4 class="mb-0">{{ $failedOrders }}</h4>
                                                     <p class="mb-0">Failed</p>
                                                 </div>
                                                 <div class="avatar">
                                                     <span
                                                         class="avatar-initial rounded bg-label-secondary text-heading">
                                                         <i class="ri-error-warning-line ri-24px"></i>
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!-- Order List Table -->
                         <div class="card">
                             <div class="card-datatable table-responsive">
                                 <div id="DataTables_Table_0_wrapper"
                                     class="dataTables_wrapper dt-bootstrap5 no-footer">
                                     <div class="card-header d-flex flex-column flex-md-row align-items-start align-items-md-center py-0 pb-5 pb-md-0"
                                         style="justify-content: space-between;margin: 19px;">
                                         <div>
                                             <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                 <form method="GET" action="{{ route('orders.index') }}">
                                                     <input type="search" name="search"
                                                         class="form-control form-control-sm ms-0"
                                                         placeholder="Search Order" value="{{ request('search') }}">
                                                 </form>
                                             </div>
                                         </div>
                                         <div class="d-flex align-items-md-baseline justify-content-md-end gap-4">
                                             <div class="dataTables_length my-0" id="DataTables_Table_0_length">
                                                 <form method="GET" action="{{ route('orders.index') }}">
                                                     <select name="length" aria-controls="DataTables_Table_0"
                                                         class="form-select form-select-sm"
                                                         onchange="this.form.submit()">
                                                         <option value="10"
                                                             {{ request('length') == 10 ? 'selected' : '' }}>10</option>
                                                         <option value="40"
                                                             {{ request('length') == 40 ? 'selected' : '' }}>40</option>
                                                         <option value="60"
                                                             {{ request('length') == 60 ? 'selected' : '' }}>60
                                                         </option>
                                                         <option value="80"
                                                             {{ request('length') == 80 ? 'selected' : '' }}>80
                                                         </option>
                                                         <option value="100"
                                                             {{ request('length') == 100 ? 'selected' : '' }}>100
                                                         </option>
                                                     </select>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                     <table class="datatables-order table dataTable no-footer dtr-column"
                                         id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                                         <thead>
                                             <tr>
                                                 <th><input type="checkbox" class="form-check-input"></th>
                                                 <th>Order</th>
                                                 <th>Date</th>
                                                 <th>Customers</th>
                                                 <th>Payment</th>
                                                 <th>Method</th>
                                                 <th>Delivery Status</th>
                                                 <th>Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @forelse ($orders as $order)
                                                 <tr>
                                                     <td><input type="checkbox" class="dt-checkboxes form-check-input">
                                                     </td>
                                                     <td><a href="#">{{ $order->order_no ?? 'N/A' }}</a></td>
                                                     <td>{{ $order->created_at->format('M d, Y, H:i') }}</td>
                                                     <td>
                                                         <div
                                                             class="d-flex justify-content-start align-items-center user-name">
                                                             <div class="d-flex flex-column">
                                                                 <a href="#" class="text-truncate text-heading">
                                                                     <span
                                                                         class="fw-medium">{{ $order->user->name }}</span>
                                                                 </a>
                                                                 <small
                                                                     class="text-truncate">{{ $order->user->email }}</small>
                                                             </div>
                                                         </div>
                                                     </td>
                                                     @if ($order->payments && $order->payments->isNotEmpty())
                                                         @php $payment = $order->payments->first(); @endphp
                                                         <td>
                                                            <h6 class="mb-0 w-px-100 d-flex align-items-center 
                                                            {{ $payment->payment_status == 'Paid' ? 'text-success' : 'text-warning' }}">
                                                            <i class="ri-circle-fill ri-10px me-1"></i>
                                                            {{ $payment->payment_status }}
                                                        </h6>
                                                        
                                                         </td>
                                                         <td>
                                                             <div class="d-flex align-items-center text-nowrap">
                                                                 <span>{{ ucfirst($payment->payment_source) }}</span>
                                                             </div>
                                                         </td>
                                                     @else
                                                         <td colspan="2">No payment info</td>
                                                     @endif
                                                     <td>
                                                         <div class="d-flex align-items-center text-nowrap">
                                                             <span>{{ ucfirst($order->delivery_status ?? 'Pending') }}</span>
                                                         </div>
                                                     </td>
                                                     <td>
                                                         <div>
                                                             <button
                                                                 class="btn btn-sm btn-icon btn-text-secondary text-body waves-effect rounded-pill dropdown-toggle hide-arrow"
                                                                 data-bs-toggle="dropdown">
                                                                 <i class="ri-more-2-line"></i>
                                                             </button>
                                                             <div class="dropdown-menu dropdown-menu-end m-0">
                                                                <a href="{{ url('admin/orders/order-details', ['order' => $order->order_no]) }}" class="dropdown-item">View</a>

                                                            </div>
                                                         </div>
                                                     </td>
                                                 </tr>
                                             @empty
                                                 <tr>
                                                     <td colspan="8">No orders found.</td>
                                                 </tr>
                                             @endforelse
                                         </tbody>
                                     </table>
                                     <div class="row mx-1 m-4">
                                      <div class="col-sm-12 col-md-6">
                                          <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                              Displaying {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                                          </div>
                                      </div>
                                      <div class="col-sm-12 col-md-6">
                                          <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                              <ul class="pagination">
                                                  <!-- Previous Page -->
                                                  <li class="paginate_button page-item {{ $currentPage <= 1 ? 'disabled' : '' }}" id="DataTables_Table_0_previous">
                                                      <a href="{{ $currentPage > 1 ? route('orders.index', ['page' => $currentPage - 1]) : '#' }}" 
                                                         aria-controls="DataTables_Table_0" 
                                                         aria-disabled="{{ $currentPage <= 1 }}" 
                                                         role="link" 
                                                         data-dt-idx="previous" 
                                                         tabindex="-1" 
                                                         class="page-link">Previous</a>
                                                  </li>
                                  
                                                  <!-- Page Numbers -->
                                                  @for ($i = 1; $i <= $totalPages; $i++)
                                                      <li class="paginate_button page-item {{ $currentPage == $i ? 'active' : '' }}">
                                                          <a href="{{ route('orders.index', ['page' => $i]) }}"
                                                             aria-controls="DataTables_Table_0"
                                                             role="link"
                                                             data-dt-idx="{{ $i - 1 }}"
                                                             tabindex="{{ $i }}"
                                                             class="page-link">{{ $i }}</a>
                                                      </li>
                                                  @endfor
                                  
                                                  <!-- Ellipsis (if necessary) -->
                                                  @if($totalPages > 5 && $currentPage < $totalPages - 2)
                                                      <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis">
                                                          <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                                                      </li>
                                                  @endif
                                  
                                                  <!-- Next Page -->
                                                  <li class="paginate_button page-item {{ $currentPage >= $totalPages ? 'disabled' : '' }}" id="DataTables_Table_0_next">
                                                      <a href="{{ $currentPage < $totalPages ? route('orders.index', ['page' => $currentPage + 1]) : '#' }}" 
                                                         aria-controls="DataTables_Table_0" 
                                                         role="link" 
                                                         data-dt-idx="next" 
                                                         tabindex="{{ $currentPage + 1 }}" 
                                                         class="page-link">Next</a>
                                                  </li>
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                                  
                                     <div style="width: 1%;"></div>                                     
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- / Content -->
             </div>

         </div>

         <!-- Core JS -->
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

         <script src="{{ asset('admin_asset/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
         <!-- Main JS -->
         <script src="{{ asset('admin_asset/js/main.js') }}"></script>
 </body>

 </html>

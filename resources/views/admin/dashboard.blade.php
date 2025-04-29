<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>

    <x-admin.head />
</head>


<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
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
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row gy-6">
                            <!-- Congratulations card -->
                            <div class="col-md-12 col-lg-4">
                                <div class="card">
                                    <div class="card-body text-nowrap">
                                        @if ($bestSellingProduct)
                                            <h5 class="card-title mb-0 flex-wrap text-nowrap">Best Selling Product of
                                                Month! 🎉</h5>
                                            <p class="mb-2">{{ $bestSellingProduct['product_name'] }}</p>
                                            <h4 class="text-primary mb-0">
                                                ${{ number_format($bestSellingProduct['total_sales'], 2) }}</h4>
                                            <p class="mb-2">{{ $bestSellingProduct['total_quantity'] }} units sold 🚀
                                            </p>
                                            <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a>
                                        @else
                                            <h5 class="card-title mb-0 flex-wrap text-nowrap">No Sales Yet! 🎉</h5>
                                            <p class="mb-2">No products sold this month</p>
                                        @endif
                                    </div>

                                    <img src="{{ asset('admin_asset/img/illustrations/trophy.png') }}"
                                        class="position-absolute bottom-0 end-0 me-5 mb-5" width="83"
                                        alt="view sales" />
                                </div>
                            </div>
                            <!--/ Congratulations card -->

                            <!-- Transactions -->
                            <div class="col-lg-8">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="card-title m-0 me-2">Transactions</h5>
                                            <div class="dropdown">
                                                <button class="btn text-muted p-0" type="button" id="transactionID"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="ri-more-2-line ri-24px"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="transactionID">
                                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="small mb-0"><span class="h6 mb-0">Total 48.5% Growth</span> 😎 this
                                            month</p>
                                    </div>
                                    <div class="card-body pt-lg-10">
                                        <div class="row g-6">
                                            <div class="col-md-3 col-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar">
                                                        <div class="avatar-initial bg-primary rounded shadow-xs">
                                                            <i class="ri-pie-chart-2-line ri-24px"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3">
                                                        <p class="mb-0">Sales</p>
                                                        <h5 class="mb-0">{{ $transactionsOverview['total_sales'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar">
                                                        <div class="avatar-initial bg-success rounded shadow-xs">
                                                            <i class="ri-group-line ri-24px"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3">
                                                        <p class="mb-0">Customers</p>
                                                        <h5 class="mb-0">
                                                            {{ $transactionsOverview['total_customers'] }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar">
                                                        <div class="avatar-initial bg-warning rounded shadow-xs">
                                                            <i class="ri-macbook-line ri-24px"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3">
                                                        <p class="mb-0">Product</p>
                                                        <h5 class="mb-0">{{ $transactionsOverview['total_products'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar">
                                                        <div class="avatar-initial bg-info rounded shadow-xs">
                                                            <i class="ri-money-dollar-circle-line ri-24px"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3">
                                                        <p class="mb-0">Revenue</p>
                                                        <h5 class="mb-0">
                                                            ₹{{ number_format($transactionsOverview['total_revenue'], 2) }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Transactions -->


                            <!-- Weekly Overview Chart View -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-1">Weekly Overview</h5>
                                            <div class="dropdown">
                                                <button class="btn text-muted p-0" type="button"
                                                    id="weeklyOverviewDropdown" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-more-2-line ri-24px"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="weeklyOverviewDropdown">
                                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-lg-2">
                                        <div id="weeklyOverviewChart"></div>
                                        <div class="mt-1 mt-md-3">
                                            <div class="d-flex align-items-center gap-4">
                                                <h4 class="mb-0" id="performanceChange">0%</h4>
                                                <p class="mb-0" id="performanceMessage">Your sales performance is
                                                    loading...</p>
                                            </div>
                                            <div class="d-grid mt-3 mt-md-4">
                                                <button class="btn btn-primary" type="button">Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Earnings Section -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Total Earning</h5>
                                        <div class="dropdown">
                                            <button class="btn text-muted p-0" type="button" id="totalEarnings"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-line ri-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="totalEarnings">
                                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-5">
                                            <div class="d-flex align-items-center">
                                                <h3 class="mb-0">
                                                    ₹ {{ number_format($getTotalEarning['totalEarnings'], 2) }}</h3>
                                                {{-- <span
                                                    class="{{ $getTotalEarning['percentageChange'] >= 0 ? 'text-success' : 'text-danger' }} ms-2">
                                                    <i
                                                        class="ri-arrow-{{ $getTotalEarning['percentageChange'] >= 0 ? 'up' : 'down' }}-s-line"></i>
                                                    <span>{{ abs($getTotalEarning['percentageChange']) }}%</span>
                                                </span> --}}
                                            </div>
                                            {{-- <p class="mb-0">Compared to
                                                ${{ number_format($getTotalEarning['lastYearEarnings'], 2) }} last year
                                            </p> --}}
                                        </div>
                                        <ul class="p-0 m-0">
                                            @foreach ($getTotalEarning['sources'] as $source)
                                                <li class="d-flex mb-6">
                                                    <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
                                                        @php
                                                            $imagePath = env('APP_URL').'/storage/'.$source['cat_image'];
                                                        @endphp
                                                        <img src="{{ $imagePath }}"
                                                            alt="{{ $source['name'] }}" />
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">{{ $source['name'] }}</h6>
                                                            <p class="mb-0">{{ $source['description'] }}</p>
                                                        </div>
                                                        <div>
                                                            <h6>₹{{  $source['amount'] }}</h6>

                                                            <div class="progress bg-label-primary"
                                                                style="height: 4px">
                                                                <div class="progress-bar bg-primary"
                                                                    style="width: {{ $source['progress'] }}%"
                                                                    role="progressbar"
                                                                    aria-valuenow="{{ $source['progress'] }}"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- /Total Earnings Section -->


                            <!-- Four Cards -->
                            <div class="col-xl-4 col-md-6">
                                <div class="row gy-6">
                                    <!-- Total Profit line chart -->
                                    <div class="col-sm-6">
                                        <div class="card h-100">
                                            <div class="card-header pb-0">
                                                <h4 class="mb-0">₹{{ number_format((float) $getTotalProfit, 2) }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="totalProfitLineChart" class="mb-3"></div>
                                                <h6 class="text-center mb-0">Total Profit</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Total Profit line chart -->
                                    <!-- Total Profit Weekly Project -->
                                    <div class="col-sm-6">
                                        <div class="card h-100">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <div class="avatar">
                                                    <div class="avatar-initial bg-secondary rounded-circle shadow-xs">
                                                        <i class="ri-file-word-2-line ri-24px"></i>
                                                    </div>
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn text-muted p-0" type="button"
                                                        id="totalProfitID" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-2-line ri-24px"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="totalProfitID">
                                                        <a class="dropdown-item"
                                                            href="javascript:void(0);">Refresh</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="card-body">
                                                <h6 class="mb-1">Last Week Profit</h6>
                                                <div class="d-flex flex-wrap mb-1 align-items-center">
                                                    <h4 class="mb-0 me-2">₹{{ number_format($lastWeekProfit, 2) }}</h4>
                                                    <!-- Add a dynamic comparison or progress indicator if needed -->
                                                </div>
                                                <small>Last Week's Project</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Total Profit Weekly Project -->
                                    <!-- New Yearly Project -->
                                    <div class="col-sm-6">
                                        <div class="card h-100">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <div class="avatar">
                                                    <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                                                        <i class="ri-pie-chart-2-line ri-24px"></i>

                                                    </div>
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn text-muted p-0" type="button"
                                                        id="newProjectID" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-2-line ri-24px"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="newProjectID">
                                                        <a class="dropdown-item"
                                                            href="javascript:void(0);">Refresh</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="card-body">
                                                <h6 class="mb-1">Pending Orders</h6>
                                                <div class="d-flex flex-wrap mb-1 align-items-center">
                                                    <h4 class="mb-0 me-2">{{$getPendingOrders}}</h4>
                                                    <p class="text-danger mb-0"></p>
                                                </div>
                                                {{-- <small>Pending Orders</small>/ --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ New Yearly Project-->
                                    <!-- Sessions chart -->
                                    <div class="col-sm-6">
                                        <div class="card h-100">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <div class="avatar">
                                                    <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                                                        <i class="ri-money-dollar-circle-line ri-24px"></i>
                                                    </div>
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn text-muted p-0" type="button"
                                                        id="newProjectID" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-2-line ri-24px"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="newProjectID">
                                                        <a class="dropdown-item"
                                                            href="javascript:void(0);">Refresh</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="card-body">
                                                <h6 class="mb-1">Success Orders</h6>
                                                <div class="d-flex flex-wrap mb-1 align-items-center">
                                                    <h4 class="mb-0 me-2">{{$getSuccessOrders}}</h4>
                                                    <p class="text-danger mb-0"></p>
                                                </div>
                                                {{-- <small>Pending Orders</small>/ --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Sessions chart -->
                                </div>
                            </div>
                            <!--/ Total Earning -->

    
                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <!-- /Inventory -->
    </div>
    <!-- /Second column -->
    </div>
    </div>
    </div>
    <!-- / Content -->






    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>



    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>


    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->
    <!-- Other head elements -->
    <!-- Include ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch data from the API endpoint
            console.log('log hit')
            fetch('{{ route('admin.weekly-overview') }}')
                .then(response => response.json())
                .then(data => {
                    // Update the performance message and percentage
                    document.getElementById('performanceChange').textContent =
                        `${data.performance_change.toFixed(2)}%`;
                    document.getElementById('performanceMessage').textContent = data.performance_change > 0 ?
                        `Your sales performance is ${data.performance_change.toFixed(2)}% 😎 better compared to last week` :
                        `Your sales performance is ${Math.abs(data.performance_change.toFixed(2))}% 😟 worse compared to last week`;

                    // Initialize the chart with dynamic data
                    const chart = new ApexCharts(document.querySelector("#weeklyOverviewChart"), {
                        series: [{
                            name: 'Sales',
                            data: data.weekly_sales // Weekly sales data from the API
                        }],
                        chart: {
                            type: 'area',
                            height: 250
                        },
                        xaxis: {
                            categories: data.labels // Day labels from the API
                        },
                        colors: ['#7367F0'],
                        stroke: {
                            curve: 'smooth'
                        }
                    });

                    chart.render();
                })
                .catch(error => console.error('Error fetching weekly overview data:', error));
        });
    </script>

    <!-- Vendors JS -->
    <script src="{{ asset('admin_asset/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin_asset/js/dashboards-analytics.js') }}"></script>

    <!-- Core JS -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>


    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

    <!-- Page JS -->


</body>

</html>

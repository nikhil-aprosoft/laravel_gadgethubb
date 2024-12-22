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
                                                            <h6>₹{{ number_format((float) $source['amount'], 2) }}</h6>

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
                                                <div class="dropdown">
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
                                                </div>
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
                                                <div class="dropdown">
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
                                                </div>
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
                                                <div class="dropdown">
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
                                                </div>
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

                            {{-- <!-- Sales by Countries -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Sales by Countries</h5>
                                        <div class="dropdown">
                                            <button class="btn text-muted p-0" type="button" id="saleStatus"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-more-2-line ri-24px"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="saleStatus">
                                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="avatar me-4">
                                                    <div class="avatar-initial bg-label-success rounded-circle">US
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <h6 class="mb-0">₹8,656k</h6>
                                                        <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                                                        <span class="text-success">25.8%</span>
                                                    </div>
                                                    <p class="mb-0">United states of america</p>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">894k</h6>
                                                <small class="text-muted">Sales</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="avatar me-4">
                                                    <span
                                                        class="avatar-initial bg-label-danger rounded-circle">UK</span>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <h6 class="mb-0">₹2,415k</h6>
                                                        <i class="ri-arrow-down-s-line ri-24px text-danger"></i>
                                                        <span class="text-danger">6.2%</span>
                                                    </div>
                                                    <p class="mb-0">United Kingdom</p>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">645k</h6>
                                                <small class="text-muted">Sales</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="avatar me-4">
                                                    <span
                                                        class="avatar-initial bg-label-warning rounded-circle">IN</span>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <h6 class="mb-0">865k</h6>
                                                        <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                                                        <span class="text-success"> 12.4%</span>
                                                    </div>
                                                    <p class="mb-0">India</p>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">148k</h6>
                                                <small class="text-muted">Sales</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center mb-4">
                                                <div class="avatar me-4">
                                                    <span
                                                        class="avatar-initial bg-label-secondary rounded-circle">JA</span>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <h6 class="mb-0">₹745k</h6>
                                                        <i class="ri-arrow-down-s-line ri-24px text-danger"></i>
                                                        <span class="text-danger">11.9%</span>
                                                    </div>
                                                    <p class="mb-0">Japan</p>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">86k</h6>
                                                <small class="text-muted">Sales</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-4">
                                                    <span
                                                        class="avatar-initial bg-label-danger rounded-circle">KO</span>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <h6 class="mb-0">₹45k</h6>
                                                        <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                                                        <span class="text-success">16.2%</span>
                                                    </div>
                                                    <p class="mb-0">Korea</p>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="mb-1">42k</h6>
                                                <small class="text-muted">Sales</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Sales by Countries -->

                            <!-- Deposit / Withdraw -->
                            <div class="col-xl-8">
                                <div class="card-group">
                                    <div class="card mb-0">
                                        <div class="card-body card-separator">
                                            <div
                                                class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                                                <h5 class="m-0 me-2">Deposit</h5>
                                                <a class="fw-medium" href="javascript:void(0);">View all</a>
                                            </div>
                                            <div class="deposit-content pt-2">
                                                <ul class="p-0 m-0">
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/payments/gumroad.png"
                                                                class="img-fluid" alt="gumroad" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Gumroad Account</h6>
                                                                <p class="mb-0">Sell UI Kit</p>
                                                            </div>
                                                            <h6 class="text-success mb-0">+₹4,650</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/payments/mastercard-2.png"
                                                                class="img-fluid" alt="mastercard" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Mastercard</h6>
                                                                <p class="mb-0">Wallet deposit</p>
                                                            </div>
                                                            <h6 class="text-success mb-0">+₹92,705</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/payments/stripes.png"
                                                                class="img-fluid" alt="stripes" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Stripe Account</h6>
                                                                <p class="mb-0">iOS Application</p>
                                                            </div>
                                                            <h6 class="text-success mb-0">+₹957</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/payments/american-bank.png"
                                                                class="img-fluid" alt="american" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">American Bank</h6>
                                                                <p class="mb-0">Bank Transfer</p>
                                                            </div>
                                                            <h6 class="text-success mb-0">+₹6,837</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/payments/citi.png"
                                                                class="img-fluid" alt="citi" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Bank Account</h6>
                                                                <p class="mb-0">Wallet deposit</p>
                                                            </div>
                                                            <h6 class="text-success mb-0">+₹446</h6>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <div
                                                class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                                                <h5 class="m-0 me-2">Withdraw</h5>
                                                <a class="fw-medium" href="javascript:void(0);">View all</a>
                                            </div>
                                            <div class="withdraw-content pt-2">
                                                <ul class="p-0 m-0">
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/brands/google.png"
                                                                class="img-fluid" alt="google" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Google Adsense</h6>
                                                                <p class="mb-0">Paypal deposit</p>
                                                            </div>
                                                            <h6 class="text-danger mb-0">-₹145</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/brands/github.png"
                                                                class="img-fluid" alt="github" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Github Enterprise</h6>
                                                                <p class="mb-0">Security &amp; compliance</p>
                                                            </div>
                                                            <h6 class="text-danger mb-0">-₹1870</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/brands/slack.png"
                                                                class="img-fluid" alt="slack" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Upgrade Slack Plan</h6>
                                                                <p class="mb-0">Debit card deposit</p>
                                                            </div>
                                                            <h6 class="text-danger mb-0">₹450</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center pb-2">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/payments/digital-ocean.png"
                                                                class="img-fluid" alt="digital" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Digital Ocean</h6>
                                                                <p class="mb-0">Cloud Hosting</p>
                                                            </div>
                                                            <h6 class="text-danger mb-0">-₹540</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-4">
                                                            <img src="../assets/img/icons/brands/aws.png"
                                                                class="img-fluid" alt="aws" height="30"
                                                                width="30" />
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">AWS Account</h6>
                                                                <p class="mb-0">Choosing a Cloud Platform</p>
                                                            </div>
                                                            <h6 class="text-danger mb-0">-₹21</h6>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Deposit / Withdraw -->

                            <!-- Data Tables -->
                            <div class="col-12">
                                <div class="card overflow-hidden">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-truncate">User</th>
                                                    <th class="text-truncate">Email</th>
                                                    <th class="text-truncate">Role</th>
                                                    <th class="text-truncate">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/1.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Jordan Stevenson</h6>
                                                                <small class="text-truncate">@amiccoo</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">susanna.Lind57@gmail.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-vip-crown-line ri-22px text-primary me-2"></i>
                                                            <span>Admin</span>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge bg-label-warning rounded-pill">Pending</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/3.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Benedetto Rossiter</h6>
                                                                <small class="text-truncate">@brossiter15</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">estelle.Bailey10@gmail.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                                                            <span>Editor</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-label-success rounded-pill">Active</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/2.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Bentlee Emblin</h6>
                                                                <small class="text-truncate">@bemblinf</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">milo86@hotmail.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-computer-line text-danger ri-22px me-2"></i>
                                                            <span>Author</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-label-success rounded-pill">Active</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/5.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Bertha Biner</h6>
                                                                <small class="text-truncate">@bbinerh</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">lonnie35@hotmail.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                                                            <span>Editor</span>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge bg-label-warning rounded-pill">Pending</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/4.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Beverlie Krabbe</h6>
                                                                <small class="text-truncate">@bkrabbe1d</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">ahmad_Collins@yahoo.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-pie-chart-2-line ri-22px text-info me-2"></i>
                                                            <span>Maintainer</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-label-success rounded-pill">Active</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/7.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Bradan Rosebotham</h6>
                                                                <small class="text-truncate">@brosebothamz</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">tillman.Gleason68@hotmail.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                                                            <span>Editor</span>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge bg-label-warning rounded-pill">Pending</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/6.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Bree Kilday</h6>
                                                                <small class="text-truncate">@bkildayr</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">otho21@gmail.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-user-3-line ri-22px text-success me-2"></i>
                                                            <span>Subscriber</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-label-success rounded-pill">Active</span>
                                                    </td>
                                                </tr>
                                                <tr class="border-transparent">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-4">
                                                                <img src="../assets/img/avatars/1.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 text-truncate">Breena Gallemore</h6>
                                                                <small class="text-truncate">@bgallemore6</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-truncate">florencio.Little@hotmail.com</td>
                                                    <td class="text-truncate">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ri-user-3-line ri-22px text-success me-2"></i>
                                                            <span>Subscriber</span>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge bg-label-secondary rounded-pill">Inactive</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--/ Data Tables --> --}}
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with <span class="text-danger"><i
                                            class="tf-icons ri-heart-fill"></i></span> by
                                    <a href="https://themeselection.com" target="_blank"
                                        class="footer-link">ThemeSelection</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeselection.com/license/" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://themeselection.com/" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free/issues"
                                        target="_blank" class="footer-link">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

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

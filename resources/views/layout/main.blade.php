@extends('layout.app')

@section('body')
    <div class="wrapper">
        <div class="sidebar offcanvas-lg border-end offcanvas-start d-flex flex-column position-fixed flex-shrink-0 p-3 text-primary h-100"
            style="width: 260px;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <a href="/" class="py-3 justify-content-center d-flex align-items-center text-decoration-none">
                <span class="ms-1 fs-4 fw-bolder text-primary text-center">Tagihan Cicilan Rumah</span>
            </a>
            <ul class="nav pt-2 nav-pills flex-column mb-auto">
                @if (Auth::user())
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium d-flex align-items-center @yield('db')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                            </svg>

                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <div class="pt-3 pb-2 text-muted fw-medium fs-14">Data Master</div>
                    </li>
                    @if (Auth::user()->role == 'Admin')
                        <li>
                            <a href="{{ route('admin') }}"
                                class="nav-link rounded-1 ps-2 text-muted fw-medium mb-1 d-flex align-items-center @yield('admin')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>

                                <span class="ms-3">Admin</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('rumah') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium mb-1 d-flex align-items-center @yield('rumah')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>


                            <span class="ms-3">Rumah</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium mb-1 d-flex align-items-center @yield('customer')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>


                            <span class="ms-3">Customer</span>
                        </a>
                    </li>
                    <li>
                        <div class="pt-3 pb-2 text-muted fw-medium fs-14">Transaksi</div>
                    </li>
                    <li>
                        <a href="{{ route('cicilan') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium mb-1 d-flex align-items-center @yield('cicilan')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>

                            <span class="ms-3">Cicilan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pembayaran') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium mb-1 d-flex align-items-center @yield('bayar')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>


                            <span class="ms-3">Pembayaran</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('client') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium d-flex align-items-center @yield('db')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                            </svg>

                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <div class="pt-3 pb-2 text-muted fw-medium fs-14">Cicilan</div>
                    </li>

                    <li>
                        <a href="{{ route('client.cicilan') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium mb-1 d-flex align-items-center @yield('cicilan')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>

                            <span class="ms-3">Cicilan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.riwayat') }}"
                            class="nav-link rounded-1 ps-2 text-muted fw-medium mb-1 d-flex align-items-center @yield('bayar')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>


                            <span class="ms-3">Pembayaran</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="top-nav position-fixed bg-white d-lg-none">
            <nav class="navbar navbar-primary navbar-expand-lg w-100">
                <div class="container-fluid">
                    <div class="left">
                        <div class="d-flex align-items-center">
                            <button class="burger-btn btn p-0 border-0 d-lg-none" id="showSidebar" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                                aria-controls="offcanvasExample">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24px"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>

                            </button>
                        </div>
                    </div>
                    <div class="right">
                        <div class="d-flex align-items-center">


                            <div class="dropdown">
                                <button class="btn border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 20 20"
                                        fill="currentColor" class="w-5 h-5 text-primary">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <ul class="dropdown-menu" style="right: 0; left: auto">
                                    <li>
                                    </li>
                                    {{-- <li><a class="dropdown-item" href="#">Profile</a></li> --}}
                                    {{-- <li>
                                        <hr class="dropdown-divider">
                                    </li> --}}
                                    <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Sign Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="app">
            <div class="header mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold">@yield('title')</h5>
                    <nav aria-label="breadcrumb" class="fs-14">
                        <ol class="breadcrumb m-0 ">
                            @php
                                $url = url()->current();
                                $breads = explode('/', explode(url('/'), $url)[1]);

                                $bread = '';
                                $navs = [];
                                if (count($breads) > 1) {
                                    foreach ($breads as $item) {
                                        if ($item != '') {
                                            $routeUrl = Auth::guard('customer')->user() ? "client.$item" : $item;

                                            if ($item != 'edit' && $item != 'detail' && $item != 'bayar') {
                                                $route =
                                                    $item == ''
                                                        ? '/'
                                                        : (Route::has($routeUrl)
                                                            ? route($routeUrl)
                                                            : url($routeUrl));
                                                $title = $item == '' ? 'dashboard' : $item;
                                                $navs[] = [
                                                    'title' => $title,
                                                    'url' => $route,
                                                ];
                                            }
                                        }
                                    }
                                } else {
                                    foreach ($breads as $item) {
                                        $route = $item == '' ? '/' : (Route::has($item) ? route($item) : url($item));
                                        $title = $item == '' ? 'dashboard' : $item;
                                        $navs[] = [
                                            'title' => $title,
                                            'url' => $route,
                                        ];
                                    }
                                }

                                if ($navs) {
                                    if (count($navs) > 2) {
                                        if (
                                            $navs[count($navs) - 2]['title'] == 'edit' ||
                                            $navs[count($navs) - 2]['title'] == 'detail' ||
                                            $navs[count($navs) - 2]['title'] == 'bayar'
                                        ) {
                                            $bread = array_slice($navs, 0, -2);
                                        } else {
                                            $bread = array_slice($navs, 0, -1);
                                        }
                                    } else {
                                        $bread = array_slice($navs, 0, -1);
                                    }
                                }

                            @endphp

                            @foreach ($bread as $item)
                                <li class="breadcrumb-item"><a
                                        href="{{ $item['url'] }}">{{ ucfirst($item['title']) }}</a></li>
                            @endforeach
                            <li class="breadcrumb-item active" aria-current="page">@yield('bread')</li>
                        </ol>
                    </nav>
                </div>

                {{-- {{ var_dump($navs) }} --}}
                <div class="d-none d-md-flex align-items-center">
                    <div>
                        <div class="text-muted fw-medium">
                            {{ Auth::user() ? Auth::user()->name : Auth::guard('customer')->user()->nama }}</div>
                        <div class="text-muted text-end">
                            <div class="badge py-2 text-primary bg-primary-subtle">
                                {{ Auth::user() ? Auth::user()->role : 'Customer' }}</div>
                        </div>
                    </div>


                    <div class="dropdown">
                        <button class="btn border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" viewBox="0 0 20 20"
                                fill="currentColor" class="w-5 h-5 text-primary">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                            </li>
                            {{-- <li><a class="dropdown-item" href="#">Profile</a></li> --}}
                            {{-- <li>
                                <hr class="dropdown-divider">
                            </li> --}}
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Sign Out</a></li>
                        </ul>
                    </div>

                    {{-- <button class="btn border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" viewBox="0 0 20 20" fill="currentColor"
                            class="w-5 h-5 text-primary">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button> --}}
                </div>
            </div>
            <div class="content h-100">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection

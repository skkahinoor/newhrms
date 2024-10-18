<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('vendor.dashboard') }}">
            <span class="ms-1 font-weight-bold text-white"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em"
                    height="1.2em" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M17.755 14a2.25 2.25 0 0 1 2.248 2.25v.575c0 .894-.32 1.759-.9 2.438c-1.57 1.833-3.957 2.738-7.103 2.738s-5.532-.905-7.098-2.74a3.75 3.75 0 0 1-.898-2.434v-.578A2.25 2.25 0 0 1 6.253 14zm0 1.5H6.252a.75.75 0 0 0-.75.75v.577c0 .535.192 1.053.54 1.46c1.253 1.469 3.22 2.214 5.957 2.214c2.739 0 4.706-.745 5.963-2.213a2.25 2.25 0 0 0 .54-1.463v-.576a.75.75 0 0 0-.748-.749M12 2.005a5 5 0 1 1 0 10a5 5 0 0 1 0-10m0 1.5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7" />
                </svg>&nbsp;{{ $getUserDetails->name }}</span>
            <p style="color:white;">{{ $getUserDetails->email }}</p>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white active bg-gradient-primary" href="{{ route('vendor.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z"
                                opacity="0.3" />
                            <path fill="currentColor"
                                d="M3 13h8V3H3zm2-8h4v6H5zm8 16h8V11h-8zm2-8h4v6h-4zM13 3v6h8V3zm6 4h-4V5h4zM3 21h8v-6H3zm2-4h4v2H5z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vendor.products') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 2048 2048">
                            <path fill="currentColor"
                                d="m1344 2l704 352v785l-128-64V497l-512 256v258l-128 64V753L768 497v227l-128-64V354zm0 640l177-89l-463-265l-211 106zm315-157l182-91l-497-249l-149 75zm-507 654l-128 64v-1l-384 192v455l384-193v144l-448 224L0 1735v-676l576-288l576 288zm-640 710v-455l-384-192v454zm64-566l369-184l-369-185l-369 185zm576-1l448-224l448 224v527l-448 224l-448-224zm384 576v-305l-256-128v305zm384-128v-305l-256 128v305zm-320-288l241-121l-241-120l-241 120z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vendor.orders') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16">
                            <path fill="none" stroke="currentColor" stroke-linejoin="round"
                                d="M7 14.5H3.5v-13h9V7M5 6.5h4m-4-2h6m-.5 7v-2m3 2a3 3 0 1 1-6 0a3 3 0 0 1 6 0Zm-3 1.25h.005v.005H10.5zm.25 0a.25.25 0 1 1-.5 0a.25.25 0 0 1 .5 0Z" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vendor.billing') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M7.17 3.25h5.66c.535 0 .98 0 1.345.03c.38.03.736.098 1.073.27a2.75 2.75 0 0 1 1.202 1.202c.172.337.24.693.27 1.073c.03.365.03.81.03 1.345v3.08a.75.75 0 0 1-1.5 0V7.2c0-.572 0-.957-.025-1.253c-.023-.287-.065-.424-.111-.514a1.25 1.25 0 0 0-.546-.547c-.091-.046-.228-.088-.515-.111c-.296-.024-.68-.025-1.253-.025H7.2c-.572 0-.957 0-1.253.025c-.287.023-.424.065-.514.111a1.25 1.25 0 0 0-.547.547c-.046.09-.088.227-.111.514c-.024.296-.025.68-.025 1.253v9.6c0 .572 0 .957.025 1.252c.023.288.065.425.111.515c.114.223.29.406.508.526q.024.006.106.019q.175.026.476.048c.398.03.91.05 1.454.063c1.085.027 2.26.027 2.82.027a.75.75 0 0 1 0 1.5h-.002c-.56 0-1.75 0-2.855-.027a33 33 0 0 1-1.527-.067a8 8 0 0 1-.585-.06a1.8 1.8 0 0 1-.53-.146a2.75 2.75 0 0 1-1.201-1.2c-.172-.338-.24-.694-.27-1.074c-.03-.365-.03-.81-.03-1.345V7.17c0-.535 0-.98.03-1.345c.03-.38.098-.736.27-1.073A2.75 2.75 0 0 1 4.752 3.55c.337-.172.693-.24 1.073-.27c.365-.03.81-.03 1.345-.03" />
                            <path fill="currentColor"
                                d="M14.371 12.25h4.258c.395 0 .736 0 1.017.023c.297.024.592.078.875.222c.424.216.768.56.984.984c.144.283.198.578.222.875c.023.28.023.622.023 1.017v2.258c0 .395 0 .736-.023 1.017a2.3 2.3 0 0 1-.222.875a2.25 2.25 0 0 1-.983.984c-.284.144-.58.198-.876.222c-.28.023-.622.023-1.017.023H14.37c-.395 0-.736 0-1.017-.023a2.3 2.3 0 0 1-.875-.222a2.25 2.25 0 0 1-.984-.983a2.3 2.3 0 0 1-.222-.876c-.023-.28-.023-.622-.023-1.017V15.37c0-.395 0-.736.023-1.017a2.3 2.3 0 0 1 .222-.875a2.25 2.25 0 0 1 .984-.984a2.3 2.3 0 0 1 .875-.222c.28-.023.622-.023 1.017-.023m-.895 1.518c-.204.017-.28.045-.317.064a.75.75 0 0 0-.327.327c-.02.038-.047.113-.064.317l-.002.024h7.468l-.002-.024c-.017-.204-.045-.28-.064-.317a.75.75 0 0 0-.328-.327c-.037-.02-.112-.047-.316-.064a13 13 0 0 0-.924-.018h-4.2c-.432 0-.712 0-.924.018M20.25 16.5h-7.5v1.1c0 .432 0 .712.018.924c.017.204.045.28.064.316a.75.75 0 0 0 .327.328c.038.02.113.047.317.064c.212.017.492.018.924.018h4.2c.432 0 .712 0 .924-.018c.204-.017.28-.045.316-.064a.75.75 0 0 0 .328-.328c.02-.037.047-.112.064-.316c.017-.212.018-.492.018-.924zM6.5 6.25a.75.75 0 0 0 0 1.5h4a.75.75 0 0 0 0-1.5zM5.75 10a.75.75 0 0 1 .75-.75h7a.75.75 0 0 1 0 1.5h-7a.75.75 0 0 1-.75-.75m.75 2.25a.75.75 0 0 0 0 1.5H10a.75.75 0 0 0 0-1.5zM5.75 17a.75.75 0 0 1 .75-.75h2a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1-.75-.75" />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vendor.profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <g fill="none">
                                <path fill="currentColor"
                                    d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2"
                                    opacity="0.16" />
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                    d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z" />
                                <circle cx="12" cy="7" r="3" stroke="currentColor" stroke-width="2" />
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vendor.logout') }}"
                    onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <path stroke-dasharray="36" stroke-dashoffset="36"
                                    d="M12 4h-7c-0.55 0 -1 0.45 -1 1v14c0 0.55 0.45 1 1 1h7">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s"
                                        values="36;0" />
                                </path>
                                <path stroke-dasharray="14" stroke-dashoffset="14" d="M9 12h11.5">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s"
                                        dur="0.2s" values="14;0" />
                                </path>
                                <path stroke-dasharray="6" stroke-dashoffset="6"
                                    d="M20.5 12l-3.5 -3.5M20.5 12l-3.5 3.5">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s"
                                        dur="0.2s" values="6;0" />
                                </path>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Log out</span>
                </a>
                <form id="logout-form" action="{{ route('vendor.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>

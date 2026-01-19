<x-iframe title="لوحة الخرائط">

    <style>
        :root {
            /* Brown Color Palette */
            --primary: #8B6F47;
            --primary-dark: #6B5638;
            --primary-light: #A8896C;
            --bg-light: #F5F1E8;
            --bg-white: #F2F3EB;
            --bg-card: #FEFDFB;
            --border: #D4C4A8;
            --border-light: #E8DCC8;
            --text-primary: #3E2F1F;
            --text-secondary: #6B5D4F;
            --text-muted: #8A7968;
            --danger: #A0522D;
        }

        .user-avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }

        .user-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
            border: 2px solid var(--border);
        }

        @media (max-width: 768px) {
            .user-info {
                display: none !important;
            }

            .logo-container {
                width: 40px !important;
                height: 40px !important;
            }

            .logo-container img {
                width: 24px !important;
                height: 24px !important;
            }
        }
    </style>

    <div style="display:flex; flex-direction:column; height:100vh; overflow:hidden; background:#fff">

        {{-- Unified Top Header with Tabs --}}
        <header style="
            background: var(--bg-white);
            border-bottom: 2px solid var(--border);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        ">
            {{-- Top Row: Logo + Brand (center) + User Menu --}}
            <div style="
                height: 70px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 24px;
                gap: 16px;
                background: var(--bg-white);
                position: relative;
            ">
                {{-- Right Side: Logo --}}
                <div style="display: flex; align-items: center; gap: 16px; flex: 0 0 auto;">
                    <div class="logo-container" style="
                        width: 80px;
                        height: auto;
                        background: var(--bg-white);
                        border: 2px solid var(--border);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 8px;
                        box-shadow: 0 2px 8px rgba(139, 111, 71, 0.15);
                    ">
                        {{--<img style="width: 100%; height: 100%; object-fit: contain;"
                                                     src="{{ asset('images/logo.png') }}"
                                                     alt="Logo">--}}
                        GIS Team
                    </div>
                </div>

                {{-- Center: Brand Name --}}
                <div style="
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                    font-size: 22px;
                    font-weight: 700;
                     color: var(--text-primary);
                    white-space: nowrap;
                    letter-spacing: 0.5px;
                ">
                    GIS Team
                </div>

                {{-- Left Side: User Info + Back Button --}}
                <div style="display: flex; align-items: center; gap: 16px; flex: 0 0 auto;">

                    {{-- User Info --}}
                    <div style="display:flex; align-items:center; gap:12px">
                        <!-- Avatar -->
                        @if(auth()->user()->profile_image)
                            <img
                                src="{{ auth()->user()->profile_image_url }}"
                                alt="{{ auth()->user()->name }}"
                                class="user-avatar-img"
                            >
                        @else
                            <div class="user-avatar-placeholder"
                                 style="background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);">
                                {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <!-- Info - مخفي على الموبايل -->
                        <div class="user-info" style="text-align:right">
                            <div style="font-size:14px; font-weight:600; color:var(--text-primary); line-height:1.3">
                                {{ auth()->user()->name }}
                            </div>
                            <div style="font-size:12px; color:var(--text-secondary); line-height:1.3">
                                {{ auth()->user()->role->display_name ?? 'مستخدم' }}
                            </div>
                        </div>
                    </div>

                    {{-- Back to Dashboard Button --}}
                    <a href="{{ route('user.dashboard') }}" style="
                        padding: 10px 16px;
                        text-decoration: none;
                        transition: all 0.2s;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        background: var(--bg-card);
                        border-radius: 10px;
                        border: 1px solid var(--border);
                        color: var(--text-primary);
                        font-size: 14px;
                        font-weight: 500;
                    "
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.borderColor='var(--primary)'; this.style.boxShadow='0 4px 12px rgba(139, 111, 71, 0.15)'"
                       onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='var(--border)'; this.style.boxShadow='none'"
                       title="العودة للوحة التحكم">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Bottom Row: Tabs Navigation --}}
            <div style="position: relative; background: var(--bg-card); border-top: 1px solid var(--border-light);">
                {{-- Scroll Left Button --}}
                <button id="scrollLeft" onclick="scrollNav(-1)" style="
                    position: absolute;
                    right: 0;
                    top: 0;
                    bottom: 0;
                    width: 50px;
                    background: linear-gradient(to left, var(--bg-card) 70%, transparent);
                    border: none;
                    cursor: pointer;
                    z-index: 10;
                    display: none;
                    transition: 0.2s;
                "
                        onmouseover="this.style.background='linear-gradient(to left, var(--bg-light) 70%, transparent)'"
                        onmouseout="this.style.background='linear-gradient(to left, var(--bg-card) 70%, transparent)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)"
                         stroke-width="2.5">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>

                {{-- Scroll Right Button --}}
                <button id="scrollRight" onclick="scrollNav(1)" style="
                    position: absolute;
                    left: 0;
                    top: 0;
                    bottom: 0;
                    width: 50px;
                    background: linear-gradient(to right, var(--bg-card) 70%, transparent);
                    border: none;
                    cursor: pointer;
                    z-index: 10;
                    display: none;
                    transition: 0.2s;
                "
                        onmouseover="this.style.background='linear-gradient(to right, var(--bg-light) 70%, transparent)'"
                        onmouseout="this.style.background='linear-gradient(to right, var(--bg-card) 70%, transparent)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)"
                         stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>

                {{-- Tabs Container --}}
                <div id="tabsContainer" style="
                    display: flex;
                    overflow-x: auto;
                    overflow-y: hidden;
                    scroll-behavior: smooth;
                    -webkit-overflow-scrolling: touch;
                    scrollbar-width: none;
                    padding: 0 8px;
                    min-height: 52px;
                ">
                    <style>
                        #tabsContainer::-webkit-scrollbar {
                            display: none;
                        }
                    </style>

                    @foreach($pages as $page)
                        <button
                            class="nav-tab"
                            data-tab="{{ $page->id }}"
                            onclick="openTab({{ $page->id }})"
                            style="
                                padding: 14px 20px;
                                border: none;
                                background: transparent;
                                color: var(--text-secondary);
                                cursor: pointer;
                                white-space: nowrap;
                                font-size: 14px;
                                font-weight: 500;
                                border-bottom: 3px solid transparent;
                                transition: all 0.2s;
                                position: relative;
                                border-radius: 10px 10px 0 0;
                            "
                            onmouseover="if(!this.classList.contains('active')) { this.style.color='var(--text-primary)'; this.style.background='var(--bg-light)'; }"
                            onmouseout="if(!this.classList.contains('active')) { this.style.color='var(--text-secondary)'; this.style.background='transparent'; }"
                        >
                            {{ $page->title }}
                        </button>
                    @endforeach
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <main style="flex: 1; position: relative; background: #fff; overflow: hidden;">
            @foreach($pages as $page)
                <iframe
                    id="tab-{{ $page->id }}"
                    src="{{ $page->iframe_url }}"
                    style="display: none; width: 100%; height: 100%; border: none; position: absolute; inset: 0;"
                ></iframe>
            @endforeach

            {{-- Loading Indicator --}}
            <div id="loading" style="
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.95);
                z-index: 100;
                backdrop-filter: blur(2px);
            ">
                <div style="text-align: center;">
                    <div style="
                        width: 48px;
                        height: 48px;
                        border: 4px solid var(--border);
                        border-top-color: var(--primary);
                        border-radius: 50%;
                        animation: spin 0.7s linear infinite;
                        margin: 0 auto 16px;
                    "></div>
                    <div style="color: var(--text-secondary); font-size: 14px; font-weight: 500;">جاري التحميل...</div>
                </div>
            </div>

            <style>
                @keyframes spin {
                    to {
                        transform: rotate(360deg);
                    }
                }
            </style>
        </main>

    </div>

    <script>
        const tabsContainer = document.getElementById('tabsContainer');
        const scrollLeft = document.getElementById('scrollLeft');
        const scrollRight = document.getElementById('scrollRight');
        const loading = document.getElementById('loading');
        let currentTab = null;

        // إدارة أزرار التمرير
        function updateScrollButtons() {
            const maxScroll = tabsContainer.scrollWidth - tabsContainer.clientWidth;

            if (maxScroll > 10) {
                scrollRight.style.display = tabsContainer.scrollLeft > 10 ? 'flex' : 'none';
                scrollLeft.style.display = tabsContainer.scrollLeft < maxScroll - 10 ? 'flex' : 'none';
            } else {
                scrollRight.style.display = 'none';
                scrollLeft.style.display = 'none';
            }
        }

        function scrollNav(direction) {
            tabsContainer.scrollBy({left: direction * 250, behavior: 'smooth'});
        }

        tabsContainer.addEventListener('scroll', updateScrollButtons);
        window.addEventListener('resize', updateScrollButtons);

        // فتح التبويبة
        function openTab(id) {
            loading.style.display = 'none';

            document.querySelectorAll('iframe').forEach(f => f.style.display = 'none');

            document.querySelectorAll('.nav-tab').forEach(b => {
                b.classList.remove('active');
                b.style.color = 'var(--text-secondary)';
                b.style.borderBottomColor = 'transparent';
                b.style.fontWeight = '500';
                b.style.background = 'transparent';
            });

            const iframe = document.getElementById('tab-' + id);
            iframe.style.display = 'block';

            const btn = document.querySelector(`[data-tab="${id}"]`);
            btn.classList.add('active');
            btn.style.color = 'var(--text-primary)';
            btn.style.borderBottomColor = 'var(--primary)';
            btn.style.fontWeight = '600';
            btn.style.background = 'var(--bg-light)';

            btn.scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'center'});

            currentTab = id;
        }

        // تهيئة
        window.onload = function () {
            updateScrollButtons();

            @if($pages->count())
            openTab({{ $pages->first()->id }});
            @endif

            setTimeout(() => loading.style.display = 'none', 2000);
        };

        // Smooth scroll on wheel
        tabsContainer.addEventListener('wheel', function (e) {
            if (Math.abs(e.deltaY) > 0) {
                e.preventDefault();
                this.scrollLeft += e.deltaY;
                updateScrollButtons();
            }
        });
    </script>

</x-iframe>

<x-guest-layout>
    <style>
        .privacy-container {
            max-width: 100%;
            width: 100%;
            padding: 0;
        }

        .page-header {
            background: linear-gradient(135deg, #6B5638 0%, #8B6F47 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 1.5rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: '🔒';
            position: absolute;
            font-size: 180px;
            opacity: 0.1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .page-header p {
            font-size: 1.125rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .section-card {
            background: var(--bg-card);
            border: 2px solid var(--border-light);
            border-radius: 1.25rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .section-card:hover {
            border-color: var(--primary-light);
            box-shadow: 0 8px 20px rgba(139, 111, 71, 0.15);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .section-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .section-card p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0 0 0;
        }

        .feature-list li {
            display: flex;
            align-items: start;
            gap: 0.75rem;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: var(--bg-light);
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .feature-list li:hover {
            background: white;
            transform: translateX(-5px);
        }

        .feature-list li::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .info-banner {
            background: linear-gradient(135deg, var(--bg-light) 0%, #E8DCC8 100%);
            border: 2px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
        }

        .info-banner p {
            color: var(--text-secondary);
            margin: 0.5rem 0;
        }

        .info-banner strong {
            color: var(--primary);
            font-size: 1.125rem;
        }

        .update-date {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
            margin-top: 2rem;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.75rem;
            }

            .section-card {
                padding: 1.5rem;
            }
        }
    </style>

    <div class="privacy-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>سياسة الخصوصية</h1>
            <p>نحن نهتم بخصوصيتك وأمان بياناتك</p>
        </div>

        <!-- Section 1: جمع المعلومات -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon">📋</div>
                <h2>جمع المعلومات</h2>
            </div>
            <p>نقوم بجمع المعلومات التالية من المستخدمين لتوفير خدماتنا بأفضل شكل ممكن:</p>
            <ul class="feature-list">
                <li>الاسم الثلاثي الكامل</li>
                <li>البريد الإلكتروني</li>
                <li>رقم الجوال</li>
                <li>الصورة الشخصية (اختياري)</li>
                <li>معلومات تسجيل الدخول</li>
            </ul>
        </div>

        <!-- Section 2: استخدام المعلومات -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon">⚙️</div>
                <h2>استخدام المعلومات</h2>
            </div>
            <p>نستخدم المعلومات المجمعة للأغراض التالية وفقاً لأعلى معايير الأمان:</p>
            <ul class="feature-list">
                <li>إدارة حسابات المستخدمين والصلاحيات</li>
                <li>تقديم الخدمات المطلوبة بكفاءة</li>
                <li>التواصل مع المستخدمين عند الحاجة</li>
                <li>تحسين جودة الخدمة</li>
                <li>إرسال التحديثات والإشعارات المهمة</li>
            </ul>
        </div>

        <!-- Section 3: حماية البيانات -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon">🛡️</div>
                <h2>حماية البيانات</h2>
            </div>
            <p>نلتزم بحماية بياناتك باستخدام أحدث تقنيات الأمان:</p>
            <ul class="feature-list">
                <li>تشفير SSL/TLS لجميع الاتصالات</li>
                <li>تخزين آمن ومشفر للبيانات</li>
                <li>صلاحيات محدودة للوصول إلى المعلومات</li>
                <li>نسخ احتياطية منتظمة</li>
                <li>مراقبة أمنية على مدار الساعة</li>
            </ul>
        </div>

        <!-- Section 4: حقوق المستخدم -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon">👤</div>
                <h2>حقوقك</h2>
            </div>
            <p>لديك الحق الكامل في التحكم ببياناتك الشخصية:</p>
            <ul class="feature-list">
                <li>الوصول إلى بياناتك الشخصية في أي وقت</li>
                <li>تعديل أو تحديث بياناتك</li>
                <li>طلب حذف بياناتك نهائياً</li>
                <li>سحب موافقتك على معالجة البيانات</li>
                <li>تقديم شكوى حول معالجة البيانات</li>
            </ul>
        </div>

        <!-- Section 5: مشاركة البيانات -->
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon">🔐</div>
                <h2>مشاركة البيانات</h2>
            </div>
            <p>نحن لا نشارك بياناتك الشخصية مع أطراف ثالثة إلا في الحالات التالية:</p>
            <ul class="feature-list">
                <li>بموافقتك الصريحة</li>
                <li>للامتثال للمتطلبات القانونية</li>
                <li>لحماية حقوقنا وسلامة المستخدمين</li>
            </ul>
        </div>

        <!-- Contact Banner -->
        <div class="info-banner">
            <strong>📞 هل لديك استفسارات؟</strong>
            <p>إذا كان لديك أي أسئلة حول سياسة الخصوصية، يسعدنا التواصل معك</p>
            <p><strong>البريد الإلكتروني:</strong> info@gis-team.site</p>
        </div>

        <!-- Update Date -->
        <div class="update-date">
            آخر تحديث: {{ now()->format('Y-m-d') }}
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <style>
        .terms-container {
            max-width: 100%;
            width: 100%;
            padding: 0;
        }

        .terms-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-light) 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 1.5rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .terms-header::after {
            content: '⚖️';
            position: absolute;
            font-size: 200px;
            opacity: 0.08;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
        }

        .terms-header h1 {
            font-size: 2.75rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .terms-header p {
            font-size: 1.125rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .intro-box {
            background: linear-gradient(135deg, var(--bg-light) 0%, white 100%);
            border: 2px solid var(--primary);
            border-radius: 1rem;
            padding: 1.75rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .intro-box p {
            color: var(--text-primary);
            font-size: 1.125rem;
            line-height: 1.7;
            margin: 0;
        }

        .intro-box strong {
            color: var(--primary);
        }

        .term-section {
            background: var(--bg-card);
            border: 2px solid var(--border-light);
            border-radius: 1.25rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .term-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: var(--primary);
            opacity: 0.05;
            border-radius: 0 1.25rem 0 100%;
            transition: all 0.3s ease;
        }

        .term-section:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(139, 111, 71, 0.15);
        }

        .term-section:hover::before {
            width: 120px;
            height: 120px;
        }

        .term-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .term-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.3);
        }

        .term-section h2 {
            font-size: 1.625rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .term-section p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .rule-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0 0 0;
        }

        .rule-list li {
            display: flex;
            align-items: start;
            gap: 0.75rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            background: white;
            border: 1px solid var(--border-light);
            border-radius: 0.75rem;
            transition: all 0.2s;
        }

        .rule-list li:hover {
            border-color: var(--primary-light);
            background: var(--bg-light);
            transform: translateX(-5px);
        }

        .rule-list li::before {
            content: '→';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .warning-box {
            background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%);
            border: 2px solid var(--warning);
            border-radius: 1rem;
            padding: 1.5rem;
            margin: 1.5rem 0;
            display: flex;
            align-items: start;
            gap: 1rem;
        }

        .warning-box::before {
            content: '⚠️';
            font-size: 32px;
            flex-shrink: 0;
        }

        .warning-box p {
            color: #8B6F47;
            font-weight: 600;
            margin: 0;
            line-height: 1.6;
        }

        .footer-notice {
            background: white;
            border: 2px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            margin-top: 2.5rem;
        }

        .footer-notice p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin: 0;
        }

        .footer-notice strong {
            color: var(--primary);
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .terms-header h1 {
                font-size: 2rem;
            }

            .term-section {
                padding: 1.5rem;
            }
        }
    </style>

    <div class="terms-container">
        <!-- Page Header -->
        <div class="terms-header">
            <h1>شروط الاستخدام</h1>
            <p>يرجى قراءة الشروط بعناية قبل استخدام الخدمة</p>
        </div>

        <!-- Intro Box -->
        <div class="intro-box">
            <p>
                باستخدام هذا الموقع، فإنك <strong>توافق تلقائياً</strong> على الالتزام الكامل بهذه الشروط والأحكام.
                نرجو منك قراءتها بعناية لفهم حقوقك ومسؤولياتك.
            </p>
        </div>

        <!-- Section 1: قبول الشروط -->
        <div class="term-section">
            <div class="term-header">
                <div class="term-number">1</div>
                <h2>قبول الشروط</h2>
            </div>
            <p>عند الوصول إلى هذا الموقع واستخدامه، فإنك توافق على الالتزام بهذه الشروط والأحكام وجميع القوانين واللوائح المعمول بها.</p>
            <div class="warning-box">
                <p>إذا كنت لا توافق على أي من هذه الشروط، يُرجى عدم استخدام هذا الموقع.</p>
            </div>
        </div>

        <!-- Section 2: استخدام الخدمة -->
        <div class="term-section">
            <div class="term-header">
                <div class="term-number">2</div>
                <h2>استخدام الخدمة</h2>
            </div>
            <p>للاستفادة من خدماتنا بشكل صحيح، يجب عليك الالتزام بالتالي:</p>
            <ul class="rule-list">
                <li>تقديم معلومات صحيحة ودقيقة عند التسجيل</li>
                <li>الحفاظ على سرية كلمة المرور الخاصة بك</li>
                <li>عدم استخدام الخدمة لأغراض غير قانونية أو ضارة</li>
                <li>احترام حقوق الملكية الفكرية للآخرين</li>
                <li>عدم محاولة اختراق النظام أو الوصول غير المصرح به</li>
            </ul>
        </div>

        <!-- Section 3: حقوق الملكية -->
        <div class="term-section">
            <div class="term-header">
                <div class="term-number">3</div>
                <h2>حقوق الملكية الفكرية</h2>
            </div>
            <p>جميع المحتويات والمواد الموجودة على هذا الموقع محمية بحقوق الملكية الفكرية:</p>
            <ul class="rule-list">
                <li>جميع الحقوق محفوظة لـ GIS Team</li>
                <li>لا يجوز نسخ أو تعديل أو توزيع المحتوى دون إذن</li>
                <li>يحظر استخدام شعارات أو علامات الموقع التجارية</li>
            </ul>
        </div>

        <!-- Section 4: المسؤولية -->
        <div class="term-section">
            <div class="term-header">
                <div class="term-number">4</div>
                <h2>حدود المسؤولية</h2>
            </div>
            <p>نحن غير مسؤولين في الحالات التالية:</p>
            <ul class="rule-list">
                <li>أي خسائر مباشرة أو غير مباشرة ناتجة عن استخدام الخدمة</li>
                <li>انقطاع الخدمة المؤقت لأسباب فنية أو صيانة</li>
                <li>محتوى المستخدمين أو أفعالهم على المنصة</li>
                <li>الأخطاء أو الفيروسات الناتجة عن أطراف ثالثة</li>
            </ul>
        </div>

        <!-- Section 5: إنهاء الخدمة -->
        <div class="term-section">
            <div class="term-header">
                <div class="term-number">5</div>
                <h2>إنهاء الاستخدام</h2>
            </div>
            <p>نحتفظ بالحق في:</p>
            <ul class="rule-list">
                <li>إيقاف أو تعليق حسابك في حالة انتهاك الشروط</li>
                <li>تعديل أو إنهاء الخدمة في أي وقت</li>
                <li>رفض الخدمة لأي شخص لأي سبب</li>
            </ul>
        </div>

        <!-- Section 6: التعديلات -->
        <div class="term-section">
            <div class="term-header">
                <div class="term-number">6</div>
                <h2>تعديل الشروط</h2>
            </div>
            <p>نحتفظ بحقنا في تعديل هذه الشروط في أي وقت. سيتم إخطار المستخدمين بأي تغييرات جوهرية، واستمرارك في استخدام الخدمة بعد التعديلات يعني موافقتك عليها.</p>
        </div>

        <!-- Section 7: القانون الحاكم -->
        <div class="term-section">
            <div class="term-header">
                <div class="term-number">7</div>
                <h2>القانون الحاكم</h2>
            </div>
            <p>تخضع هذه الشروط لقوانين المملكة العربية السعودية، وأي نزاع ينشأ عن استخدام الخدمة سيتم حله وفقاً للأنظمة المعمول بها.</p>
        </div>

        <!-- Footer Notice -->
        <div class="footer-notice">
            <strong>📅 آخر تحديث</strong>
            <p>{{ now()->format('Y-m-d') }}</p>
            <p style="margin-top: 1rem;">
                إذا كان لديك أي استفسارات حول شروط الاستخدام، يرجى التواصل معنا على:
                <strong style="color: var(--primary); display: inline;">info@gis-team.site</strong>
            </p>
        </div>
    </div>
</x-guest-layout>

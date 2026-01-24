<x-guest-layout>
    <style>
        .about-container {
            max-width: 100%;
            width: 100%;
            padding: 0;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
            border-radius: 1.5rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .hero-section p {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .card-modern {
            background: var(--bg-card);
            border: 2px solid var(--border-light);
            border-radius: 1.25rem;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: var(--primary-light);
            opacity: 0.1;
            border-radius: 0 0 0 100%;
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(139, 111, 71, 0.2);
            border-color: var(--primary);
        }

        .card-modern:hover::before {
            width: 150px;
            height: 150px;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(139, 111, 71, 0.3);
        }

        .card-modern h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .card-modern p {
            color: var(--text-secondary);
            line-height: 1.7;
        }

        .contact-section {
            background: var(--bg-light);
            border: 2px solid var(--border);
            border-radius: 1.25rem;
            padding: 2.5rem;
            margin-top: 3rem;
        }

        .contact-section h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .contact-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: white;
            padding: 1.25rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border-light);
            transition: all 0.2s;
        }

        .contact-item:hover {
            border-color: var(--primary);
            transform: translateX(-5px);
        }

        .contact-item-icon {
            width: 45px;
            height: 45px;
            background: var(--primary);
            color: white;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .contact-item-text {
            flex: 1;
        }

        .contact-item-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .contact-item-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="about-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1>🌍 من نحن</h1>
            <p>نظام البوابة الإلكترونية لفريق GIS Team - حلول متكاملة لإدارة البيانات الجغرافية</p>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Card 1 -->
            <div class="card-modern">
                <div class="card-icon">🎯</div>
                <h3>رؤيتنا</h3>
                <p>نسعى لتقديم أفضل الحلول التقنية لإدارة البيانات والمستخدمين بشكل آمن وفعّال، مع التركيز على تقنيات نظم المعلومات الجغرافية الحديثة.</p>
            </div>

            <!-- Card 2 -->
            <div class="card-modern">
                <div class="card-icon">💡</div>
                <h3>رسالتنا</h3>
                <p>تمكين المؤسسات والأفراد من خلال توفير منصة متطورة لإدارة البيانات الجغرافية والمكانية بكفاءة عالية وأمان تام.</p>
            </div>

            <!-- Card 3 -->
            <div class="card-modern">
                <div class="card-icon">⭐</div>
                <h3>قيمنا</h3>
                <p>الابتكار، الجودة، الأمان، والشفافية في تقديم خدماتنا. نحن ملتزمون بالتطوير المستمر ورضا عملائنا.</p>
            </div>
        </div>

        <!-- Features Section -->
        <div class="content-grid">
            <div class="card-modern">
                <div class="card-icon">🔒</div>
                <h3>الأمان</h3>
                <p>نظام صلاحيات متقدم يضمن حماية بياناتك وخصوصيتك بأعلى معايير الأمان الإلكتروني.</p>
            </div>

            <div class="card-modern">
                <div class="card-icon">⚡</div>
                <h3>الأداء</h3>
                <p>تقنيات حديثة تضمن سرعة وكفاءة في معالجة البيانات وإدارة المستخدمين.</p>
            </div>

            <div class="card-modern">
                <div class="card-icon">🤝</div>
                <h3>الدعم</h3>
                <p>فريق دعم فني متخصص جاهز لمساعدتك على مدار الساعة لضمان أفضل تجربة استخدام.</p>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h2>📞 تواصل معنا</h2>
            <div class="contact-list">
                <div class="contact-item">
                    <div class="contact-item-icon">📧</div>
                    <div class="contact-item-text">
                        <div class="contact-item-label">البريد الإلكتروني</div>
                        <div class="contact-item-value">info@gis-team.site</div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon">🌐</div>
                    <div class="contact-item-text">
                        <div class="contact-item-label">الموقع الإلكتروني</div>
                        <div class="contact-item-value">www.gis-team.site</div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon">📍</div>
                    <div class="contact-item-text">
                        <div class="contact-item-label">العنوان</div>
                        <div class="contact-item-value">المملكة العربية السعودية</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', 'Helvetica', sans-serif;
            background-color: #0f172a;
            color: #e5e7eb;
        }
        .email-wrapper {
            width: 100%;
            background-color: #0f172a;
            padding: 40px 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }
        .header {
            background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .header-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin: 0;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 24px;
            font-weight: bold;
            color: #d4af37;
            margin-bottom: 20px;
        }
        .message {
            color: #e5e7eb;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 25px;
        }
        .info-box {
            background: rgba(26, 77, 46, 0.2);
            border-left: 4px solid #d4af37;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .info-box h3 {
            color: #d4af37;
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .info-item {
            color: #e5e7eb;
            margin: 8px 0;
            padding-left: 20px;
            position: relative;
        }
        .info-item:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #d4af37;
            font-weight: bold;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #1a4d2e 0%, #d4af37 100%);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
        .social-links {
            text-align: center;
            padding: 30px 0;
            border-top: 1px solid #334155;
            margin-top: 30px;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #d4af37;
            text-decoration: none;
            font-size: 24px;
        }
        .footer {
            background-color: #0f172a;
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 13px;
        }
        .footer a {
            color: #d4af37;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="header">
                <div class="logo">🎧 JAVI LABARUM DJ</div>
                <p class="header-subtitle">Afro Latin Tech House</p>
            </div>
            
            <div class="content">
                <div class="greeting">¡Hola {{ $contactData['name'] }}! 👋</div>
                
                <p class="message">
                    Gracias por ponerte en contacto conmigo. He recibido tu mensaje correctamente y te responderé lo antes posible, normalmente en menos de 24 horas.
                </p>

                <div class="info-box">
                    <h3>📋 Resumen de tu mensaje:</h3>
                    @if(!empty($contactData['subject']))
                        <div class="info-item"><strong>Asunto:</strong> {{ $contactData['subject'] }}</div>
                    @endif
                    <div class="info-item"><strong>Email:</strong> {{ $contactData['email'] }}</div>
                    @if(!empty($contactData['phone']))
                        <div class="info-item"><strong>Teléfono:</strong> {{ $contactData['phone'] }}</div>
                    @endif
                </div>

                <p class="message">
                    Mientras tanto, puedes:
                </p>

                <div class="info-item">Consultar mi <a href="{{ url('/calendar') }}" style="color: #d4af37; text-decoration: none;">calendario de eventos</a></div>
                <div class="info-item">Seguirme en redes sociales</div>
                <div class="info-item">Para bookings urgentes, escríbeme por WhatsApp al <a href="https://wa.me/34622323976" style="color: #d4af37; text-decoration: none;">+34 622 323 976</a></div>

                <center>
                    <a href="https://wa.me/34622323976" class="cta-button">
                        💬 WhatsApp Directo
                    </a>
                </center>

                <p class="message" style="margin-top: 30px; color: #94a3b8; font-size: 14px;">
                    ¡Nos vemos pronto en la pista! 🔥
                </p>

                <div class="social-links">
                    <a href="https://instagram.com/javilabarumdj" title="Instagram">📸</a>
                    <a href="https://soundcloud.com/javilabarumdj" title="SoundCloud">🎵</a>
                    <a href="https://www.youtube.com/@javilabarumdj" title="YouTube">📹</a>
                </div>
            </div>

            <div class="footer">
                <p><strong>Javi Labarum DJ</strong></p>
                <p>Afro Latin Tech House</p>
                <p>
                    <a href="mailto:booking@javilabarumdj.com">booking@javilabarumdj.com</a> | 
                    <a href="tel:+34622323976">+34 622 323 976</a>
                </p>
                <p style="margin-top: 15px;">
                    <a href="{{ url('/') }}">javilabarumdj.com</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>

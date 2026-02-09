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
            max-width: 650px;
            margin: 0 auto;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }
        .header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .alert-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .header h1 {
            color: white;
            margin: 10px 0;
            font-size: 28px;
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
        .priority-badge {
            display: inline-block;
            background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
            color: #000;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 20px;
        }
        .contact-card {
            background: rgba(26, 77, 46, 0.2);
            border: 2px solid #d4af37;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
        }
        .field {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #334155;
        }
        .field:last-child {
            border-bottom: none;
        }
        .label {
            display: block;
            font-weight: bold;
            color: #d4af37;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .value {
            color: #e5e7eb;
            font-size: 16px;
            line-height: 1.6;
        }
        .value a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: bold;
        }
        .value a:hover {
            text-decoration: underline;
        }
        .message-box {
            background: rgba(15, 23, 42, 0.6);
            border-left: 4px solid #d4af37;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .message-box .label {
            margin-bottom: 12px;
        }
        .quick-actions {
            display: flex;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        .action-button {
            flex: 1;
            min-width: 200px;
            display: inline-block;
            background: linear-gradient(135deg, #1a4d2e 0%, #2d6e3f 100%);
            color: white;
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 4px 15px rgba(26, 77, 46, 0.3);
        }
        .action-button.whatsapp {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        }
        .footer {
            background-color: #0f172a;
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 13px;
            border-top: 1px solid #334155;
        }
        .timestamp {
            color: #64748b;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="header">
                <div class="alert-icon">🔔</div>
                <h1>Nuevo Mensaje de Contacto</h1>
                <p class="header-subtitle">Booking Request - javilabarumdj.com</p>
            </div>
            
            <div class="content">
                <div class="priority-badge">⚡ NUEVA SOLICITUD</div>

                <div class="contact-card">
                    <div class="field">
                        <span class="label">👤 Nombre Completo</span>
                        <div class="value">{{ $contactData['name'] }}</div>
                    </div>

                    <div class="field">
                        <span class="label">📧 Email</span>
                        <div class="value">
                            <a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a>
                        </div>
                    </div>

                    @if(!empty($contactData['phone']))
                        <div class="field">
                            <span class="label">📱 Teléfono</span>
                            <div class="value">
                                <a href="tel:{{ $contactData['phone'] }}">{{ $contactData['phone'] }}</a>
                            </div>
                        </div>
                    @endif

                    @if(!empty($contactData['subject']))
                        <div class="field">
                            <span class="label">📋 Asunto</span>
                            <div class="value">{{ $contactData['subject'] }}</div>
                        </div>
                    @endif
                </div>

                <div class="message-box">
                    <span class="label">💬 Mensaje</span>
                    <div class="value">{{ $contactData['message'] }}</div>
                </div>

                <div class="quick-actions">
                    <a href="mailto:{{ $contactData['email'] }}" class="action-button">
                        📧 Responder por Email
                    </a>
                    @if(!empty($contactData['phone']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactData['phone']) }}" class="action-button whatsapp">
                            💬 WhatsApp
                        </a>
                    @endif
                </div>

                <div class="timestamp">
                    📅 Recibido: {{ now()->format('d/m/Y H:i:s') }}
                </div>
            </div>

            <div class="footer">
                <p><strong>Sistema de Contacto Automático</strong></p>
                <p>javilabarumdj.com | Afro Latin Tech House</p>
                <p style="margin-top: 10px; font-size: 11px; color: #64748b;">
                    Este correo se ha enviado automáticamente desde tu formulario de contacto.<br>
                    Puedes responder directamente a este email para contactar con {{ $contactData['name'] }}
                </p>
            </div>
        </div>
    </div>
</body>
</html>

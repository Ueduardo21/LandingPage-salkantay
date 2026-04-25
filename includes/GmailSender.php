<?php
// ============================================
// CLASE PARA ENVÍO DE CORREOS CON GMAIL
// REQUIERE: PHPMailer (instalar con Composer)
// ============================================

// Cargar autoload de Composer (si está instalado)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    // Si no hay Composer, intentar cargar manualmente
    if (file_exists(__DIR__ . '/PHPMailer/src/PHPMailer.php')) {
        require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/PHPMailer/src/SMTP.php';
        require_once __DIR__ . '/PHPMailer/src/Exception.php';
    }
}

require_once __DIR__ . '/../config/env.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class GmailSender
{
    private $mail;
    private $error = null;
    
    public function __construct()
    {
        $this->initializeMailer();
    }
    
    private function initializeMailer()
    {
        // Verificar que PHPMailer está disponible
        if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            error_log("PHPMailer no está instalado. Ejecuta: composer require phpmailer/phpmailer");
            return;
        }
        
        $this->mail = new PHPMailer(true);
        
        try {
            // Configuración del servidor
            $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
            $this->mail->isSMTP();
            $this->mail->Host       = SMTP_HOST;
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = SMTP_USER;
            $this->mail->Password   = SMTP_PASS;
            $this->mail->SMTPSecure = SMTP_SECURE;
            $this->mail->Port       = SMTP_PORT;
            
            // Configuración de codificación
            $this->mail->setLanguage('es');
            $this->mail->CharSet = 'UTF-8';
            
            // Remitente
            $this->mail->setFrom(FROM_EMAIL, FROM_NAME);
            
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            error_log("Error inicializando PHPMailer: " . $this->error);
        }
    }
    
    /**
     * Enviar correo de consulta
     */
    public function sendEnquiryEmail($data)
    {
        try {
            // Verificar que el mailer está inicializado
            if (!$this->mail) {
                throw new Exception("PHPMailer no inicializado correctamente");
            }
            
            // Para el administrador
            $this->mail->clearAddresses();
            $this->mail->addAddress(ADMIN_EMAIL, ADMIN_NAME);
            $this->mail->addReplyTo($data['email'], $data['name']);
            
            $this->mail->Subject = '📧 Nueva Consulta - Tour Machu Picchu';
            
            // Cuerpo del email
            $body = $this->buildEnquiryEmailBody($data);
            $this->mail->isHTML(true);
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body);
            
            $this->mail->send();
            
            // Enviar confirmación al cliente
            $this->sendCustomerConfirmation($data);
            
            return ['success' => true, 'message' => 'Consulta enviada correctamente'];
            
        } catch (Exception $e) {
            error_log("Error enviando email de consulta: " . $this->mail->ErrorInfo);
            return ['success' => false, 'message' => $this->mail->ErrorInfo];
        }
    }
    
    /**
     * Enviar correo de reserva
     */
    public function sendReservationEmail($data)
    {
        try {
            if (!$this->mail) {
                throw new Exception("PHPMailer no inicializado correctamente");
            }
            
            // Para el administrador
            $this->mail->clearAddresses();
            $this->mail->addAddress(ADMIN_EMAIL, ADMIN_NAME);
            $this->mail->addReplyTo($data['email'], $data['nombre_completo']);
            
            $this->mail->Subject = '📅 Nueva Reserva - Tour Machu Picchu';
            
            // Cuerpo del email
            $body = $this->buildReservationEmailBody($data);
            $this->mail->isHTML(true);
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body);
            
            $this->mail->send();
            
            // Enviar confirmación al cliente
            $this->sendCustomerReservationConfirmation($data);
            
            return ['success' => true, 'message' => 'Reserva enviada correctamente'];
            
        } catch (Exception $e) {
            error_log("Error enviando email de reserva: " . $this->mail->ErrorInfo);
            return ['success' => false, 'message' => $this->mail->ErrorInfo];
        }
    }
    
    /**
     * Enviar confirmación al cliente (consulta)
     */
    private function sendCustomerConfirmation($data)
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($data['email'], $data['name']);
            $this->mail->Subject = '✅ Hemos recibido tu consulta - Cusco Tours Barato';
            $body = $this->buildCustomerConfirmationBody($data);
            $this->mail->isHTML(true);
            $this->mail->Body = $body;
            $this->mail->send();
        } catch (Exception $e) {
            error_log("Error enviando confirmación al cliente: " . $this->mail->ErrorInfo);
        }
    }
    
    /**
     * Enviar confirmación al cliente (reserva)
     */
    private function sendCustomerReservationConfirmation($data)
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($data['email'], $data['nombre_completo']);
            $this->mail->Subject = '✅ Confirmación de Reserva - Tour Machu Picchu';
            $body = $this->buildCustomerReservationConfirmationBody($data);
            $this->mail->isHTML(true);
            $this->mail->Body = $body;
            $this->mail->send();
        } catch (Exception $e) {
            error_log("Error enviando confirmación de reserva al cliente: " . $this->mail->ErrorInfo);
        }
    }
    
    /**
     * Construir cuerpo del email de consulta (admin)
     */
    private function buildEnquiryEmailBody($data)
    {
        $date = $data['date'] ?? 'No especificada';
        $people = $data['people'] ?? '1';
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #00e5b5, #00c4a0); padding: 20px; text-align: center; color: #1a1a1a; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
                .field { margin-bottom: 15px; padding: 10px; background: white; border-radius: 8px; }
                .field-label { font-weight: bold; color: #00e5b5; display: block; margin-bottom: 5px; }
                .field-value { color: #333; }
                .footer { text-align: center; padding: 15px; font-size: 12px; color: #888; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📧 Nueva Consulta</h2>
                    <p>Tour Machu Picchu - 1 Día</p>
                </div>
                <div class='content'>
                    <div class='field'>
                        <span class='field-label'>👤 Nombre:</span>
                        <span class='field-value'>{$data['name']}</span>
                    </div>
                    <div class='field'>
                        <span class='field-label'>📧 Email:</span>
                        <span class='field-value'>{$data['email']}</span>
                    </div>
                    <div class='field'>
                        <span class='field-label'>📱 Teléfono:</span>
                        <span class='field-value'>{$data['phone']}</span>
                    </div>
                    <div class='field'>
                        <span class='field-label'>📅 Fecha preferida:</span>
                        <span class='field-value'>{$date}</span>
                    </div>
                    <div class='field'>
                        <span class='field-label'>👥 Personas:</span>
                        <span class='field-value'>{$people}</span>
                    </div>
                    <div class='field'>
                        <span class='field-label'>💬 Mensaje:</span>
                        <span class='field-value'>" . nl2br(htmlspecialchars($data['message'] ?? '')) . "</span>
                    </div>
                </div>
                <div class='footer'>
                    <p>Consulta recibida desde el formulario de contacto</p>
                    <p>© " . date('Y') . " - Cusco Tours Barato</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
    
    /**
     * Construir cuerpo del email de reserva (admin)
     */
    private function buildReservationEmailBody($data)
    {
        $precio_persona = $data['tipo_servicio'] === 'grupal' ? 520 : 850;
        $total = $precio_persona * $data['personas'];
        $fecha_alternativa = $data['fecha_alternativa'] ?? 'No aplica';
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #00e5b5, #00c4a0); padding: 20px; text-align: center; color: #1a1a1a; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
                .section { margin-bottom: 20px; background: white; padding: 15px; border-radius: 10px; }
                .section-title { font-size: 18px; font-weight: bold; color: #00e5b5; margin-bottom: 15px; border-bottom: 2px solid #00e5b5; padding-bottom: 5px; }
                .field { margin-bottom: 10px; }
                .field-label { font-weight: bold; color: #555; display: inline-block; width: 140px; }
                .field-value { color: #333; }
                .total { background: #00e5b5; color: #1a1a1a; padding: 15px; text-align: center; border-radius: 10px; font-size: 18px; font-weight: bold; margin-top: 20px; }
                .footer { text-align: center; padding: 15px; font-size: 12px; color: #888; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📅 Nueva Reserva</h2>
                    <p>Tour Machu Picchu - 1 Día</p>
                </div>
                <div class='content'>
                    <div class='section'>
                        <div class='section-title'>👤 Datos Personales</div>
                        <div class='field'><span class='field-label'>Documento:</span><span class='field-value'>{$data['tipo_documento']}: {$data['documento']}</span></div>
                        <div class='field'><span class='field-label'>Nombre:</span><span class='field-value'>{$data['nombre_completo']}</span></div>
                        <div class='field'><span class='field-label'>Edad/Sexo:</span><span class='field-value'>{$data['edad']} años / {$data['sexo']}</span></div>
                        <div class='field'><span class='field-label'>País:</span><span class='field-value'>{$data['pais']}</span></div>
                        <div class='field'><span class='field-label'>Teléfono:</span><span class='field-value'>{$data['codigo_pais']} {$data['telefono']}</span></div>
                        <div class='field'><span class='field-label'>Email:</span><span class='field-value'>{$data['email']}</span></div>
                    </div>
                    
                    <div class='section'>
                        <div class='section-title'>🏔️ Datos del Tour</div>
                        <div class='field'><span class='field-label'>Fecha salida:</span><span class='field-value'>{$data['fecha']}</span></div>
                        <div class='field'><span class='field-label'>Fecha alternativa:</span><span class='field-value'>{$fecha_alternativa}</span></div>
                        <div class='field'><span class='field-label'>Tipo servicio:</span><span class='field-value'>" . ucfirst($data['tipo_servicio']) . "</span></div>
                        <div class='field'><span class='field-label'>Personas:</span><span class='field-value'>{$data['personas']}</span></div>
                        <div class='field'><span class='field-label'>Requerimientos:</span><span class='field-value'>" . nl2br(htmlspecialchars($data['requerimientos'] ?? '')) . "</span></div>
                    </div>
                    
                    <div class='section'>
                        <div class='section-title'>💳 Método de Pago</div>
                        <div class='field'><span class='field-label'>Método:</span><span class='field-value'>{$data['metodo_pago']}</span></div>
                    </div>
                    
                    <div class='total'>
                        💰 TOTAL A PAGAR: $ " . number_format($total, 2) . " USD
                    </div>
                </div>
                <div class='footer'>
                    <p>Reserva recibida desde el formulario web</p>
                    <p>© " . date('Y') . " - Cusco Tours Barato</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
    
    /**
     * Construir confirmación para el cliente (consulta)
     */
    private function buildCustomerConfirmationBody($data)
    {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 500px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #00e5b5, #00c4a0); padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
                .btn { display: inline-block; background: #00e5b5; color: #1a1a1a; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 15px; }
                .footer { text-align: center; padding: 15px; font-size: 11px; color: #888; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>✅ ¡Consulta Recibida!</h2>
                </div>
                <div class='content'>
                    <p>Hola <strong>{$data['name']}</strong>,</p>
                    <p>Hemos recibido tu consulta sobre el <strong>Tour Machu Picchu</strong>. Un asesor se pondrá en contacto contigo en las próximas <strong>24 horas</strong>.</p>
                    <p>📅 <strong>Fecha de interés:</strong> {$data['date']}<br>
                    👥 <strong>Personas:</strong> {$data['people']}</p>
                    <p>Si tienes alguna pregunta adicional, no dudes en respondernos a este correo.</p>
                    <center><a href='https://wa.me/" . str_replace('+', '', $data['phone']) . "' class='btn'>💬 Contactar por WhatsApp</a></center>
                </div>
                <div class='footer'>
                    <p>© " . date('Y') . " - Cusco Tours Barato | Tours en Machu Picchu</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
    
    /**
     * Construir confirmación para el cliente (reserva)
     */
    private function buildCustomerReservationConfirmationBody($data)
    {
        $precio_persona = $data['tipo_servicio'] === 'grupal' ? 520 : 850;
        $total = $precio_persona * $data['personas'];
        
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 500px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #00e5b5, #00c4a0); padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
                .resumen { background: white; padding: 15px; border-radius: 10px; margin: 15px 0; }
                .total { background: #00e5b5; padding: 10px; text-align: center; border-radius: 8px; font-weight: bold; }
                .footer { text-align: center; padding: 15px; font-size: 11px; color: #888; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>✅ ¡Reserva Recibida!</h2>
                </div>
                <div class='content'>
                    <p>Hola <strong>{$data['nombre_completo']}</strong>,</p>
                    <p>Hemos recibido tu reserva para el <strong>Tour Machu Picchu - 1 Día</strong>. En breve recibirás la confirmación y los detalles de pago.</p>
                    
                    <div class='resumen'>
                        <h3>📋 Resumen de Reserva</h3>
                        <p><strong>📅 Fecha:</strong> {$data['fecha']}<br>
                        <strong>🎫 Tipo:</strong> " . ucfirst($data['tipo_servicio']) . "<br>
                        <strong>👥 Personas:</strong> {$data['personas']}<br>
                        <strong>💳 Método de pago:</strong> {$data['metodo_pago']}</p>
                        <div class='total'>💰 Total: $ " . number_format($total, 2) . " USD</div>
                    </div>
                    
                    <p>📧 Te enviaremos los detalles completos y el voucher en las próximas 24 horas.</p>
                    <p>¡Gracias por confiar en nosotros!</p>
                </div>
                <div class='footer'>
                    <p>© " . date('Y') . " - Cusco Tours Barato | Tours en Machu Picchu</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}
?>
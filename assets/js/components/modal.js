// ============================================
// MODALES - JAVASCRIPT (VERSIÓN CORREGIDA)
// ============================================

// ============================================
// DETECCIÓN AUTOMÁTICA DE RUTAS
// ============================================

//Culqi.publicKey = 'pk_test_AQUI_TU_LLAVE_PUBLICA';

// Ruta base de tu proyecto en localhost
// Si tu index.php está en: http://localhost/salka/LandingPageSalka/index.php
//const PROYECT_URL = '/salka/LandingPageSalka';

// Rutas del proyecto
const PROYECT_URL = '/landing-salka';



// Variables globales
let currentPaso = 1;
let precioBase = 520;
let precioPrivado = 850;

// ============================================
// FUNCIONES PARA MODAL DE CONSULTA
// ============================================

function openConsultaModal() {
    const modal = document.getElementById('enquiryModal');
    const tourName = document.querySelector('#modalTourNameReserva')?.innerText || 'Machu Picchu Tour';
    
    document.getElementById('modalTourName').innerText = tourName;
    document.getElementById('enquiryTourName').value = tourName;
    document.getElementById('enquiryForm').reset();
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeEnquiryModal() {
    const modal = document.getElementById('enquiryModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

async function submitEnquiry(event) {
    event.preventDefault();
    
    const submitBtn = document.querySelector('#enquiryForm .btn-submit');
    const cancelBtn = document.querySelector('#enquiryForm .btn-cancel');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
    submitBtn.disabled = true;
    if (cancelBtn) cancelBtn.disabled = true;
    
    const formData = {
        tour: document.getElementById('enquiryTourName').value,
        name: document.getElementById('enquiryName').value,
        email: document.getElementById('enquiryEmail').value,
        phone: document.getElementById('enquiryPhone').value,
        date: document.getElementById('enquiryDate').value,
        people: document.getElementById('enquiryPeople').value,
        message: document.getElementById('enquiryMessage').value
    };
    
    try {
        // ✅ Ruta CORRECTA para tu estructura
        const apiUrl = PROYECT_URL + '/process/procesar-consulta-ajax.php';
        
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('✅ ¡Gracias por tu consulta! Un asesor se pondrá en contacto contigo en las próximas 24 horas.');
            closeEnquiryModal();
        } else {
            alert('❌ Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('❌ Error de conexión. Por favor, intenta de nuevo más tarde.');
    } finally {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        if (cancelBtn) cancelBtn.disabled = false;
    }
}

// ============================================
// FUNCIONES PARA MODAL DE RESERVA
// ============================================

function openReservaModal() {
    const modal = document.getElementById('reservaModal');
    const tourName = 'Machu Picchu Tour';
    
    document.getElementById('modalTourNameReserva').innerText = tourName;
    document.getElementById('tourReservaName').value = tourName;
    
    document.getElementById('reservaForm').reset();
    currentPaso = 1;
    showPaso(currentPaso);
    actualizarResumen();
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeReservaModal() {
    const modal = document.getElementById('reservaModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

function showPaso(paso) {
    for(let i = 1; i <= 3; i++) {
        const pasoEl = document.getElementById(`paso${i}`);
        const stepEl = document.getElementById(`step${i}`);
        if (pasoEl) pasoEl.classList.remove('active');
        if (stepEl) stepEl.classList.remove('active');
    }
    
    const pasoActual = document.getElementById(`paso${paso}`);
    const stepActual = document.getElementById(`step${paso}`);
    if (pasoActual) pasoActual.classList.add('active');
    if (stepActual) stepActual.classList.add('active');
    
    for(let i = 1; i <= 2; i++) {
        const line = document.getElementById(`line${i}`);
        if(line) {
            if(paso > i) line.classList.add('active');
            else line.classList.remove('active');
        }
    }
    
    for(let i = 1; i <= 3; i++) {
        const step = document.getElementById(`step${i}`);
        if (step) {
            if (i < paso) step.classList.add('completed');
            else step.classList.remove('completed');
        }
    }
    
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    const btnSubmit = document.getElementById('btnSubmit');
    
    if(paso === 1) {
        if (btnPrev) btnPrev.style.display = 'none';
        if (btnNext) btnNext.style.display = 'flex';
        if (btnSubmit) btnSubmit.style.display = 'none';
    } else if(paso === 3) {
        if (btnPrev) btnPrev.style.display = 'flex';
        if (btnNext) btnNext.style.display = 'none';
        if (btnSubmit) btnSubmit.style.display = 'flex';
    } else {
        if (btnPrev) btnPrev.style.display = 'flex';
        if (btnNext) btnNext.style.display = 'flex';
        if (btnSubmit) btnSubmit.style.display = 'none';
    }
    
    if(paso === 2) actualizarResumen();
    if(paso === 3) actualizarTotal();
}

function nextPaso() {
    if(currentPaso < 3 && validarPaso(currentPaso)) {
        currentPaso++;
        showPaso(currentPaso);
    }
}

function prevPaso() {
    if(currentPaso > 1) {
        currentPaso--;
        showPaso(currentPaso);
    }
}

function validarPaso(paso) {
    if(paso === 1) {
        const nombre = document.getElementById('nombre_completo')?.value;
        const edad = document.getElementById('edad')?.value;
        const sexo = document.getElementById('sexo')?.value;
        const pais = document.getElementById('pais')?.value;
        const telefono = document.getElementById('telefono')?.value;
        const email = document.getElementById('email')?.value;
        
        if(!nombre) { alert('Por favor, ingresa tu nombre completo'); return false; }
        if(!edad) { alert('Por favor, ingresa tu edad'); return false; }
        if(!sexo) { alert('Por favor, selecciona tu sexo'); return false; }
        if(!pais) { alert('Por favor, selecciona tu país'); return false; }
        if(!telefono) { alert('Por favor, ingresa tu teléfono'); return false; }
        if(!email) { alert('Por favor, ingresa tu email'); return false; }
        if(!email.includes('@')) { alert('Por favor, ingresa un email válido'); return false; }
        return true;
    }
    if(paso === 2) {
        const fecha = document.getElementById('fecha')?.value;
        if(!fecha) { alert('Por favor, selecciona una fecha para el tour'); return false; }
        return true;
    }
    return true;
}

function actualizarResumen() {
    const tipoServicioRadio = document.querySelector('input[name="tipo_servicio"]:checked');
    if (!tipoServicioRadio) return;
    
    const tipoServicio = tipoServicioRadio.value;
    const personas = document.getElementById('personas')?.value || 1;
    const fecha = document.getElementById('fecha')?.value || '';
    const precio = tipoServicio === 'grupal' ? precioBase : precioPrivado;
    const total = precio * personas;
    
    const resumenCard = document.getElementById('tourResumen');
    if (resumenCard) {
        resumenCard.innerHTML = `
            <div style="display: flex; gap: 15px; flex-wrap: wrap; justify-content: space-between; background: rgba(0,229,181,0.1); padding: 15px; border-radius: 12px;">
                <div><small>Tour</small><br><strong>Machu Picchu - 1 día</strong></div>
                <div><small>Servicio</small><br><strong>${tipoServicio === 'grupal' ? 'Grupal' : 'Privado'}</strong></div>
                <div><small>Personas</small><br><strong>${personas}</strong></div>
                ${fecha ? `<div><small>Fecha</small><br><strong>${fecha}</strong></div>` : ''}
                <div><small>Total</small><br><strong style="color: #00e5b5;">$${total} USD</strong></div>
            </div>
        `;
    }
}

function actualizarPrecioServicio() {
    if(currentPaso === 2) actualizarResumen();
    if(currentPaso === 3) actualizarTotal();
}

function updatePeopleCount(cambio) {
    const input = document.getElementById('personas');
    if (!input) return;
    
    let value = parseInt(input.value) + cambio;
    if(value >= 1 && value <= 12) {
        input.value = value;
        if(currentPaso === 2) actualizarResumen();
        if(currentPaso === 3) actualizarTotal();
    }
}

function actualizarTotal() {
    const tipoServicioRadio = document.querySelector('input[name="tipo_servicio"]:checked');
    if (!tipoServicioRadio) return;
    
    const tipoServicio = tipoServicioRadio.value;
    const personas = parseInt(document.getElementById('personas')?.value) || 1;
    const precio = tipoServicio === 'grupal' ? precioBase : precioPrivado;
    const total = precio * personas;
    
    const totalElement = document.getElementById('totalAmount');
    if (totalElement) totalElement.innerHTML = `$${total} USD`;
}

function showPaymentDetail(method) {
    document.querySelectorAll('.payment-detail').forEach(detail => {
        detail.classList.remove('active');
    });
    
    const detailId = `detail-${method}`;
    const detailElement = document.getElementById(detailId);
    if(detailElement) detailElement.classList.add('active');
}

function actualizarCodigoPais() {
    const paisSelect = document.getElementById('pais');
    const selectedOption = paisSelect.options[paisSelect.selectedIndex];
    const codigo = selectedOption?.getAttribute('data-codigo') || '';
    const codigoPaisInput = document.getElementById('codigo_pais');
    if (codigoPaisInput) codigoPaisInput.value = codigo;
}

function verTerminos(event) {
    event.preventDefault();
    alert('📋 Términos y condiciones:\n\n• Cancelación gratuita hasta 24h antes\n• Responsabilidad del viajero sobre sus documentos\n• Seguro de viaje recomendado\n• Precios sujetos a disponibilidad');
}

// Funcion para el envio en la reserva
async function submitReserva(event) {
    event.preventDefault();

    const terminos = document.getElementById('terminos_reserva');
    if (!terminos?.checked) {
        alert('Debes aceptar los términos y condiciones para continuar');
        return;
    }

    const submitBtn = document.getElementById('btnSubmit');
    const originalText = submitBtn?.innerHTML || 'Confirmar Reserva';

    if (submitBtn) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
        submitBtn.disabled = true;
    }

    const formData = {
        tour_name: document.getElementById('tourReservaName')?.value || 'Machu Picchu Tour',
        tipo_documento: document.getElementById('tipo_documento')?.value || '',
        documento: document.getElementById('documento')?.value || '',
        nombre_completo: document.getElementById('nombre_completo')?.value || '',
        edad: document.getElementById('edad')?.value || '',
        sexo: document.getElementById('sexo')?.value || '',
        pais: document.getElementById('pais')?.value || '',
        codigo_pais: document.getElementById('codigo_pais')?.value || '',
        telefono: document.getElementById('telefono')?.value || '',
        email: document.getElementById('email')?.value || '',
        fecha: document.getElementById('fecha')?.value || '',
        fecha_alternativa: document.getElementById('fecha_alternativa')?.value || '',
        tipo_servicio: document.querySelector('input[name="tipo_servicio"]:checked')?.value || 'grupal',
        personas: document.getElementById('personas')?.value || '1',
        requerimientos: document.getElementById('requerimientos')?.value || '',
        metodo_pago: (document.querySelector('input[name="metodo_pago"]:checked')?.value || 'tarjeta').toLowerCase(),
        terminos: terminos.checked ? '1' : ''
    };

    const personas = parseInt(formData.personas || '1');
    const precioBase = formData.tipo_servicio === 'grupal' ? 520 : 850;
    //const totalCentimos = personas * precioBase * 100;


    // 🔥 AQUÍ LO CAMBIAS PARA PRUEBA
    const totalCentimos = 600; // S/6.00

    try {
        if (formData.metodo_pago === 'tarjeta') {

            Culqi.publicKey = 'pk_test_AQUI_TU_LLAVE_PUBLICA';

            Culqi.settings({
                title: 'Machu Picchu Tour',
                currency: 'PEN', // USD
                amount: totalCentimos
            });

            Culqi.options({
                lang: 'auto',
                installments: false,
                paymentMethods: {
                    tarjeta: true,
                    yape: false,
                    billetera: false
                }
            });

            window.culqi = async function () {
                if (Culqi.token) {
                    const token = Culqi.token.id;

                    const pagoResponse = await fetch(PROYECT_URL + '/process/procesar-pago-culqi.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            token: token,
                            email: formData.email,
                            amount: totalCentimos
                        })
                    });

                    const pagoResult = await pagoResponse.json();

                    if (!pagoResult.success) {
                        alert('❌ Pago rechazado: ' + pagoResult.message);
                        return;
                    }

                    const reservaResponse = await fetch(PROYECT_URL + '/process/procesar-reserva-ajax.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(formData)
                    });

                    const reservaResult = await reservaResponse.json();

                    if (reservaResult.success) {
                        alert(`✅ Pago + Reserva completada\nCódigo: ${reservaResult.codigo_reserva}`);
                        closeReservaModal();
                    } else {
                        alert('⚠️ Pago OK, pero error al registrar reserva: ' + reservaResult.message);
                    }
                } else {
                    alert('❌ Error Culqi: ' + (Culqi.error?.user_message || 'No se pudo generar token'));
                }
            };

            Culqi.open();

        } else if (formData.metodo_pago === 'yape') {

            formData.yape_phone = document.getElementById('yape_phone')?.value || '';
            formData.yape_code = document.getElementById('yape_code')?.value || '';

            await registrarReservaNormal(formData);

        } else if (formData.metodo_pago === 'plin') {

            formData.plin_phone = document.getElementById('plin_phone')?.value || '';
            formData.plin_code = document.getElementById('plin_code')?.value || '';

            await registrarReservaNormal(formData);

        } else {

            await registrarReservaNormal(formData);
        }

    } catch (error) {
        console.error('ERROR REAL:', error);
        alert('❌ Error: ' + error.message);
    } finally {
        if (submitBtn) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }
}

async function registrarReservaNormal(formData) {
    const response = await fetch(PROYECT_URL + '/process/procesar-reserva-ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
    });

    const text = await response.text();
    console.log('RESPUESTA PHP:', text);

    const result = JSON.parse(text);

    if (result.success) {
        alert(`✅ Reserva registrada\nCódigo: ${result.codigo_reserva}`);
        closeReservaModal();
    } else {
        alert('❌ Error: ' + result.message);
    }
}

// ============================================
// INICIALIZACIÓN
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    window.onclick = function(event) {
        const enquiryModal = document.getElementById('enquiryModal');
        const reservaModal = document.getElementById('reservaModal');
        
        if(event.target === enquiryModal) closeEnquiryModal();
        if(event.target === reservaModal) closeReservaModal();
    };
    
    const precioElement = document.querySelector('.current-price');
    if(precioElement) {
        const precio = precioElement.innerText.replace('$', '').replace('USD', '').trim();
        precioBase = parseInt(precio) || 520;
    }
    
    if (document.getElementById('pais') && document.getElementById('codigo_pais')) {
        actualizarCodigoPais();
    }
});
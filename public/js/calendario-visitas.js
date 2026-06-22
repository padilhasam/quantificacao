window.calendar = null; // Declarada globalmente

function getStatusColor(status) {
    switch (status) {
        case 'FINALIZADA': return '#198754'; // Verde
        case 'CANCELADA':  return '#dc3545'; // Vermelho
        case 'EM_ANDAMENTO': return '#0d6efd'; // Azul
        default:           return '#ffc107'; // Amarelo
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const eventosFormatados = (window.eventosData || []).map(evento => {
        const status = evento.extendedProps?.status || 'ABERTA';
        return {
            ...evento,
            backgroundColor: getStatusColor(status),
            borderColor: getStatusColor(status)
        };
    });

    // CORREÇÃO: Atribuindo à variável global window.calendar
    window.calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        themeSystem: 'bootstrap5',
        height: 'auto',
        headerToolbar: { 
            left: 'prev,next today', 
            center: 'title', 
            right: 'dayGridMonth,timeGridWeek' 
        },
        events: eventosFormatados,
        
        editable: true, 
        droppable: true,
        dayMaxEvents: true,

        windowResize: function(arg) {
            if (window.innerWidth < 768) {
                window.calendar.changeView('dayGridMonth');
            }
        },

        eventDrop: function(info) {
            const dataFormatada = info.event.startStr.split('T')[0];
            
            $.ajax({
                url: window.baseUrl + '/visitas/atualizarData',
                type: 'POST',
                data: {
                    id: info.event.id,
                    nova_data: dataFormatada
                },
                success: function(response) {
                    if (response.status === 'sucesso') {
                        showToast(response.mensagem, 'success');
                    } else {
                        showToast(response.mensagem, 'danger');
                        info.revert(); // Volta o evento para a data original se falhar
                    }
                },
                error: function() {
                    showToast('Erro ao conectar com o servidor.', 'danger');
                    info.revert();
                }
            });
        },
        
        dateClick: function(info) {
            if (window.baseUrl) {
                window.location.href = `${window.baseUrl}/visitas/criar?data=${info.dateStr}`;
            }
        },
        
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if (info.event.url) {
                window.location.href = info.event.url;
            }
        }
    });

    window.calendar.render();
});
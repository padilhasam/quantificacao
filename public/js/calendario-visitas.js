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
            if (!confirm("Confirmar a alteração da data para " + info.event.startStr + "?")) {
                info.revert();
            } else {
                $.ajax({
                    // Use uma URL relativa à raiz do seu projeto (assumindo que baseUrl aponta para a raiz)
                    url: window.baseUrl + '/api.php?action=atualizar_visita', 
                    type: 'POST',
                    data: {
                        id: info.event.id,
                        nova_data: info.event.startStr
                    },
                    success: function(response) {
                        // Log para ver o que o servidor respondeu
                        console.log("Resposta do servidor:", response); 
                        showToast("Data da visita atualizada!", "success");
                        $('#tabelaVisitas').load(window.baseUrl + '/visitas/listar-tabela-ajax.php');
                    },
                    error: function(xhr) {
                        console.error("Erro AJAX:", xhr.responseText); // MUITO IMPORTANTE
                        showToast("Erro ao atualizar: " + xhr.statusText, "danger");
                        info.revert();
                    }
                });
            }
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
let datos = {
    labels: ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'],
    datasets: [
        {
            label: 'humedad',
            data: [100, 234, 45, 210, 430, 157, 284],
            fill: true,
            backgroundColor: 'rgba(255,69,34,.5)',
            borderColor: 'rgb(255,110,86)',
            borderDash: [10, 4, 3, 4],
            tension: .3,
            pointStyle: 'rectRot',
            pointRadius: 10,
        },
        {
            label: 'salinidad',
            data: [350, 34, 267, 110, 30, 20, 70],
            fill: true,
            backgroundColor: 'rgba(63,80,255,.2)',
            borderColor: 'rgb(119,145,255)',
            borderDash: [10, 4, 3, 4],
            tension: .3,
            pointStyle: 'rectRot',
            pointRadius: 10,
        },
        {
            label: 'temperatura',
            data: [30, 25, 27, 18, 22, 20, 23],
            fill: true,
            backgroundColor: 'rgba(128,0,128,.4)',
            borderColor: 'rgb(128,0,128)',
            borderDash: [10, 4, 3, 4],
            tension: .3,
            pointStyle: 'rectRot',
            pointRadius: 10,
        },
        {
            label: 'luminosidad',
            data: [30, 25, 27, 18, 22, 20, 23],
            fill: true,
            backgroundColor: 'rgba(128,0,128,.4)',
            borderColor: 'rgb(128,0,128)',
            borderDash: [10, 4, 3, 4],
            tension: .3,
            pointStyle: 'rectRot',
            pointRadius: 10,
        }
    ]
};

let ctx = document.getElementById('chart');

let miGrafica = new Chart(ctx, {
    type: 'line',
    data: datos,
    options: opciones
});
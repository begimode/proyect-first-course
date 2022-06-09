let datos = {
    labels: ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'],
    datasets: [
        {
            label: 'humedad',
            data: [43, 49, 45, 55, 51, 58, 48, 70],
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
            data: [8, 10, 9, 7, 9, 11, 8],
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
            data: [30, 25, 27, 18, 22, 20, 23, 40],
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
            data: [310, 330, 327, 340, 315, 370, 360, 380],
            fill: true,
            backgroundColor: 'rgba(255,255,0,.4)',
            borderColor: 'rgb(255,255,0)',
            borderDash: [10, 4, 3, 4],
            tension: .3,
            pointStyle: 'rectRot',
            pointRadius: 10,
        }
    ]
};

let opciones = {
    responsive: true,
    maintainAspectRatio: false,
    // scales: {
    //     y: {
    //         stacked: true
    //     }
    // },
    plugins: {
        legend: {
            position: 'bottom',
            align: 'center'
        },
        title: {
            display: true,
            text: 'Ventas de la semana'
        },
        tooltip: {
            backgroundColor: '#fff',
            titleColor: '#000',
            titleAlign: 'center',
            bodyColor: '#333',
            borderColor: '#666',
            borderWidth: 1,
        }
    },
};

let ctx = document.getElementById('chart');

let miGrafica = new Chart(ctx, {
    type: 'line',
    data: datos,
    options: opciones
});
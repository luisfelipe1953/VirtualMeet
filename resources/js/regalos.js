(function () {
    const graficoRegalos = document.querySelector("#grafico-regalos");
    if (graficoRegalos) {

        obtenerRegalos();
        async function obtenerRegalos(){
          const url = '/api/regalos'
          const respuesta = await fetch(url)
          const resultado = await respuesta.json();
        
          const ctx = document.getElementById("grafico-regalos");
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: resultado.map(datos => datos.nombre),
              datasets: [{
                label: '',
                data: resultado.map(datos => datos.total),
                backgroundColor: [
                  '#ea580c',
                  '#84cc16',
                  '#22d3ee',
                  '#a855f7',
                  '#ef4444',
                  '#14b8a6',
                  '#db2777',
                  '#e11d48',
                  '#7e22ce'
              ]
              }]
            },
            options: {
              plugins: {
                legend: {
                  display: false
                }
              },
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        }

       
    }
})();

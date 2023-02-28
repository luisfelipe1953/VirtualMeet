if (document.querySelector('#mapa')) {
    const lat = 8.766711;
    const long = -75.878004;
    const zoom = 16;

    const map = L.map('mapa').setView([lat, long], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, long]).addTo(map)
        .bindPopup(`
        <h1 class="font-black text-2xl text-center"> VirtualMeet </h1>
        <p>en un lugar serca de donde vivo xd</p>`)
        .openPopup();
}
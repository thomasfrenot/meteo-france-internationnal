const map = L.map('map', {
    center: [46.03416, 7.88416],
    zoom: 8
})

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

fetch('http://localhost:52000')
    .then(response => {
        return response.json();
    })
    .then(peaks => {
        peaks.map(peak => {
            L.marker([peak.lat, peak.lon]).addTo(map)
                .bindPopup(`
                    <h3>${peak.name}</h3>
                    <div>
                        <strong>atltitude : </strong> ${peak.altitude}m <br/>
                        <strong>latitude : </strong> ${peak.lat} <br/>
                        <strong>longitude : </strong> ${peak.lon}
                    </div>
                `)
                .openPopup();
        })
    })
    .catch(e => console.error(e));

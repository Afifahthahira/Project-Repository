@extends('layouts.app')

@section('content')

{{-- ================= JUDUL ================= --}}
<section class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-2">
        Peta Wilayah Operasional & Produksi PT PGE
    </h1>
    <p class="text-gray-600">
        Visualisasi spasial cluster produksi minyak dan gas PT Pema Global Energi
        di wilayah Arun, Aceh Utara
    </p>
</section>

{{-- ================= MAP ================= --}}
<section class="max-w-7xl mx-auto px-6 pb-16">
    <div id="map" style="height: 600px; border-radius: 12px;"></div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
/* ============================================================
   INISIALISASI MAP (ARUN – ACEH UTARA)
============================================================ */
var map = L.map('map').setView([5.165, 97.145], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

/* ============================================================
   DATA POLYGON CLUSTER PRODUKSI (GEOJSON)
============================================================ */
var wilayahProduksi = {
    "type": "FeatureCollection",
    "features": [

        {
            "type": "Feature",
            "properties": {
                "nama": "Cluster I Arun",
                "status": "Produksi Tinggi"
            },
            "geometry": {
                "type": "Polygon",
                "coordinates": [[
                    [97.128, 5.178],
                    [97.142, 5.177],
                    [97.147, 5.170],
                    [97.135, 5.165],
                    [97.125, 5.170],
                    [97.128, 5.178]
                ]]
            }
        },

        {
            "type": "Feature",
            "properties": {
                "nama": "Cluster II Arun",
                "status": "Produksi Sedang"
            },
            "geometry": {
                "type": "Polygon",
                "coordinates": [[
                    [97.145, 5.172],
                    [97.162, 5.170],
                    [97.168, 5.160],
                    [97.152, 5.155],
                    [97.145, 5.162],
                    [97.145, 5.172]
                ]]
            }
        },

        {
            "type": "Feature",
            "properties": {
                "nama": "Cluster III Arun",
                "status": "Produksi Sedang"
            },
            "geometry": {
                "type": "Polygon",
                "coordinates": [[
                    [97.118, 5.165],
                    [97.130, 5.160],
                    [97.128, 5.150],
                    [97.115, 5.150],
                    [97.112, 5.158],
                    [97.118, 5.165]
                ]]
            }
        },

        {
            "type": "Feature",
            "properties": {
                "nama": "Cluster IV Arun",
                "status": "Produksi Rendah"
            },
            "geometry": {
                "type": "Polygon",
                "coordinates": [[
                    [97.155, 5.155],
                    [97.172, 5.150],
                    [97.170, 5.140],
                    [97.155, 5.140],
                    [97.150, 5.148],
                    [97.155, 5.155]
                ]]
            }
        }

    ]
};

/* ============================================================
   WARNA POLYGON
============================================================ */
function getColor(status) {
    if (status === 'Produksi Tinggi') return '#e31a1c';
    if (status === 'Produksi Sedang') return '#fd8d3c';
    return '#2ecc71';
}

/* ============================================================
   TAMPILKAN POLYGON
============================================================ */
L.geoJSON(wilayahProduksi, {
    style: function(feature) {
        return {
            fillColor: getColor(feature.properties.status),
            weight: 1,
            color: '#333',
            fillOpacity: 0.6
        };
    },
    onEachFeature: function(feature, layer) {
        layer.bindPopup(
            `<strong>${feature.properties.nama}</strong><br>
             Status: ${feature.properties.status}`
        );
    }
}).addTo(map);

/* ============================================================
   TITIK PRODUKSI (SUDAH DI DALAM CLUSTER)
============================================================ */
var titikProduksi = [

    // CLUSTER I
    {
        nama: "Sumur Arun A-01",
        cluster: "Cluster I Arun",
        lat: 5.171,
        lng: 97.136,
        status: "Aktif"
    },

    // CLUSTER II
    {
        nama: "Sumur Arun B-02",
        cluster: "Cluster II Arun",
        lat: 5.162,
        lng: 97.156,
        status: "Aktif"
    },

    // CLUSTER III
    {
        nama: "Sumur Arun C-03",
        cluster: "Cluster III Arun",
        lat: 5.156,
        lng: 97.121,
        status: "Aktif"
    },

    // CLUSTER IV
    {
        nama: "Fasilitas Pengolahan Gas Arun",
        cluster: "Cluster IV Arun",
        lat: 5.147,
        lng: 97.158,
        status: "Operasional"
    }

];

/* ============================================================
   TAMPILKAN MARKER (CIRCLE MARKER)
============================================================ */
titikProduksi.forEach(function(titik) {
    L.circleMarker([titik.lat, titik.lng], {
        radius: 6,
        fillColor: '#0066ff',
        color: '#ffffff',
        weight: 1,
        fillOpacity: 0.9
    })
    .addTo(map)
    .bindPopup(
        `<strong>${titik.nama}</strong><br>
         ${titik.cluster}<br>
         Status: ${titik.status}`
    );
});

/* ============================================================
   LEGENDA
============================================================ */
var legend = L.control({ position: "bottomright" });

legend.onAdd = function() {
    var div = L.DomUtil.create("div");
    div.style.background = "white";
    div.style.padding = "10px";
    div.style.borderRadius = "8px";
    div.style.boxShadow = "0 0 6px rgba(0,0,0,0.3)";
    div.innerHTML = `
        <strong>Status Produksi</strong><br>
        <div><span style="background:#e31a1c;width:12px;height:12px;display:inline-block"></span> Tinggi</div>
        <div><span style="background:#fd8d3c;width:12px;height:12px;display:inline-block"></span> Sedang</div>
        <div><span style="background:#2ecc71;width:12px;height:12px;display:inline-block"></span> Rendah</div>
        <hr>
        <strong>Titik Produksi</strong><br>
        <div><span style="background:#0066ff;width:10px;height:10px;border-radius:50%;display:inline-block"></span> Sumur / Fasilitas</div>
    `;
    return div;
};

legend.addTo(map);

</script>
@endsection
